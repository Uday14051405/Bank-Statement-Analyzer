<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Events\UserOTPNotVerified;
use App\Events\UserOTPVerified;
use Jenssegers\Agent\Agent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Otp;
use App\Models\OtpAttempt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\BsaDocument;
use App\Models\BsaReport;

class OtpController extends Controller
{

    // Handle login form submission
    public function verifyOtpforlogin(Request $request)
    {

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:6',
        ]);

        $eventIdInput = $request->event_id ?? '';
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Retrieve OTP session identifier from the cookie
        $otpSession = Cookie::get('otp_session');
        if (!$otpSession) {
            //return response()->json(['error' => 'OTP session expired. Please request a new OTP.'], 400);
            return response()->json(['status' => 'error', 'error' => 'OTP session expired. Please request a new OTP.'], 400);
        }

        // Find the OTP record in the database
        $otp = Otp::where('session_id', $otpSession)
            ->where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>=', now())
            ->first();

        if (!$otp) {
            //return response()->json(['error' => 'Invalid or expired OTP.'], 400);
            return response()->json(['status' => 'error', 'error' => 'Invalid or expired OTP.'], 400);
        }

        // Find or create the user by mobile number
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            // Create a new user if not found
            $user = User::create([
                'name' => $request->fullname,
                'mobile' => $request->mobile,
                'email' => '',
                'role_id' => 3,
                'password' => Hash::make(Str::random(8)), // Generate a random default password
            ]);
            $user->assignRole('Customer');
        }

        // Log the user in
        Auth::login($user);

        $mobile = $request->mobile ?? '';
        OtpAttempt::where('mobile', $mobile)->update(['attempts' => 0]);

        // Delete the OTP record
        $otp->delete();

        // Clear the OTP session cookie
        Cookie::queue(Cookie::forget('otp_session'));
        $agent = new Agent();
        $eventId = event(new UserOTPVerified($user, $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web',$request->mobile, $eventIdInput ));

        return response()->json(['status' => 'success', 'success' => 'Login successful.']);
    }


    public function sendOtp(Request $request)
    {
        // Validate mobile number
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $mobile = $request->mobile;

        // Fetch or initialize the resend attempt record
        $attemptRecord = OtpAttempt::firstOrCreate(['mobile' => $mobile], [
            'attempts' => 0,
            'last_attempt_at' => now(),
        ]);

        // Reset attempts if it's been more than 24 hours since the last attempt
        if ($attemptRecord->last_attempt_at < now()->subDay()) {
            $attemptRecord->attempts = 0;
            $attemptRecord->save();
        }
        //dd(env('SMS_ATTEMPT_BLOCK'));
        // Check if the user has exceeded the max attempts
        if ($attemptRecord->attempts >= env('SMS_ATTEMPT_BLOCK')) {
            return response()->json([
                'error' => 'Too many resend attempts. Please try again after 24 hours.'
            ], 429);
        }

        // Generate OTP

        $otp = config('services.textlocal.on_production') ? rand(100000, 999999) : 123456;

        $attempts = Cookie::get('resend_attempts', 0);
        // Save OTP to the database
        $sessionId = uniqid('otp_', true);
        Otp::updateOrCreate(
            ['mobile' => $mobile],
            ['otp' => $otp, 'session_id' => $sessionId, 'expires_at' => now()->addMinutes(10)]
        );
        // Cache the session ID in the cookie
        Cookie::queue(Cookie::make('otp_session', $sessionId, 10)); // Cookie expires in 10 minutes

        // Increment and update resend attempts in the cookie
        Cookie::queue(Cookie::make('resend_attempts', $attempts + 1, 1440)); // Resend attempts expire in 24 hours
       
            if (config('services.textlocal.on_production')) {    
            $response = Http::asForm()->post(config('services.textlocal.base_url'), [
                'apikey'  => config('services.textlocal.api_key'),
                'sender'  => config('services.textlocal.sender'),
                'numbers' => '91' . $request->mobile,
                'message' => "The OTP for logging into Oneflo for Bank Statement Analysis is $otp and is valid for " . config('services.textlocal.expiry_time_min') . " minutes. Do not share the OTP with anyone.",
            ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Failed to send OTP. Try again later.'], 500);
            }
        }
        //$responseBody = $response->json();
        //dd($responseBody);
        // Increment resend attempts
        $attemptRecord->increment('attempts', 1);
        $attemptRecord->update(['last_attempt_at' => now()]);

        // Simulate sending OTP via SMS (or log for testing)
        \Log::info("Sending OTP: $otp to mobile number: $mobile");

        $agent = new Agent();

        $eventId = event(new UserOTPNotVerified($request->user(), $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web',$mobile ));

        $eventId = $eventId[0] ?? null;

        return response()->json(['success' => 'OTP sent successfully.','event_id' => $eventId]);
    }


    // Handle OTP request
    public function sendOtp1(Request $request)
    {
        // Validate mobile number
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Retrieve or initialize the resend attempts from the cookie
        $attempts = Cookie::get('resend_attempts', 0);

        if ($attempts >= 3) {
            return response()->json(['error' => 'Too many incorrect attempts. Please try again in 24 hours.'], 429);
        }

        // Generate a unique session ID
        $sessionId = uniqid('otp_', true);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Save OTP in the database
        Otp::updateOrCreate(
            ['mobile' => $request->mobile],
            ['otp' => $otp, 'session_id' => $sessionId, 'expires_at' => now()->addMinutes(10)]
        );

        // Cache the session ID in the cookie
        Cookie::queue(Cookie::make('otp_session', $sessionId, 10)); // Cookie expires in 10 minutes

        // Increment and update resend attempts in the cookie
        Cookie::queue(Cookie::make('resend_attempts', $attempts + 1, 1440)); // Resend attempts expire in 24 hours

        // Check SMS_ON_PRODUCTION flag
        if (config('services.textlocal.on_production')) {
            $response = Http::asForm()->post(config('services.textlocal.base_url'), [
                'apikey'  => config('services.textlocal.api_key'),
                'sender'  => config('services.textlocal.sender'),
                'numbers' => '91' . $request->mobile,
                'message' => "The OTP for logging into Oneflo is $otp and is valid for " . config('services.textlocal.expiry_time_min') . " minutes. Do not share the OTP with anyone.",
            ]);

            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Failed to send OTP. Try again later.'], 500);
            }
        }


        // Simulate sending OTP via SMS (log for testing purposes)
        \Log::info("Sending OTP: $otp to mobile number: " . $request->mobile);

        return response()->json(['success' => 'OTP sent successfully.']);
    }

    // Reset resend attempts (for testing or manual reset, optional)
    public function resetResendAttempts()
    {
        Cookie::queue(Cookie::forget('resend_attempts'));
        return response()->json(['success' => 'Resend attempts reset successfully.']);
    }


    public function sendOtpa(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|digits:10',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'Invalid mobile number'], 422);
            }

            $otp = rand(100000, 999999);
            $mobile = $request->mobile;

            // Check SMS_ON_PRODUCTION flag
            if (config('services.textlocal.on_production')) {

                $response = Http::asForm()->post(config('services.textlocal.base_url'), [
                    'apikey'  => config('services.textlocal.api_key'),
                    'sender'  => config('services.textlocal.sender'),
                    'numbers' => '91' . $mobile,
                    'message' => "The OTP for logging into Oneflo is $otp and is valid for " . config('services.textlocal.expiry_time_min') . " minutes. Do not share the OTP with anyone.",
                ]);

                if ($response->failed()) {
                    return response()->json(['success' => false, 'message' => 'Failed to send OTP. Try again later.'], 500);
                }
            }

            // Save OTP and expiration time
            session([
                'otp'            => $otp,
                'otp_expires_at' => now()->addMinutes(5),
                'otp_attempts'   => 0,
            ]);

            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.'], 500);
        }
    }

    public function resendOtp1(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email matches the one for which OTP was generated
        if (Session::get('otp_email') !== $request->email) {
            return response()->json(['success' => false, 'message' => 'This email did not request an OTP.'], 400);
        }

        $otp = Session::get('otp');

        try {
            // Resend the existing OTP to the user's email
            Mail::to($request->email)->send(new OtpMail($otp));

            return response()->json(['success' => true, 'message' => 'OTP resent successfully']);
        } catch (\Exception $e) {

            return response()->json([
                'success' => true,
                'message' => 'Failed to resend OTP. Please try again.' . $otp,
                'error' => $e->getMessage() // Display the exception message
            ], 200);
            // return response()->json(['success' => false, 'message' => 'Failed to resend OTP. Please try again.'], 500);
        }
    }

    public function verifyOtp1(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'otp' => 'required|digits:6',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'Please enter a valid OTP.'], 422);
            }

            $otp = session('otp');
            $otpExpiresAt = session('otp_expires_at');
            $otpAttempts = session('otp_attempts');

            // Check OTP expiration
            if (Carbon::now()->greaterThan($otpExpiresAt)) {
                return response()->json(['success' => false, 'message' => 'OTP has expired. Please request a new OTP.'], 400);
            }

            // Check max attempts
            if ($otpAttempts >= 3) {
                return response()->json(['success' => false, 'message' => 'Too many incorrect attempts. Try again in 24 hours.'], 403);
            }

            if ($otp !== $request->otp) {
                session(['otp_attempts' => $otpAttempts + 1]);
                return response()->json(['success' => false, 'message' => 'Incorrect OTP. Please try again.'], 401);
            }

            // OTP is valid
            session(['otp_verified_at' => Carbon::now()]);
            return response()->json(['success' => true, 'message' => 'OTP verified successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.'], 500);
        }
    }


    public function downloadReportSMS(Request $request, $report_id)
    {
        // Get the currently authenticated user ID
        $user_id = auth()->id();

        try {
            // Fetch the report using report_id, user_id, and status
            $report = BsaReport::where('report_id', $report_id)
                ->where('status', 'completed')
                ->first();

            // If no report is found, return an error
            if (!$report) {
                return redirect()->route('signup')->with('error', 'Report not found or not completed.');
            }

            // Check if the report has expired based on SMS_EXPIRY_TIME
            $expiryTime = now()->subHours(env('SMS_EXPIRY_TIME', 24));
            if ($report->created_at < $expiryTime) {
                // Redirect to signup route with a message if expired
                return redirect()->route('signup')->with('error', 'This report has expired and cannot be downloaded.');
            }

            // Get the file name (from the report_url column)
            $fileName = $report->report_url;

            // Call the external API to download the file
            $externalResponse = Http::withHeaders([
                'Accept' => 'application/json',
                'api_id' => 'e67fe92d884c2f9460f1744300739f1b',
                'api_key' => '6e4cf833714519ab7d05d40d37ebb4c1',
            ])->get("https://vaultmine.ai/api/v1/download-file", [
                'file_name' => $fileName,
            ]);

            // Log the external API response for debugging
            \Log::info('External API Response:', [
                'status' => $externalResponse->status(),
                'body_length' => strlen($externalResponse->body()),
                'headers' => $externalResponse->headers(),
            ]);

            // Check if the external API response is successful
            if ($externalResponse->successful()) {
                // Prepare the storage path to save the file
                $storagePath = storage_path('app/public/' . $fileName);

                // Ensure the directory exists
                if (!file_exists(dirname($storagePath))) {
                    mkdir(dirname($storagePath), 0777, true);
                }

                // Save the file content to the storage
                file_put_contents($storagePath, $externalResponse->body());

                // Check if the file has been saved correctly
                if (!file_exists($storagePath)) {
                    return redirect()->route('signup')->with('error', 'Failed to save the downloaded file.');
                }

                // Log the successful saving of the file
                \Log::info('File saved successfully:', ['path' => $storagePath]);

                // Create a response for the file download
                $response = response()->download($storagePath);

                // Set the headers for the download response
                $response->headers->set('Content-Type', 'application/octet-stream');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($storagePath) . '"');

                // Redirect to the homepage after the file is downloaded
                $response->headers->set('Location', '/');  // Set the redirect URL after download

                // Return the response to initiate download and redirect
                return $response;
            } else {
                // Log the error if the external API request fails
                \Log::error('External API Error:', [
                    'status' => $externalResponse->status(),
                    'body' => $externalResponse->body(),
                ]);

                // Redirect to signup route with an error message if API fails
                return redirect()->route('signup')->with('error', 'Failed to fetch the file from the external API.');
            }
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Download Report Error:', ['message' => $e->getMessage()]);

            // Redirect to signup route with an error message
            return redirect()->route('signup')->with('error', 'An error occurred while processing the request.');
        }
    }

    public function downloadReportSMS_v1(Request $request)
    {
        
        $report_id = $request->query('id');

        if (empty($report_id)) {
            //return redirect()->route('signup'); 
            return redirect()->route('signup')->with('error', 'Report not found.');
        }

        try {
            // Fetch the report using report_id, user_id, and status
            $report = BsaReport::where('report_id', $report_id)
                ->where('status', 'completed')
                ->first();

            // If no report is found, return an error
            if (!$report) {
                return redirect()->route('signup')->with('error', 'Report not found or not completed.');
            }

            // Check if the report has expired based on SMS_EXPIRY_TIME
            $expiryTime = now()->subHours(env('SMS_EXPIRY_TIME', 24));
            if ($report->created_at < $expiryTime) {
                // Redirect to signup route with a message if expired
                return redirect()->route('signup')->with('error', 'The link is expired, Login to access Bank Statement Analysis Report');
            }

            // Get the file name (from the report_url column)
            $fileName = $report->report_url;

            // Call the external API to download the file
            $externalResponse = Http::withHeaders([
                'Accept' => 'application/json',
                'api_id' => 'e67fe92d884c2f9460f1744300739f1b',
                'api_key' => '6e4cf833714519ab7d05d40d37ebb4c1',
            ])->get("https://vaultmine.ai/api/v1/download-file", [
                'file_name' => $fileName,
            ]);

            // Log the external API response for debugging
            \Log::info('External API Response:', [
                'status' => $externalResponse->status(),
                'body_length' => strlen($externalResponse->body()),
                'headers' => $externalResponse->headers(),
            ]);

            // Check if the external API response is successful
            if ($externalResponse->successful()) {
                // Prepare the storage path to save the file
                $storagePath = storage_path('app/public/' . $fileName);

                // Ensure the directory exists
                if (!file_exists(dirname($storagePath))) {
                    mkdir(dirname($storagePath), 0777, true);
                }

                // Save the file content to the storage
                file_put_contents($storagePath, $externalResponse->body());

                // Check if the file has been saved correctly
                if (!file_exists($storagePath)) {
                    return redirect()->route('signup')->with('error', 'Failed to save the downloaded file.');
                }

                // Log the successful saving of the file
                \Log::info('File saved successfully:', ['path' => $storagePath]);

                // Create a response for the file download
                $response = response()->download($storagePath);

                // Set the headers for the download response
                $response->headers->set('Content-Type', 'application/octet-stream');
                $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($storagePath) . '"');

                // Redirect to the homepage after the file is downloaded
                $response->headers->set('Location', '/');  // Set the redirect URL after download

                // Return the response to initiate download and redirect
                return $response;
            } else {
                // Log the error if the external API request fails
                \Log::error('External API Error:', [
                    'status' => $externalResponse->status(),
                    'body' => $externalResponse->body(),
                ]);

                // Redirect to signup route with an error message if API fails
                return redirect()->route('signup')->with('error', 'Failed to fetch the file from the external API.');
            }
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Download Report Error:', ['message' => $e->getMessage()]);

            // Redirect to signup route with an error message
            return redirect()->route('signup')->with('error', 'An error occurred while processing the request.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;
use App\Mail\OwnerNotificationMail;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        // Step 1: Validate the request inputs
        try {
            $request->validate([
                'businessName' => 'required|string|max:191',
                'contactNumber' => 'required|digits:10',
                'email' => 'required|email',
                #'statements' => 'nullable|integer|min:0',
                #'message' => 'nullable|string|max:1000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors for debugging
            \Log::error('Validation failed:', $e->errors());
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    
        // Step 2: Attempt to create a contact record
        try {
            $contact = ContactUs::create([
                'business_name' => $request->businessName,
                'contact_number' => $request->contactNumber,
                'email' => $request->email,
                'bank_statements_count' => $request->statements ?? 0,
                'message' => $request->message,
                'user_id' => Auth::id() ?? 0,
            ]);
        } catch (\Exception $e) {
            // Log any exception during record creation
            \Log::error('Error saving contact:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to save your message. Please try again.'], 500);
        }
    
        // Step 3: Queue owner notification email
        try {
            Mail::to(config('mail.owner_email'))->queue(new OwnerNotificationMail($contact));
        } catch (\Exception $e) {
            // Log email sending errors
            \Log::error('Error sending owner notification email:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to send notification to the owner.'], 500);
        }
    
        // Step 4: Queue thank-you email to the customer
        try {
          //  Mail::to($contact->email)->queue(new ThankYouMail($contact));
        } catch (\Exception $e) {
            // Log email sending errors
            \Log::error('Error sending thank-you email to customer:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Failed to send thank-you email.'], 500);
        }
    
        // Step 5: Return a success response
        //return response()->json(['success' => true, 'message' => 'Your message has been sent successfully.']);

        return redirect()->route('thank-you-page')->with('success', 'Your message has been sent successfully.');
    }
    
}

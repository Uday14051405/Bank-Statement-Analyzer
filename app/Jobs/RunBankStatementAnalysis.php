<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\BsaReport;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Jenssegers\Agent\Agent;
use App\Events\BankStatementAnalysisRun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class RunBankStatementAnalysis extends Job
{
    protected $reportId;
    public $tries = 5; // Number of attempts
    public $timeout = 3600; // Maximum runtime in seconds


    public function __construct($reportId)
    {
        $this->reportId = $reportId;
    }

    public function handle()
    {
        $url = config('services.gpu_api.bank_analysis');

        Log::info('Job started for RunBankStatementAnalysis', ['reportId' => $this->reportId]);

        $report = BsaReport::find($this->reportId);

        if (!$report) {
            Log::warning('No report found with the given report ID', ['reportId' => $this->reportId]);
            return; // Exit if the report is not found
        }
        Log::info('Report fetched successfully', ['reportId' => $this->reportId]);
        $report_id = $report->report_id;
        $mobile = $report->mobile_number;
        $apiData = json_decode($report->request_payload, true);
        Log::info('Preparing API request payload', ['payload' => $apiData]);

        try {
            Log::info('Sending API request to bank statement analyzer', ['url' => $url]);
            $response = Http::withHeaders([
                'Accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Accept-Language' => 'en-GB,en-US;q=0.9,en;q=0.8',
                'Origin' => 'https://oneflo.in',
                'Referer' => 'https://oneflo.in/',
                'User-Agent' => 'Mozilla/5.0',
                'api_id' => 'e67fe92d884c2f9460f1744300739f1b',
                'api_key' => '6e4cf833714519ab7d05d40d37ebb4c1',
            ])->post($url, $apiData);
          
            if ($response->successful()) {
                Log::info('API request successful', ['responseHeaders' => $response->headers()]);
                $contentDisposition = $response->header('Content-Disposition');
                $filename = null;

                if ($contentDisposition && preg_match('/filename="(.+)"/', $contentDisposition, $matches)) {
                    $filename = $matches[1];
                }

                if (!$filename) {
                    throw new \Exception('Filename not found in API response headers.');
                }
                Log::info('Filename extracted', ['filename' => $filename]);

                $filePath = storage_path('app/public/' . $filename);
                file_put_contents($filePath, $response->body());

                Log::info('File saved locally', ['filePath' => $filePath]);

                $apiResponse = $this->callUploadExcel($filePath);
                Log::info('File uploaded successfully', ['apiResponse' => $apiResponse]);

                if ($apiResponse['status'] === 200) {
                    $reportUrl = $apiResponse['data'][0];

                    Log::info('Report URL retrieved', ['reportUrl' => $reportUrl]);

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                        Log::info('Temporary file deleted', ['filePath' => $filePath]);
                    }

                    if (config('services.textlocal.on_production')) {

                        Log::info('Sending SMS notification', ['mobile' => $mobile, 'reportUrl' => $reportUrl]);

                        $reportUrlsms = config('services.report.url_sms') . $report_id;

                        $response = Http::asForm()->post(config('services.textlocal.base_url'), [
                            'apikey'  => config('services.textlocal.api_key'),
                            'sender'  => config('services.textlocal.sender'),
                              'numbers' => '91' . $mobile,
                            'message' => "Dear User, Your Bank Statement Analysis on ONEFLO is ready! Click here to access your report: " . $reportUrlsms . "\nLink valid for 72 hours.",
                        ]);

                        Log::info('SMS sent', ['response' => $response->json()]);

                    }


                    $report->update([
                        'response_payload' => json_encode($response->json()),
                        'status' => 'completed',
                        'report_url' => $reportUrl,
                    ]);

                    Log::info('Report updated successfully', ['status' => 'completed']);

                } else {
                    throw new \Exception($response->body());
                }

             


            } else {
                throw new \Exception($response->body());
            }
        } catch (\Exception $e) {
            // Get error details

            Log::error('Error in RunBankStatementAnalysis', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            $errorMessage = $e->getMessage(); // Error message
            $errorLine = $e->getLine();       // Line number where the error occurred
            $errorFile = $e->getFile();       // File where the error occurred
            $errorTrace = $e->getTraceAsString(); // Full stack trace
            
            // Log the error
            \Log::error("Error occurred: {$errorMessage} in file {$errorFile} on line {$errorLine}");
            \Log::error("Stack trace: " . $errorTrace);
            $errorData = json_decode($errorMessage, true);
			if (isset($errorData['error'])) {
				$errorDataVal = $errorData['error'];
			} else {
				$errorDataVal =  "An unexpected error occurred. Please try again!";
			}
            // Save error details in the database
            $report->update([
                'status' => 'failed',
                'response_payload' => json_encode([
                    'error' => $errorDataVal,
                    // 'error_line'    => $errorLine,
                    // 'error_file'    => $errorFile,
                    // 'stack_trace'   => $errorTrace,
                ]),
            ]);

            Log::info('Report updated with failure status', ['status' => 'failed']);
        }
        
    }



    protected function callUploadExcel(string $filePath)
    {
        Log::info('Uploading file to API', ['filePath' => $filePath]);
        $apiUrl = config('services.gpu_api.upload_files');
        $apiId = config('services.gpu_api.api_id');
        $apiKey = config('services.gpu_api.api_key');
        


        // Use the `attach` method for file upload
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'api_id' => $apiId,
            'api_key' => $apiKey,
        ])
            ->attach('files', fopen($filePath, 'r'), basename($filePath))
            //->attach('file_password_map', json_encode($passwordMap))
            ->post($apiUrl);

        if ($response->successful()) {
            Log::info('File upload successful', ['response' => $response->json()]);
            return $response->json();
        } else {
            Log::error('File upload failed', ['responseBody' => $response->body()]);
            throw new \Exception($response->body());
        }
    }
}

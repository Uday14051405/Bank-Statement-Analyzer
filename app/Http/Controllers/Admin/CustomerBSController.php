<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Image;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use App\Models\BsaDocument;
use App\Models\BsaReport;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use App\Events\BankStatementUploaded;
use App\Events\BankStatementSaved;
use App\Events\ContactUsSubmitted;
use App\Events\ReportDownloaded;
use App\Events\BankStatementAnalysisRun;
use Illuminate\Support\Facades\Session;
use App\Jobs\RunBankStatementAnalysis;



class CustomerBSController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:customer-list', ['only' => ['index', 'store']]);
		$this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:customer-delete', ['only' => ['destroy']]);
		$this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);
		$this->middleware('permission:analyze-index', ['only' => ['analyze_index', 'saveDocument', 'analyze_bs', 'analyze_bs_update']]);

		$user_list = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-list';
		})->first();
		$user_create = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-create';
		})->first();
		$user_edit = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-edit';
		})->first();
		$user_delete = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-delete';
		})->first();
		$profile_index = Permission::get()->filter(function ($item) {
			return $item->name == 'profile-index';
		})->first();
		$analyze_index = Permission::get()->filter(function ($item) {
			return $item->name == 'analyze-index';
		})->first();


		if ($user_list == null) {
			Permission::create(['name' => 'customer-list']);
		}
		if ($user_create == null) {
			Permission::create(['name' => 'customer-create']);
		}
		if ($user_edit == null) {
			Permission::create(['name' => 'customer-edit']);
		}
		if ($user_delete == null) {
			Permission::create(['name' => 'customer-delete']);
		}
		if ($profile_index == null) {
			Permission::create(['name' => 'profile-index']);
		}
		if ($analyze_index == null) {
			Permission::create(['name' => 'analyze-index']);
		}
	}


	public function analyze_index()
	{
		$currentDate = now();
		$activeDealsCount = 1;
		$expiredDealsCount = 1;
		$rid = '';
		$user_id = auth()->id();
		$report = BsaReport::where('user_id', $user_id)
			->whereIn('status', ['completed', 'processing'])
			->latest('created_at')
			->first();

		//dd($report);

		// Set runAnalysisStatus based on whether a report is found
		$runAnalysisStatus = $report ? true : false;
		$runAnalysisStatus1 = $report ? true : false;

		$report2 = BsaReport::where('user_id', $user_id)
			->where('notification_status', 0)
			->latest('created_at')
			->first();

		$status = $report2->status ?? 'blank';

		// If no report found, return an error
		if ($status == 'blank') {
			$message = '';
		} elseif ($status == 'failed') {
			$msgpayload = $report2->response_payload ?? '';
			$rid = $report2->id ?? '';
			#$message = $msgpayload . '. Please try again';
			$message = 'Your last analysis process failed. Please try again with the previous process.';
		} elseif ($status == 'processing') {
			$rid = $report2->id ?? '';
			$message = '';
		} elseif ($status == 'completed') {
			$rid = $report2->id ?? '';
			$message = 'Your Bank Statement Analysis is ready. Click on Download Excel to access it.';
		}
		$response = Http::get(config('services.gpu_api.list_banks'));
		$bank_list = $response->json()['banks'];

		return view('frontend.analyze_bs', compact('activeDealsCount', 'expiredDealsCount', 'runAnalysisStatus', 'runAnalysisStatus1', 'status', 'message', 'rid', 'bank_list'));
	}

	public function analyze_index1()
	{
		$currentDate = now();
		$activeDealsCount = 1;
		$expiredDealsCount = 1;
		$rid = '';
		$user_id = auth()->id();
		$report = BsaReport::where('user_id', $user_id)
			->whereIn('status', ['completed', 'processing'])
			->latest('created_at')
			->first();

		//dd($report);

		// Set runAnalysisStatus based on whether a report is found
		$runAnalysisStatus = $report ? true : false;
		$runAnalysisStatus1 = $report ? true : false;

		$report2 = BsaReport::where('user_id', $user_id)
			->where('notification_status', 0)
			->latest('created_at')
			->first();

		$status = $report2->status ?? 'blank';

		// If no report found, return an error
		if ($status == 'blank') {
			$message = '';
		} elseif ($status == 'failed') {
			$msgpayload = $report2->response_payload ?? '';
			$rid = $report2->id ?? '';
			#$message = $msgpayload . '. Please try again';
			$message = 'Your last analysis process failed. Please try again with the previous process.';
		} elseif ($status == 'processing') {
			$rid = $report2->id ?? '';
			$message = '';
		} elseif ($status == 'completed') {
			$rid = $report2->id ?? '';
			$message = 'Your Bank Statement Analysis is ready. Click on Download Excel to access it.';
		}

		$response = Http::get(config('services.gpu_api.list_banks'));
		$bank_list = $response->json()['banks'];

		return view('frontend.analyze_bs1', compact('activeDealsCount', 'expiredDealsCount', 'runAnalysisStatus', 'runAnalysisStatus1', 'status', 'message', 'rid', 'bank_list'));
	}

	public function analyze_index2()
	{
		$currentDate = now();
		$activeDealsCount = 1;
		$expiredDealsCount = 1;
		$rid = '';
		$user_id = auth()->id();
		$report = BsaReport::where('user_id', $user_id)
			->whereIn('status', ['completed', 'processing'])
			->latest('created_at')
			->first();

		//dd($report);

		// Set runAnalysisStatus based on whether a report is found
		$runAnalysisStatus = $report ? true : false;
		$runAnalysisStatus1 = $report ? true : false;

		$report2 = BsaReport::where('user_id', $user_id)
			->where('notification_status', 0)
			->latest('created_at')
			->first();

		$status = $report2->status ?? 'blank';

		// If no report found, return an error
		if ($status == 'blank') {
			$message = '';
		} elseif ($status == 'failed') {
			$msgpayload = $report2->response_payload ?? '';
			$rid = $report2->id ?? '';
			#$message = $msgpayload . '. Please try again';
			$message = 'Your last analysis process failed. Please try again with the previous process.';
		} elseif ($status == 'processing') {
			$rid = $report2->id ?? '';
			$message = '';
		} elseif ($status == 'completed') {
			$rid = $report2->id ?? '';
			$message = 'Your Bank Statement Analysis is ready. Click on Download Excel to access it.';
		}
		$response = Http::get(config('services.gpu_api.list_banks'));
		$bank_list = $response->json()['banks'];

		return view('frontend.analyze_bs2', compact('activeDealsCount', 'expiredDealsCount', 'runAnalysisStatus', 'runAnalysisStatus1', 'status', 'message', 'rid', 'bank_list'));
	}

	public function analyze_index2old()
	{
		//dd('Hello');
		// $user = User::get();
		// return view('admin.dashboard', compact('user'));

		$currentDate = now();
		$activeDealsCount = 1;
		$expiredDealsCount = 1;
		$user_id = auth()->id();
		$report = BsaReport::where('user_id', $user_id)
			->where('status', 'completed')
			->latest('created_at')
			->first();
		// Set runAnalysisStatus based on whether a report is found
		$runAnalysisStatus = $report ? true : false;


		return view('frontend.analyze_bs1', compact('activeDealsCount', 'expiredDealsCount', 'runAnalysisStatus'));
	}

	public function logout(Request $request)
	{
		try {
			if (Auth::check() && (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer'))) {
				$redirect = 'signup';
			} else {
				$redirect = '/';
			}
			Auth::logout();

			return redirect($redirect);
		} catch (\Exception $e) {
			// Log the error for debugging purposes
			\Log::error('Logout failed: ' . $e->getMessage());

			// Optionally, you can set a fallback redirect or a custom error message
			$fallbackRedirect = 'error-page'; // Replace with your desired fallback page
			return redirect($fallbackRedirect)->withErrors(['message' => 'An error occurred during logout. Please try again.']);
		}
	}

	public function saveDocument1(Request $request)
	{
		// Validation
		$validated = $request->validate([
			'bank_name' => 'required|string|max:191',
			'password_protected' => 'nullable|in:Yes,No',
			'password' => 'nullable|string|max:191',
			'file' => 'required|file|mimes:pdf|max:10240', // 10MB max PDF
		]);

		// Check if file is provided and handle upload
		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$fileSizeInMB = $file->getSize() / 1024 / 1024; // Convert to MB

			// Validate file size before uploading
			if ($fileSizeInMB > 10) {
				return response()->json(['error' => 'File size exceeds the maximum limit of 10MB.'], 400);
			}

			// Generate a unique file name
			$uniqueFileName = time() . '_' . $file->getClientOriginalName();
			$filePath = $file->storeAs('documents', $uniqueFileName, 'public');
		}

		// Save document info into the database
		$document = new BsaDocument();
		$document->user_id = auth()->id(); // assuming you are using Laravel's built-in authentication
		$document->mobile_number = $request->user()->mobile_number; // assuming you're using authenticated user's mobile number
		$document->bank_name = $validated['bank_name'];
		$document->file_name = $file->getClientOriginalName();
		$document->unique_file_name = $uniqueFileName;
		$document->max_size = $fileSizeInMB;
		$document->mobile_number = Auth::user()->mobile;
		$document->file_pwd = $validated['password'] ?? null;
		$document->document_url = Storage::url($filePath); // The URL to access the file
		$document->uploaded_user = auth()->id(); // assuming the uploader is the authenticated user
		$document->status = 'active'; // set the status to active
		$document->save();

		return response()->json([
			'success' => 'Document saved successfully.',
			'document_id' => $document->document_id,
		]);
	}


	public function saveDocument(Request $request)
	{
		// Validation
		$validated = $request->validate([
			'document_id' => 'nullable|integer|exists:bsa_documents,document_id', // For updating an existing document
			'emp_name' => 'nullable|string|max:191',
			'bank_name' => 'required|string|max:191',
			'password_protected' => 'nullable|in:Yes,No',
			'password' => 'nullable|string|max:191',
		]);

		try {
			$file_pwd = $request['password'] ?? null;
			// Check if a document ID is provided for update
			if ($request->filled('document_id')) {
				// Fetch the existing document to update
				$document = BsaDocument::findOrFail($validated['document_id']);

				// Fetch existing file data from the document record
				$fileName = $document->file_name;
				$localFilePath = $document->local_document_url;  // Path to the locally stored document
				$uniqueFileName = $document->unique_file_name;    // Unique file name used for storage



				// Construct the full file path in the public directory
				$filePath = public_path("uploads/documents/{$uniqueFileName}");
				//dd($filePath);
				// Check if the file exists in the specified location
				if (!file_exists($filePath)) {
					\Log::error("File not found at: " . $filePath);
					return response()->json(['error' => 'File not found in the expected location.'], 404);
				}

				$bank_name = $request['bank_name'];
				// Prepare password map for upload if the file is password protected
				//$passwordMap = $document->file_pwd ? [$fileName => $document->file_pwd] : [];
				$passwordMap = $file_pwd ? [$uniqueFileName => $file_pwd] : [];

				$fileBankMap = $bank_name ? [$uniqueFileName => $bank_name] : [];

				$fileMetadata = [
					$uniqueFileName => [
						'password' => $file_pwd,
						'bank_code' => $bank_name,
					],
				];


				$apiResponse = $this->callUploadApiV2($filePath, $fileMetadata);
				

				// dd($apiResponse);

				// Check if the external API upload was successful
				if ($apiResponse['status'] === 200) {

					$uploadedFileData = $apiResponse['data']['uploaded_files'][0] ?? null;
					$uploadStatus = $uploadedFileData['status'] ?? '';
					$errorDetails = $uploadedFileData['error_details'] ?? null;
					if ($uploadStatus == 'SUCCESS') {

						$document->document_url = $uploadedFileData['file_path'];
						//$document->document_url = $apiResponse['data'][0]; // Assuming API returns the document URL in 'data'
						$document->upload_status = 's3';  // Set the document status to 'active' after successful upload
						$document->updated_at = now(); // Update the timestamp

						$document->bank_name = $request['bank_name'];
						$document->employer_name = $request['emp_name'] ?? null;
						$document->file_pwd = $request['password'] ?? null;
						$document->password_protected = $request['password_protected'] ?? 'No';


						$document->save(); // Save the updated document

						$agent = new Agent();
						$mobile = Auth::user()->mobile;
						$eventId = event(new BankStatementSaved($request->user(), $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web', $fileName));


						return response()->json([
							'success' => 'Document updated successfully.',
							'document_id' => $document->document_id,
							'document_url' => $document->document_url,
						]);
					} elseif ($uploadStatus == 'FAILED' && $errorDetails) {
						// Handle error case and get detailed error message
						$errorMessage = $errorDetails['error'] ?? 'Unknown error';
						$errorCode = $errorDetails['code'] ?? 'Unknown code';

						//echo "Upload failed: $errorMessage (Code: $errorCode)";
						return response()->json(['error' => $errorMessage], 500);
					} else {
						// Handle API failure
						dd('Hello');
						$errorMessage = $errorDetails['error'] ?? 'Failed to upload file';
						return response()->json(['error' => $errorMessage], 500);
					}
				} else {
					dd('Hello1');
					// Handle API failure
					return response()->json(['error' => 'Failed to upload file to external API.'], 500);
				}
			}

			// If no file is provided, return an error
			return response()->json(['error' => 'No file provided for upload.'], 400);
		} catch (\Exception $e) {
			// Handle any other exceptions
			$errorMessage = $e->getMessage();
			$errorLines = explode("\n", $errorMessage); // Split into lines
			$secondLine = $errorLines[1] ?? $errorMessage; // Get second line if available
			$errorData = json_decode($errorMessage, true);
			if (isset($errorData['error'])) {
				$errorDataVal = $errorData['error'];
			} else {
				$errorDataVal =  "An unknown error occurred. Please try again!";
			}
			return response()->json(['error' => $errorDataVal], 500);
			//return response()->json(['error' => 'Incorrect Password for pdf file'], 500);
		}
	}

	private function callUploadApiV2(string $filePath, array $fileMetadata): array
	{
		$apiUrl = config('services.gpu_api.upload_file_stetement');
		$apiId = config('services.gpu_api.api_id');
		$apiKey = config('services.gpu_api.api_key');

		$response = Http::withHeaders([
			'Accept' => 'application/json',
			'api_id' => $apiId,
			'api_key' => $apiKey,
		])
			->attach('files', fopen($filePath, 'r'), basename($filePath))
			->attach('file_metadata', json_encode($fileMetadata))
			->post($apiUrl);

		if ($response->successful()) {
			return $response->json();
		}

		throw new \Exception($response->body());
	}

	private function callUploadApi(string $filePath, array $passwordMap, array $fileBankMap): array
	{
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
			->attach('file_password_map', json_encode($passwordMap))
			->attach('file_bank_map', json_encode($fileBankMap))
			->post($apiUrl);


		if ($response->successful()) {
			return $response->json();
		} else {
			//throw new \Exception('External API error: ' . $response->body());
			throw new \Exception($response->body());
		}
	}



	public function uploadDocument(Request $request)
	{
		$uniqueFileName = $request->input('unique_file_name');
		$fileName = $request->input('file_name');
		$maxSize = $request->input('max_size');
		$status = $request->input('status');

		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$uniqueFileName = $request->input('unique_file_name');
			$filePath = 'uploads/documents'; // Directory to save files
			//$storedFileName = $uniqueFileName . '.' . $file->getClientOriginalExtension();
			$storedFileName = $uniqueFileName;

			// Store the file in the public/uploads/documents directory
			$file->move(public_path($filePath), $storedFileName);

			$mobile = Auth::user()->mobile;
			DB::table('bsa_documents')->insert([
				'user_id' => auth()->id(),
				'mobile_number' => Auth::user()->mobile, // Replace with dynamic value if needed
				'file_name' => $fileName,
				'unique_file_name' => $uniqueFileName,
				'max_size' => $maxSize,
				'upload_status' => $status,
				'status' => 'active',
				'document_url' => '',
				'local_document_url' => url($filePath . '/' . $storedFileName),
				'bank_name' => '',
				'created_at' => now(),
			]);

			$agent = new Agent();
			$mobile = Auth::user()->mobile;
			$eventId = event(new BankStatementUploaded($request->user(), $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web', $fileName));


			return response()->json(['success' => true, 'message' => 'File uploaded successfully']);
		}

		return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
	}




	public function getDocuments()
	{
		$documents = DB::table('bsa_documents')
			->where('user_id', auth()->id())
			->where('status', '<>', 'deleted')
			->get();

		return response()->json(['success' => true, 'documents' => $documents]);
	}

	public function deleteDocument(Request $request)
	{
		$documentId = $request->input('document_id');
		DB::table('bsa_documents')
			->where('document_id', $documentId)
			->update([
				'status' => 'deleted',
				'deleted_at' => now(),
			]);


		return response()->json(['success' => true]);
	}





	public function runAnalysis(Request $request)
	{
		$request->validate([
			'document_ids' => 'required|array',
			'document_ids.*' => 'exists:bsa_documents,document_id',
		]);

		$documents = BsaDocument::whereIn('document_id', $request->document_ids)->get();

		// Group documents by bank name and prepare API body data
		$groupedDocuments = $documents->groupBy('bank_name')->map(function ($docs, $bankName) {
			return [
				'file_uris' => $docs->pluck('document_url')->toArray(),
			];
		})->values();

		$apiData = [
			'no_of_months_for_analysis' => 3,  // You can adjust this if needed
			'banks' => $groupedDocuments->map(function ($item) {
				return [
					'file_uris' => $item['file_uris'],
				];
			})->toArray(),
		];

		$reportId = $this->generateReportId();

		$bsaReportData = [
			'doc_ids' => json_encode($request->document_ids),
			'request_payload' => json_encode($apiData),
			'response_payload' => null,
			'user_id' => auth()->id(),
			'status' => 'processing',
			'report_id' => $reportId,
			'report_url' => null,
			'mobile_number' => auth()->user()->mobile,
		];

		$bsaReport = BsaReport::create($bsaReportData);



		RunBankStatementAnalysis::dispatch($bsaReport->id);

		$agent = new Agent();
		$mobile = Auth::user()->mobile;
		$eventId = event(new BankStatementAnalysisRun($request->user(), $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web'));

		return response()->json([
			'success' => true,
			'message' => 'Analysis started. You will be notified when the process is completed.',
		]);
	}



	public function downloadReport(Request $request)
	{
		// Get the currently authenticated user ID
		$user_id = auth()->id();

		try {
			// Fetch the latest completed report for the user
			$report = BsaReport::where('user_id', $user_id)
				//->where('status', 'completed')
				->latest('created_at')
				->first();

			$status = $report->status ?? 'blank';
			// If no report found, return an error
			if ($status == 'blank') {
				return response()->json([
					'success' => true,
					'status' => $status,
					'message' => 'No completed or processing report found. Please try again.',
				]);
			} elseif ($status == 'failed') {
				return response()->json([
					'success' => true,
					'status' => $status,
					'message' => 'Your last analysis process failed. Please try again with the previous process.',
				]);
			} elseif ($status == 'processing') {
				return response()->json([
					'success' => true,
					'status' => $status,
					'message' => 'The report is currently being processed. Please check back later.',
				]);
			}


			// Get the file name (from the report_url column)
			$fileName = $report->report_url;
			$apiUrl = config('services.gpu_api.download_file');
			$apiId = config('services.gpu_api.api_id');
			$apiKey = config('services.gpu_api.api_key');
			// Call the external API to download the file
			$externalResponse = Http::withHeaders([
				'Accept' => 'application/json',
				'api_id' => $apiId,
				'api_key' => $apiKey,
			])->get($apiUrl, [
				'file_name' => $fileName,
			]);

			// Log the external response for debugging
			\Log::info('External API Response Status:', ['status' => $externalResponse->status()]);
			\Log::info('External API Response Body Length:', ['body_length' => strlen($externalResponse->body())]);
			\Log::info('External API Response Headers:', ['headers' => $externalResponse->headers()]);

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
					return response()->json(['success' => false, 'error' => 'Failed to save the downloaded file.'], 500);
				}

				// Log the successful saving of the file
				\Log::info('File saved successfully:', ['path' => $storagePath]);

				$agent = new Agent();
				$mobile = Auth::user()->mobile;
				$eventId = event(new ReportDownloaded($request->user(), $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web'));


				// Return the file URL for download
				return response()->json([
					'success' => true,
					'file_url' => asset('storage/' . $fileName),  // The file URL for front-end to download
				]);
			} else {
				// Log the error if the external API request fails
				\Log::error('External API Error:', [
					'status' => $externalResponse->status(),
					'body' => $externalResponse->body(),
				]);
				return response()->json(['success' => false, 'error' => 'Failed to fetch the file from the external API.'], 500);
			}
		} catch (\Exception $e) {
			// Log the exception message
			\Log::error('Download Report Error:', ['message' => $e->getMessage()]);

			// Return a generic error response
			return response()->json(['success' => false, 'error' => 'An error occurred while processing the request.'] . $e->getMessage(), 500);
		}
	}



	public function downloadReportGet(Request $request)
	{
		$user_id = auth()->id();


		// Fetch the latest completed report for the user
		$report = BsaReport::where('user_id', $user_id)
			->where('status', 'completed')
			->latest('created_at')
			->first();

		if (!$report) {
			return response()->json(['error' => 'Report not found'], 404);
		}

		// Get the external file URL from the report record
		$externalFileUrl = $report->report_url;
		$externalApiUrl = config('services.gpu_api.download_file');;


		// Prepare the full URL for debugging purposes
		$fullApiUrl = $externalApiUrl . '?file_name=' . urlencode($externalFileUrl);
		//dd($fullApiUrl);
		// Log the full URL being used for the request (for debugging)
		\Log::info("Full API URL: " . $fullApiUrl);

		// Fetch the file from the external API
		$response = Http::get($externalApiUrl, [
			'file_name' => $externalFileUrl,
		]);

		// Check if the external API call was successful
		if ($response->successful()) {
			$fileContent = $response->body();

			// Log the size of the file content
			\Log::info("External API file content size: " . strlen($fileContent));

			// Get the original filename from the external URL
			$originalFileName = basename($externalFileUrl);
			$agent = new Agent();
			$mobile = Auth::user()->mobile;
			$eventId = event(new ReportDownloaded($request->user(), $request->ip(), $agent->device(), $agent->browser() . ' ' . $agent->version($agent->browser()), request()->header('interface') ?? 'web'));

			// Stream the file content to the user
			return response()->stream(
				function () use ($fileContent) {
					echo $fileContent;
				},
				200,
				[
					'Content-Type' => 'application/octet-stream', // Change to the actual mime type if known (e.g., 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' for xlsx files)
					'Content-Disposition' => 'attachment; filename="' . $originalFileName . '"',
					'Content-Length' => strlen($fileContent),
				]
			);
		}

		// Log the error if the request failed
		\Log::error("Failed to fetch file from external API: " . $response->body());

		return response()->json(['error' => 'Failed to fetch the file from external API'], 500);
	}


	private function storeExcelFile($fileContent)
	{
		// Store the Excel file in storage/app/reports (or any other location you prefer)
		$fileName = 'report_' . uniqid() . '.xlsx';
		$filePath = storage_path('app/reports/' . $fileName);

		// Save the file locally
		file_put_contents($filePath, $fileContent);

		return $fileName;
		// Return the URL to access the file
		//return Storage::url('reports/' . $fileName); // This will return the public URL of the file
	}




	public function generateReportId()
	{
		$today = Carbon::now()->format('d'); // Format date as YYYYMMDD
		$reportId = null;

		do {
			$randomNumber = mt_rand(1000, 9999); // Generate a 4-digit random number
			$potentialId = $today . $randomNumber; // Concatenate today's date and random number
			$exists = BsaReport::where('report_id', $potentialId)->exists(); // Check for duplicates
			if (!$exists) {
				$reportId = $potentialId;
			}
		} while ($exists);

		return $reportId;
	}

	public function updateStatus(Request $request)
	{
		$rid = $request->input('rid');
		$status = $request->input('notification_status');

		// Validate inputs
		if (!in_array($status, [1, 2])) {
			return response()->json(['success' => false, 'message' => 'Invalid notification status.'], 400);
		}

		if (!$rid) {
			return response()->json(['success' => false, 'message' => 'Report ID is required.'], 400);
		}

		// Find the BsaReport by ID and update it
		$report = BsaReport::find($rid);

		if ($report) {
			$report->notification_status = $status;
			$report->save();

			return response()->json(['success' => true, 'message' => 'Notification status updated successfully.']);
		}

		return response()->json(['success' => false, 'message' => 'No report found with the given ID.'], 404);
	}
}

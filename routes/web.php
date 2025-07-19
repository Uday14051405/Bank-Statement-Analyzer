<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvestorController;
use App\Http\Controllers\Admin\RazorpayController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\CreditDetailsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\OtpController;


Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('resend.otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtpforlogin'])->name('verify.otp');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('setlocale/{locale}', function ($lang) {
	\Session::put('locale', $lang);
	return redirect()->back();
})->name('setlocale');

Route::get('/', function () {
	return view('frontend.home');
});

Route::get('/downloadreport/{report_id}', [OtpController::class, 'downloadReportSMS'])->name('downloadreport');
Route::get('/api/v1', [OtpController::class, 'downloadReportSMS_v1'])->name('downloadreport_v1');


Route::get('/report/{report_id}', [OtpController::class, 'downloadReportSMS'])->name('report');


Route::get('/rumbble', function () {
	return view('frontend.home');
});

Route::get('/home', function () {
	return view('frontend.home');
});

Route::get('/privacy-policy', function () {
	return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::get('/terms', function () {
	return view('frontend.terms');
})->name('terms');
Route::get('/policy', function () {
	return view('frontend.policy');
})->name('policy');
Route::get('/contact', function () {
	return view('frontend.contact');
})->name('contact');
Route::get('/thank-you', function () {
	return view('frontend.contact_thank_you');
})->name('thank-you-page');


Route::get('/terms-conditions', function () {
	return view('frontend.terms-conditions');
});

Route::get('/term-conditions', function () {
	return view('frontend.term-conditions');
})->name('term-conditions');


Route::get('/terms-agreement/{id?}', [RazorpayController::class, 'generateAgreement_terms'])->name('terms-agreement');
Route::post('/terms-pdf/{id}', [RazorpayController::class, 'downloadAgreement_terms'])->name('terms-pdf');

Route::get('/return-policy', function () {
	return view('frontend.return-policy');
});

Route::get('/signin', function () {
	if (Auth::check()) {
		return redirect('/admin/dashboard');
	} else {
		return view('frontend.analyze_bs');
	}
});

Route::get('/signup', function () {
	if (Auth::check()) {
		return redirect()->route('analyze_index'); // Use named routes if available
	}
	return view('frontend.signup');
})->name('signup');

Route::get('/signup1', function () {
	if (Auth::check()) {
		return redirect()->route('analyze_index'); // Use named routes if available
	}
	return view('frontend.signup1');
})->name('signup1');



Route::get('/userauth', function () {
	return view('frontend.userauth');
});



Route::get('/userauth1', function () {
	return view('frontend.userbank');
});

Route::get('/admin-login', function () {
	return view('frontend.admin-signin');
});

Route::get('/userauth2', function () {
	return view('frontend.userauth');
});


Route::post('signup', [InvestorController::class, 'signUp'])->name('signup.post');
Route::get('form-pan-details', [InvestorController::class, 'showPanForm'])->name('form-pan-details');
Route::get('form-bank-details', [InvestorController::class, 'showBankForm'])->name('form-bank-details');
Route::get('form-bank-success-details', [InvestorController::class, 'showBankSuccessForm'])->name('form-bank-success-details');
Route::get('form-bank-error-details', [InvestorController::class, 'showBankErrorForm'])->name('form-bank-error-details');
Route::get('form-credit-details', [InvestorController::class, 'showCreditForm'])->name('form-credit-details');
Route::post('form-pan-details', [InvestorController::class, 'savePanForm'])->name('form-pan-details.post');
//Route::post('form-bank-details', [InvestorController::class, 'saveBankForm'])->name('form-bank-details.post');
if (env('APP_ENV') === 'production') {
	Route::post('form-bank-details', [InvestorController::class, 'saveBankForm'])->name('form-bank-details.post');
} else {
	Route::post('form-bank-details', [InvestorController::class, 'saveBankFormDev'])->name('form-bank-details.post');
}


Route::post('form-credit-details', [InvestorController::class, 'saveCreditForm'])->name('form-credit-details.post');
Route::post('/form-details-handle-action', [InvestorController::class, 'handleBankConfirmationAction'])->name('form-details.handle_action');

Route::group(['middleware' => 'language'], function () {

	// Admin Routes
	Route::prefix('admin')->group(function () {

		Route::get('/login', 					[App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
		Route::post('/login', 					[App\Http\Controllers\Auth\LoginController::class, 'login_go'])->name('login_go');

		Route::get('/login_investor', 					[App\Http\Controllers\Auth\LoginController::class, 'login_investor'])->name('login_investor');
		Route::post('/login_investor', 					[App\Http\Controllers\Auth\LoginController::class, 'login_go_investor'])->name('login_go_investor');


		Route::get('/logout', 					[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

		Route::get('forget-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
		Route::post('forget-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

		Route::get('reset-password/{token}', 	[App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
		Route::post('reset-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

		// Admin Authenticated Routes
		Route::group(['middleware' => ['auth']], function () {

			Route::get('/dashboard', 			[App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
			Route::get('/dashboard_home', 			[App\Http\Controllers\Admin\DashboardController::class, 'dashboard_home'])->name('dashboard_home');

			// Profile
			Route::get('/profile', 				[App\Http\Controllers\Admin\UserController::class, 'profile'])->name('profile');
			Route::post('/profile/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile_update'])->name('profile.update');

			// User
			Route::prefix('users')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\UserController::class, 'status_update'])->name('users.status_update');
				Route::get('/export', [App\Http\Controllers\Admin\UserController::class, 'export'])->name('users.export');
			});

			// Role
			Route::prefix('roles')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');
			});

			// Permission
			Route::prefix('permissions')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('permissions.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('permissions.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.destroy');
			});

			// Currency
			Route::prefix('currencies')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CurrencyController::class, 'index'])->name('currencies.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CurrencyController::class, 'create'])->name('currencies.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CurrencyController::class, 'store'])->name('currencies.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CurrencyController::class, 'edit'])->name('currencies.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CurrencyController::class, 'update'])->name('currencies.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CurrencyController::class, 'destroy'])->name('currencies.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CurrencyController::class, 'status_update'])->name('currencies.status_update');
			});

			// Setting
			Route::prefix('setting')->group(function () {
				Route::get('/file-manager/index', 			 [App\Http\Controllers\Admin\FileManagerController::class, 'index'])->name('filemanager.index');
				Route::get('/website-setting/edit', 		 [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('website-setting.edit');
				Route::post('/website-setting/update/{id}',  [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('website-setting.update');
			});

			// CMS category
			Route::prefix('cmscategories')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CMSCategoryController::class, 'index'])->name('cmscategories.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CMSCategoryController::class, 'create'])->name('cmscategories.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CMSCategoryController::class, 'store'])->name('cmscategories.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CMSCategoryController::class, 'edit'])->name('cmscategories.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CMSCategoryController::class, 'update'])->name('cmscategories.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CMSCategoryController::class, 'destroy'])->name('cmscategories.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CMSCategoryController::class, 'status_update'])->name('cmscategories.status_update');
			});

			// CMS Pages
			Route::prefix('cmspages')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CMSPageController::class, 'index'])->name('cmspages.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CMSPageController::class, 'create'])->name('cmspages.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CMSPageController::class, 'store'])->name('cmspages.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CMSPageController::class, 'edit'])->name('cmspages.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CMSPageController::class, 'update'])->name('cmspages.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CMSPageController::class, 'destroy'])->name('cmspages.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CMSPageController::class, 'status_update'])->name('cmspages.status_update');
			});

			// Testimonials
			Route::prefix('testimonials')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
				Route::get('/create', 			[App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
				Route::post('/store', 			[App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\TestimonialController::class, 'edit'])->name('testimonials.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\TestimonialController::class, 'update'])->name('testimonials.update');
				Route::post('/destroy', 		[App\Http\Controllers\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\TestimonialController::class, 'status_update'])->name('testimonials.status_update');
			});

			// Anchor
			Route::prefix('anchor')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\AnchorController::class, 'index'])->name('anchor.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\AnchorController::class, 'create'])->name('anchor.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\AnchorController::class, 'store'])->name('anchor.store');

				Route::get('/get-anchors/{customerId}', [App\Http\Controllers\Admin\AnchorController::class, 'getAnchors'])->name('anchor.getAnchors');

				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\AnchorController::class, 'edit'])->name('anchor.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\AnchorController::class, 'update'])->name('anchor.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\AnchorController::class, 'destroy'])->name('anchor.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\AnchorController::class, 'status_update'])->name('anchor.status_update');
				Route::get('/export', [App\Http\Controllers\Admin\AnchorController::class, 'export'])->name('anchor.export');
			});

			// // Anchor
			// Route::prefix('anchor')->group(function () {
			// 	Route::get('/index', 			[App\Http\Controllers\Admin\AnchorController::class, 'index'])->name('anchor.index');
			// 	Route::get('/create', 			[App\Http\Controllers\Admin\AnchorController::class, 'create'])->name('anchor.create');
			// 	Route::post('/store', 			[App\Http\Controllers\Admin\AnchorController::class, 'store'])->name('anchor.store');
			// 	Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\AnchorController::class, 'edit'])->name('anchor.edit');
			// 	Route::post('/update/{id}', 	[App\Http\Controllers\Admin\AnchorController::class, 'update'])->name('anchor.update');
			// 	Route::post('/destroy', 		[App\Http\Controllers\Admin\AnchorController::class, 'destroy'])->name('anchor.destroy');
			// 	Route::get('/status_update', 	[App\Http\Controllers\Admin\AnchorController::class, 'status_update'])->name('anchor.status_update');
			// });

			// Customer
			Route::prefix('customer')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customer.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customer.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customer.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customer.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CustomerController::class, 'status_update'])->name('customer.status_update');
				Route::get('/export', [App\Http\Controllers\Admin\CustomerController::class, 'export'])->name('customer.export');
				Route::get('/show/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customer.show');
				Route::get('/event_list', [App\Http\Controllers\Admin\CustomerController::class, 'showEvent'])->name('customer.event_list');
				Route::get('/contact_us', [App\Http\Controllers\Admin\CustomerController::class, 'getContacts'])->name('customer.contact_us');
			});

			// Customer
			Route::prefix('deal')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\DealController::class, 'index'])->name('deal.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\DealController::class, 'create'])->name('deal.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\DealController::class, 'store'])->name('deal.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\DealController::class, 'edit'])->name('deal.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\DealController::class, 'update'])->name('deal.update');
				Route::post('/updatebank/{id}', 	[BankDetailsController::class, 'updatebank'])->name('deal.updatebank');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\DealController::class, 'destroy'])->name('deal.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\DealController::class, 'status_update'])->name('deal.status_update');

				Route::get('/view/{id}', 		[App\Http\Controllers\Admin\DealController::class, 'view'])->name('deal.view');
				Route::get('/view_deal/{id}', 			[App\Http\Controllers\Admin\DealController::class, 'view_deal'])->name('deal.view_deal');
				Route::get('/index_invested', 			[App\Http\Controllers\Admin\DealController::class, 'index_invested'])->name('deal.index_invested');
				Route::get('/view_invested_deal/{id}', 			[App\Http\Controllers\Admin\DealController::class, 'view_invested_deal'])->name('deal.view_invested_deal');

				Route::get('/export', [DealController::class, 'export'])->name('deal.export');
			});

			Route::prefix('investor')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\InvestorBackendController::class, 'index'])->name('investor.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\InvestorBackendController::class, 'create'])->name('investor.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\InvestorBackendController::class, 'store'])->name('investor.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\InvestorBackendController::class, 'edit'])->name('investor.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\InvestorBackendController::class, 'update'])->name('investor.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\InvestorBackendController::class, 'destroy'])->name('investor.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\InvestorBackendController::class, 'status_update'])->name('investor.status_update');
				Route::get('/export', [App\Http\Controllers\Admin\InvestorController::class, 'export'])->name('investor.export');
				Route::get('/show/{id}', [App\Http\Controllers\Admin\InvestorBackendController::class, 'show'])->name('investor.show');
			});
			Route::prefix('invest')->group(function () {
				Route::post('create-order', [RazorpayController::class, 'createOrder'])->name('invest.create-order');
				Route::post('payment-success', [RazorpayController::class, 'paymentSuccess'])->name('invest.payment-success');
				Route::post('payment-handle', [RazorpayController::class, 'handlePayment'])->name('invest.payment-handle');
				Route::post('payment-failure', [RazorpayController::class, 'paymentFailure'])->name('invest.payment-failure');
				Route::get('/export', [RazorpayController::class, 'export'])->name('invest.export');
				Route::get('/generate-agreement/{id?}', [RazorpayController::class, 'generateAgreement'])->name('invest.generate-agreement');
				Route::post('/download-pdf/{id}', [RazorpayController::class, 'downloadAgreement'])->name('invest.download-pdf');
			});

			Route::get('/export-payments/{id?}', [PaymentController::class, 'exportPayments'])->name('export.payments');


			Route::get('/bank-details', [BankDetailsController::class, 'index'])->name('bank_details.index');
			Route::post('/bank-details', [BankDetailsController::class, 'store'])->name('bank_details.store');

			Route::get('/bank-details/edit/{id}', [BankDetailsController::class, 'edit'])->name('bank_details.edit');
			Route::post('/bank-details/update', [BankDetailsController::class, 'update'])->name('bank_details.update');
			Route::delete('/bank-details/{id}', [BankDetailsController::class, 'destroy'])->name('bank_details.destroy');


			Route::post('/bank-details/verify/{id}', [BankDetailsController::class, 'verify'])->name('bank_details.verify');



			Route::post('/bank-details/not-received/{id}', [BankDetailsController::class, 'notReceived'])->name('bank_details.not_received');


			Route::get('/bank_status_update', 	[BankDetailsController::class, 'bank_status_update'])->name('bank_status_update');

			Route::get('/credit-details', [CreditDetailsController::class, 'index'])->name('credit_details.index');
			Route::post('/credit-details', [CreditDetailsController::class, 'store'])->name('credit_details.store');
			Route::get('/credit-details/edit/{id}', [CreditDetailsController::class, 'edit'])->name('credit_details.edit');
			Route::post('/credit-details/update', [CreditDetailsController::class, 'update'])->name('credit_details.update');
			Route::delete('/credit-details/{id}', [CreditDetailsController::class, 'destroy'])->name('credit_details.destroy');


			//  Route::get('/export-payments', [PaymentController::class, 'exportPayments'])->name('export.payments');

			Route::prefix('reports')->group(function () {
				Route::get('/mis', [ReportsController::class, 'mis'])->name('reports.misget');
				Route::post('/mis', [ReportsController::class, 'mis'])->name('reports.mis');
				Route::get('/export_payments', [ReportsController::class, 'exportPayments'])->name('reports.export_payments');
				Route::get('/view_mis_details/{id}', [ReportsController::class, 'view_invested_deal'])->name('reports.view_mis_details');
				Route::get('/export', [ReportsController::class, 'export'])->name('reports.export');
			});
		});
	});


	Route::prefix('customer')->group(function () {

		Route::get('/logout', 					[App\Http\Controllers\Admin\CustomerBSController::class, 'logout'])->name('customer_logout');

		Route::post('/contact-us-store', [App\Http\Controllers\Admin\ContactUsController::class, 'store'])->name('contact-us-store');




		// Admin Authenticated Routes
		Route::group(['middleware' => ['auth']], function () {

			Route::get('/dashboard', 			[App\Http\Controllers\Admin\CustomerBSController::class, 'dashboard'])->name('customer_dashboard');
			Route::get('/analyze_index', 			[App\Http\Controllers\Admin\CustomerBSController::class, 'analyze_index'])->name('analyze_index');
			Route::get('/analyze_index1', 			[App\Http\Controllers\Admin\CustomerBSController::class, 'analyze_index1'])->name('analyze_index1');
			Route::get('/analyze_index2', 			[App\Http\Controllers\Admin\CustomerBSController::class, 'analyze_index2'])->name('analyze_index2');


			//Document Upload

			Route::post('/upload-document', [App\Http\Controllers\Admin\CustomerBSController::class, 'uploadDocument'])->name('upload-document');

			Route::get('/get-documents', [App\Http\Controllers\Admin\CustomerBSController::class, 'getDocuments'])->name('get-documents');

			Route::post('/delete-document', [App\Http\Controllers\Admin\CustomerBSController::class, 'deleteDocument'])->name('delete-document');





			Route::post('/save-document', [App\Http\Controllers\Admin\CustomerBSController::class, 'saveDocument'])->name('save-document');

			Route::post('/run-analysis', [App\Http\Controllers\Admin\CustomerBSController::class, 'runAnalysis'])->name('run-analysis')->middleware('read_only_session');

			Route::post('/download-report', [App\Http\Controllers\Admin\CustomerBSController::class, 'downloadReport'])->name('download-report');

			Route::get('/download-report-get', [App\Http\Controllers\Admin\CustomerBSController::class, 'downloadReportGet'])->name('download-report-get');


			Route::post('/update-notification-status', [App\Http\Controllers\Admin\CustomerBSController::class, 'updateStatus'])->name('update-notification-status');


			// Profile
			Route::get('/profile', 				[App\Http\Controllers\Admin\CustomerBSController::class, 'profile'])->name('customer_profile');
			Route::post('/profile/update/{id}', [App\Http\Controllers\Admin\CustomerBSController::class, 'profile_update'])->name('customer_profile.update');
		});
	});
});

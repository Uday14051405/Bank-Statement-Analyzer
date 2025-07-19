<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvestorController;
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


// Frontend Routes
// Route::get('/', 					[App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');



Route::get('/', function () {
	return view('frontend.home');
	// $readmePath = base_path('README.md');

	// return view('welcome', [
	//     'readmeContent' => Str::markdown(file_get_contents($readmePath)),
	// ]);
});

Route::get('/home', function () {
	return view('frontend.home');
});

Route::get('/privacy-policy', function () {
	return view('frontend.privacy-policy');
});

Route::get('/terms-conditions', function () {
	return view('frontend.terms-conditions');
});

Route::get('/return-policy', function () {
	return view('frontend.return-policy');
});

Route::get('/signin', function () {
	return view('frontend.signin');
});

Route::get('/signup', function () {
	return view('frontend.signup');
});

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
Route::post('form-pan-details', [InvestorController::class, 'savePanForm'])->name('form-pan-details.post');
Route::post('form-bank-details', [InvestorController::class, 'saveBankForm'])->name('form-bank-details.post');

Route::group(['middleware' => 'language'], function () {

	// Admin Routes
	Route::prefix('admin')->group(function () {

		Route::get('/login', 					[App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
		Route::post('/login', 					[App\Http\Controllers\Auth\LoginController::class, 'login_go'])->name('login_go');
		Route::get('/logout', 					[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

		Route::get('forget-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
		Route::post('forget-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

		Route::get('reset-password/{token}', 	[App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
		Route::post('reset-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

		// Admin Authenticated Routes
		Route::group(['middleware' => ['auth']], function () {

			Route::get('/dashboard', 			[App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');

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
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\AnchorController::class, 'edit'])->name('anchor.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\AnchorController::class, 'update'])->name('anchor.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\AnchorController::class, 'destroy'])->name('anchor.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\AnchorController::class, 'status_update'])->name('anchor.status_update');
			});

			// Anchor
			Route::prefix('anchor')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\AnchorController::class, 'index'])->name('anchor.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\AnchorController::class, 'create'])->name('anchor.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\AnchorController::class, 'store'])->name('anchor.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\AnchorController::class, 'edit'])->name('anchor.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\AnchorController::class, 'update'])->name('anchor.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\AnchorController::class, 'destroy'])->name('anchor.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\AnchorController::class, 'status_update'])->name('anchor.status_update');
			});

			// Customer
			Route::prefix('customer')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customer.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customer.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customer.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customer.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customer.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CustomerController::class, 'status_update'])->name('customer.status_update');
			});

			// Customer
			Route::prefix('deal')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\DealController::class, 'index'])->name('deal.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\DealController::class, 'create'])->name('deal.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\DealController::class, 'store'])->name('deal.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\DealController::class, 'edit'])->name('deal.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\DealController::class, 'update'])->name('deal.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\DealController::class, 'destroy'])->name('deal.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\DealController::class, 'status_update'])->name('deal.status_update');
			});
		});
	});
});

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_go_old(Request $request)
    {
        $rules = [
            'email'     => 'required|email|max:255',
            'password'  => 'required',
            'remember'  => 'nullable',
        ];

        $messages = [
            'email.required'        => __('auth.form.validation.email.required'),
            'email.email'           => __('auth.form.validation.email.email'),
            'email.exists'          => __('auth.form.validation.email.exists'),
            'password.required'     => __('auth.form.validation.email.required'),
        ];

        $data = $this->validate($request, $rules, $messages);

        if (!isset(request()->remember)) {
            $data['remember'] = "off";
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
            if (Auth::user()->status == 1) {
                Toastr::success('Welcome !');
                #return redirect()->intended('/admin/dashboard');
                if (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer')) {
                    #return redirect()->intended('/admin/deal/index');
                    return redirect()->intended('/admin/dashboard');
                } else {
                    return redirect()->intended('/admin/dashboard');
                }
            } else {
                Auth::logout();
                Toastr::error('Your account is Deactivated by Admin!');
                return redirect()->back();
            }
        } else {
            Toastr::error('Credentials Missmatch!');
            return redirect()->back();
        }
    }

    public function login_go(Request $request)
    {
        $rules = [
            'email'     => 'required|email|max:255',
            'password'  => 'required',
            'remember'  => 'nullable',
        ];

        $messages = [
            'email.required'        => __('auth.form.validation.email.required'),
            'email.email'           => __('auth.form.validation.email.email'),
            'email.exists'          => __('auth.form.validation.email.exists'),
            'password.required'     => __('auth.form.validation.email.required'),
        ];

        $data = $this->validate($request, $rules, $messages);

        if (!isset($request->remember)) {
            $data['remember'] = "off";
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
            if (Auth::user()->status == 1) {
                if (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer')) {
                    Auth::logout();
                    Toastr::error('You do not have the required role to login!');
                    return redirect()->back();
                } else {
                    Toastr::success('Welcome !');
                    return redirect()->intended('/admin/customer/index');
                }
            } else {
                Auth::logout();
                Toastr::error('Your account is Deactivated by Admin!');
                return redirect()->back();
            }
        } else {
            Toastr::error('Credentials Mismatch!');
            return redirect()->back();
        }
    }


    public function login_investor()
    {
        return view('admin.auth.login');
    }

    public function login_go_investor(Request $request)
    {
        $rules = [
            'email'     => 'required|email|max:255',
            'password'  => 'required',
            'remember'  => 'nullable',
        ];

        $messages = [
            'email.required'        => __('auth.form.validation.email.required'),
            'email.email'           => __('auth.form.validation.email.email'),
            'email.exists'          => __('auth.form.validation.email.exists'),
            'password.required'     => __('auth.form.validation.email.required'),
        ];

        $data = $this->validate($request, $rules, $messages);

        if (!isset($request->remember)) {
            $data['remember'] = "off";
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->get('remember'))) {
            if (Auth::user()->status == 1) {
                if (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer')) {
                    Toastr::success('Welcome !');
                    return redirect()->intended('/admin/dashboard');
                } else {
                    Auth::logout();
                    Toastr::error('You do not have the required role to login!');
                    return redirect()->back();
                }
            } else {
                Auth::logout();
                Toastr::error('Your account is Deactivated by Admin!');
                return redirect()->back();
            }
        } else {
            Toastr::error('Credentials Mismatch!');
            return redirect()->back();
        }
    }


    public function logoutold(Request $request)
    {
        if (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer')) {
            $redirect = 'signin';
        } else {
            $redirect = 'admin/login';
        }
        Auth::logout();

        return redirect($redirect);
    }

    // public function logout(Request $request)
    // {
    //     try {
    //         if (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer')) {
    //             $redirect = 'signin';
    //         } else {
    //             $redirect = 'admin/login';
    //         }
    //         Auth::logout();

    //         return redirect($redirect);
    //     } catch (\Exception $e) {
    //         // Log the error for debugging purposes
    //         #\Log::error('Logout failed: ' . $e->getMessage());

    //         // Optionally, you can set a fallback redirect or a custom error message
    //         #$fallbackRedirect = 'error-page'; // Replace with your desired fallback page
    //         #return redirect($fallbackRedirect)->withErrors(['message' => 'An error occurred during logout. Please try again.']);
    //         $redirect = 'signin';
    //         return redirect($redirect);
    //     }
    // }

    public function logout(Request $request)
    {
        try {
            if (Auth::check() && (Auth::user()->hasRole('Investor') || Auth::user()->hasRole('Customer'))) {
                $redirect = 'signin';
            } else {
                $redirect = 'admin/login';
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
}

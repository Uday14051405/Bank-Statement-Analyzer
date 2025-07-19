<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deal;
use App\Models\Payment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $permission = Permission::where('name', 'dashboard')->where('guard_name', 'web')->first();

        // if ($permission) {
        //     $permission->forceDelete();
        //     return response()->json(['message' => 'Permission deleted successfully.']);
        // } else {
        //     return response()->json(['message' => 'Permission not found.'], 404);
        // }
        $this->middleware('permission:dashboard', ['only' => ['dashboard']]);
        $user_list = Permission::get()->filter(function ($item) {
            return $item->name == 'dashboard';
        })->first();

        if ($user_list == null) {
            Permission::create(['name' => 'dashboard']);
        }
    }

    public function dashboard(Request $request)
    {
        $currentDate = now();
        $user = Auth::user();
        $userId = $user->id;
        $login_status = $request->query('login_status', 2);

        if ($user->hasRole('Investor')) {
            // Active Deals
            //$activeDealsCount = Deal::where('deal_due_date', '>=', $currentDate)->where('status', 'Active')->count();

            $activeDealsCount = Deal::where('status', 'Active')
    ->where('deal_due_date', '>=', Carbon::today()) // Ensure due date is today or later
    ->where('deal_live_date', '<=', Carbon::now()) // Ensure deal is live
    ->count();

            // Expired Deals
            #$expiredDealsCount = Deal::where('deal_due_date', '<', $currentDate)->count();
            $expiredDealsCount = Deal::where('status', 'expired')->count();
            // Invested Deals
            $investedDealsCount = Payment::where('status', 'captured')->where('user_id', '=', $userId)->count();

            // Total Investment
            $totalInvestment = Payment::where('status', 'captured')->where('user_id', '=', $userId)->sum('amount');

            return view('admin.dashboard', compact('activeDealsCount', 'expiredDealsCount', 'investedDealsCount', 'totalInvestment', 'login_status'));
        } else {
            // Active Deals
            $activeDealsCount = Deal::where('deal_due_date', '>=', $currentDate)->where('status', 'Active')->count();

            // Expired Deals
           # $expiredDealsCount = Deal::where('deal_due_date', '<', $currentDate)->count();
            $expiredDealsCount = Deal::where('status', 'expired')->count();
            // Invested Deals
            $investedDealsCount = Deal::where('deal_status', 'Invested')->count();

            // Total Investment
            $totalInvestment = Deal::where('deal_status', 'Invested')->sum('invoice_value');

            return view('admin.dashboard', compact('activeDealsCount', 'expiredDealsCount', 'investedDealsCount', 'totalInvestment', 'login_status'));
        }
    }
}

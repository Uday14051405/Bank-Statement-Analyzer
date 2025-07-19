<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PaymentsExport;
use App\Models\Payment;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:deal-list', ['only' => ['index', 'store']]);
        // $this->middleware('permission:deal-invested-list', ['only' => ['index_invested']]);
        // $this->middleware('permission:deal-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:deal-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:deal-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deal-view', ['only' => ['view']]);
        // $this->middleware('permission:deal-view_deal', ['only' => ['view_deal']]);
        // $this->middleware('permission:deal-view_invested_deal', ['only' => ['view_invested_deal']]);
        // $this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

        // $user_list = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-list';
        // })->first();
        // $user_invested_list = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-invested-list';
        // })->first();
        // $user_create = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-create';
        // })->first();
        // $user_edit = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-edit';
        // })->first();
        // $user_delete = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-delete';
        // })->first();
        // $user_view_deal = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-view_deal';
        // })->first();
        // $user_view_invested_deal = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-view_invested_deal';
        // })->first();
        // $user_view = Permission::get()->filter(function ($item) {
        //     return $item->name == 'deal-view';
        // })->first();
        // $profile_index = Permission::get()->filter(function ($item) {
        //     return $item->name == 'profile-index';
        // })->first();


        // if ($user_list == null) {
        //     Permission::create(['name' => 'deal-list']);
        // }
        // if ($user_invested_list == null) {
        //     Permission::create(['name' => 'deal-invested-list']);
        // }
        // if ($user_create == null) {
        //     Permission::create(['name' => 'deal-create']);
        // }
        // if ($user_edit == null) {
        //     Permission::create(['name' => 'deal-edit']);
        // }
        // if ($user_delete == null) {
        //     Permission::create(['name' => 'deal-delete']);
        // }
        // if ($user_view_deal == null) {
        //     Permission::create(['name' => 'deal-view_deal']);
        // }
        // if ($user_view_invested_deal == null) {
        //     Permission::create(['name' => 'deal-view_invested_deal']);
        // }
        // if ($user_view == null) {
        //     Permission::create(['name' => 'deal-view']);
        // }
        // if ($profile_index == null) {
        //     Permission::create(['name' => 'profile-index']);
        // }
    }

    public function exportPayments($id)
    {
        #dd($id);
        $userId = Auth::id();
        #$payments = Payment::all();
        $payments = Payment::where('deal_id', $id)
                            ->where('user_id', $userId)
                            ->get();

        // Pass data to export class and export
        return Excel::download(new PaymentsExport($payments), 'payments.xlsx');
        #return Excel::download(new PaymentsExport(), 'payments.xlsx');
    }
}

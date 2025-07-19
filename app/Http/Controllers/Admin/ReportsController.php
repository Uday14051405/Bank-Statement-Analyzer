<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PaymentsExport;
use App\Exports\MISExport;
use App\Models\Payment;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Deal;
use DataTables;
use Image;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:reports-mis', ['only' => ['mis']]);
        $this->middleware('permission:reports-view_mis_details', ['only' => ['view_mis_details']]);


        $user_reports_mis = Permission::get()->filter(function ($item) {
            return $item->name == 'reports-mis';
        })->first();

        if ($user_reports_mis == null) {
            Permission::create(['name' => 'reports-mis']);
        }

        $user_reports_view_mis_details = Permission::get()->filter(function ($item) {
            return $item->name == 'reports-view_mis_details';
        })->first();

        if ($user_reports_view_mis_details == null) {
            Permission::create(['name' => 'reports-view_mis_details']);
        }
    }

    public function exportPayments()
    {
        #$payments = Payment::all();
        $payments = Payment::getCapturedPaymentsWithDeals();
        // Pass data to export class and export
        #return Excel::download(new MISExport($payments), 'MIS.xlsx');
        $filename = 'MIS_' . Carbon::now()->format('dmY_His') . '.xlsx';

        return Excel::download(new MISExport($payments), $filename);
        #return Excel::download(new PaymentsExport(), 'payments.xlsx');
    }

    public function mis(Request $request)
    {
        $user = Auth::user();
        $main_status = '';
        $userId = auth()->id(); // Get the authenticated user's ID


       # $data = Deal::getDealsWithPaymentsForMIS();
        #$data = Payment::getCapturedPaymentsWithDeals();
        $data = Payment::getCapturedPaymentsWithDealsAndBankDetails();
        #dd($data);
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('company_name', function ($row) {
                    return $row->customer->company_name ?? 'N/A'; // Access company_name through the customer relationship
                })
                ->addColumn('upload_invoice_path', function ($row) {
                    if ($row->upload_invoice == null or empty($row->upload_invoice)) {
                        $image = '';
                    } else {
                        $invoice = asset('storage/' . $row->upload_invoice);
                        $image = '<a href="' . $invoice . '" target="_blank">View</a>';
                    }
                    return $image;
                })

                ->addColumn('view_deal', function ($row) {
                    if (Gate::check('deal-invested-list')) {
                        $view = '<a href="' . route('reports.view_mis_details', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-rupee"></i>
                                        ' . __('default.form.deal-view_invested_deal') . '
                                </a>';
                    } else {
                        $view = '';
                    }
                    return $view;
                })
                ->addColumn('deal_buffer_days_val', function ($row) {
                    // Assuming $row->deal_buffer_days_val contains the buffer days value
                    $buffer_days = $row->deal_buffer_days_val;
                    $buffer_days1 = ($buffer_days <= 0) ? '0' : $buffer_days;
                    $buffer_status = ($buffer_days == 0) ? 'Expiry in Today' : (($buffer_days < 0) ? 'Expired' : '');

                    if ($row->status == 'Invested') {
                        $main_status = 'Invested';
                    } else {
                        if ($buffer_status == 'Expired' or $buffer_status == 'Expiry in Today') {
                            $main_status = $buffer_status;
                        } else {
                            $main_status = $row->status;
                        }
                    }
                    return [
                        'buffer_days' => $buffer_days1,
                        'main_status' => $main_status,
                    ];
                    #return $buffer_days; // or return any other value you want to display
                })
                ->addColumn('credit_card_no', function ($row) {
                    return $row->deal->investorCreditDetails->credit_card_no ?? 'N/A';
                })
                ->addColumn('account_holder_name', function ($row) {
                    return $row->deal->investorBankDetails->account_holder_name ?? 'N/A';
                })
                ->addColumn('account_number', function ($row) {
                    return $row->deal->investorBankDetails->account_number ?? 'N/A';
                })
                ->addColumn('ifsc_code', function ($row) {
                    return $row->deal->investorBankDetails->ifsc_code ?? 'N/A';
                })
                ->addColumn('bank_name', function ($row) {
                    return $row->deal->investorBankDetails->bank_name ?? 'N/A';
                })
                ->addColumn('credit_bank_name', function ($row) {
                    return $row->deal->investorCreditDetails->credit_bank_name ?? 'N/A';
                })
                ->addColumn('nick_name', function ($row) {
                    return $row->deal->investorCreditDetails->nick_name ?? 'N/A';
                })
                ->addColumn('cheque_passbook', function ($row) {
                    if (!empty($row->deal->investorBankDetails->cheque_passbook)) {
                        $cheque_passbook = asset('storage/' . $row->deal->investorBankDetails->cheque_passbook);
                        return '<a href="' . $cheque_passbook . '" target="_blank">View</a>';
                    }
                    return 'N/A';
                })
                ->addColumn('payment_date', function ($row) {
                    // Check if the payment_date is null
                    if (isset($row->deal->payment_date)) {
                        // Format the date using Carbon
                        return Carbon::parse($row->deal->payment_date)->format('jS M Y');
                    } else {
                        // Return a blank if the date is null
                        return '';
                    }
                })
                ->rawColumns(['action', 'image'])
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                #->editColumn('payment_date', '{{date("jS M Y", strtotime($payment_date))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.reports.mis');
    }
}

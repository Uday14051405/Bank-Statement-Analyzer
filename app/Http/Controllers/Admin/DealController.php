<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Deal;
use App\Models\DealPeriod;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Exports\DealsExport;
use App\Models\BankDetails;
use Image;
use Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Http\Controllers\CommonFunctionController;




class DealController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:deal-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:deal-invested-list', ['only' => ['index_invested']]);
        $this->middleware('permission:deal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:deal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deal-delete', ['only' => ['destroy']]);
        $this->middleware('permission:deal-view', ['only' => ['view']]);
        $this->middleware('permission:deal-view_deal', ['only' => ['view_deal']]);
        $this->middleware('permission:deal-view_invested_deal', ['only' => ['view_invested_deal']]);
        $this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

        $user_list = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-list';
        })->first();
        $user_invested_list = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-invested-list';
        })->first();
        $user_create = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-create';
        })->first();
        $user_edit = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-edit';
        })->first();
        $user_delete = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-delete';
        })->first();
        $user_view_deal = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-view_deal';
        })->first();
        $user_view_invested_deal = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-view_invested_deal';
        })->first();
        $user_view = Permission::get()->filter(function ($item) {
            return $item->name == 'deal-view';
        })->first();
        $profile_index = Permission::get()->filter(function ($item) {
            return $item->name == 'profile-index';
        })->first();


        if ($user_list == null) {
            Permission::create(['name' => 'deal-list']);
        }
        if ($user_invested_list == null) {
            Permission::create(['name' => 'deal-invested-list']);
        }
        if ($user_create == null) {
            Permission::create(['name' => 'deal-create']);
        }
        if ($user_edit == null) {
            Permission::create(['name' => 'deal-edit']);
        }
        if ($user_delete == null) {
            Permission::create(['name' => 'deal-delete']);
        }
        if ($user_view_deal == null) {
            Permission::create(['name' => 'deal-view_deal']);
        }
        if ($user_view_invested_deal == null) {
            Permission::create(['name' => 'deal-view_invested_deal']);
        }
        if ($user_view == null) {
            Permission::create(['name' => 'deal-view']);
        }
        if ($profile_index == null) {
            Permission::create(['name' => 'profile-index']);
        }
    }

    private function generateUniqueDealNumber()
    {
        $prefix = 'DL';
        $dealNumber = '';

        do {
            // Generate a random number with 8 digits and prefix with 'DL'
            $dealNumber = $prefix . mt_rand(10000000, 99999999);

            // Check if the deal number already exists
            $exists = DB::table('deals')->where('deal_number', $dealNumber)->exists();
        } while ($exists);

        return $dealNumber;
    }

    public function index_old(Request $request)
    {
        $user = Auth::user();
        $main_status = '';
        if ($user->hasRole('Investor')) {
            # $data = Deal::where('status', 'Active')->get();
            $data = Deal::where('status', 'Active')
                ->where('deal_due_date', '>=', Carbon::today())
                ->get();

            # dd($data);
        } else {
            $data = Deal::all();
        }
        if ($request->ajax()) {
            #$data = Deal::get();
            #$data = Deal::where('role_id', 3)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Gate::check('deal-edit')) {
                        $edit = '<a href="' . route('deal.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        ' . __('default.form.edit-button') . '
                                </a>';
                    } else {
                        $edit = '';
                    }
                    if (Gate::check('deal-delete')) {
                        $delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('deal.destroy') . '">
										<i class="fe fe-trash"></i>
		                                ' . __('default.form.delete-button') . '
									</button>';
                    } else {
                        $delete = '';
                    }
                    $action = $edit . ' ' . $delete;
                    return $action;
                })

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



                    if (Gate::check('deal-view')) {
                        $view = '<a href="' . route('deal.view_deal', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-rupee"></i>
                                        ' . __('default.form.deal-view_deal') . '
                                </a>';
                    } else {
                        $view = '';
                    }
                    return $view;
                })

                // ->addColumn('deal_buffer_days_val', function ($row) {
                //     return $row->deal_buffer_days_val;
                //     #return '';
                // })

                ->addColumn('deal_buffer_days_val', function ($row) {
                    // Assuming $row->deal_buffer_days_val contains the buffer days value
                    $buffer_days = $row->deal_buffer_days_val;

                    // Determine buffer status based on buffer days
                    $buffer_days1 = ($buffer_days <= 0) ? '0' : $buffer_days;
                    $buffer_status = ($buffer_days == 0) ? 'Expiry in Today' : (($buffer_days < 0) ? 'Expired' : '');
                    #Expiry In Today
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

                ->rawColumns(['action', 'image'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.deal.index');
    }


    public function index(Request $request)
    {
        $user = Auth::user();
        $main_status = '';
        $query = Deal::query();

        // if ($user->hasRole('Investor')) {
        //     $query->where('status', 'Active')
        //         ->where('deal_due_date', '>=', Carbon::today());
        // }

        if ($user->hasRole('Investor')) {
            $query->where('status', 'Active')
                ->where('deal_due_date', '>=', Carbon::today())
                ->where('deal_live_date', '<=', Carbon::now()); // Ensure deal is live
        }

        if ($request->filled('deal_status')) {
            $query->where('status', $request->deal_status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $data = $query->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->status == 'Active') {
                        $edit = Gate::check('deal-edit') ? '<a href="' . route('deal.edit', $row->id) . '" class="custom-edit-btn mr-1"><i class="fe fe-pencil"></i>' . __('default.form.edit-button') . '</a>' : '';
                    } else {
                        $edit = ''; // Hide the edit button if not Active
                    }

                    // $delete = Gate::check('deal-delete') ? '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('deal.destroy') . '"><i class="fe fe-trash"></i>' . __('default.form.delete-button') . '</button>' : '';
                    if ($row->status == 'Active' || $row->status == 'Expired') {
                        $delete = Gate::check('deal-delete') ? '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('deal.destroy') . '"><i class="fe fe-trash"></i>' . __('default.form.delete-button') . '</button>' : '';
                    } else {
                        $delete = '';
                    }

                    return $edit . ' ' . $delete;
                })
                ->addColumn('company_name', function ($row) {
                    return $row->customer->company_name ?? 'N/A';
                })
                ->addColumn('anchor_company_name', function ($row) {
                    return $row->anchor->company_name ?? 'N/A';
                })
                ->addColumn('investor_name', function ($row) {
                    return $row->investor->name ?? 'N/A';
                })
                ->addColumn('upload_invoice_path', function ($row) {
                    return $row->upload_invoice ? '<a href="' . asset('storage/' . $row->upload_invoice) . '" target="_blank">View</a>' : '';
                })
                ->addColumn('view_deal', function ($row) use ($user) {
                    if ($user->hasRole('Investor')) {
                        $view = '<a href="' . route('deal.view_deal', $row->id) . '" class="custom-edit-btn mr-1">
                                <i class="fe fe-rupee"></i>
                                ' . __('default.form.deal-view_deal') . '
                            </a>';
                    } else {
                        $view = '<a href="' . route('deal.view_deal', $row->id) . '" class="custom-edit-btn mr-1">
                                <i class="fe fe-rupee"></i>
                                ' . __('default.table.deal-view_deal_view') . '
                            </a>';
                    }
                    return $view;
                })
                ->addColumn('deal_buffer_days_val', function ($row) {
                    // Assuming $row->deal_buffer_days_val contains the buffer days value
                    $buffer_days = $row->deal_buffer_days_val;

                    // Determine buffer status based on buffer days
                    $buffer_days1 = ($buffer_days <= 0) ? '0' : $buffer_days;
                    $buffer_status = ($buffer_days == 0) ? 'Expiry in Today' : (($buffer_days < 0) ? 'Expired' : '');
                    if ($row->status == 'Invested') {
                        $main_status = 'Invested';
                    } elseif ($row->status == 'Expired') {
                        $main_status = 'Expired';
                    } else {
                        if ($buffer_status == 'Expired') {
                            $main_status = $buffer_status;
                        } elseif ($buffer_status == 'Expiry in Today') {
                            $main_status = $buffer_status;
                        } else {
                            $main_status = $row->status;
                        }
                    }
                    return [
                        'buffer_days' => $buffer_days1,
                        'main_status' => $main_status,
                    ];
                })
                ->editColumn('repayment_date', function ($row) {
                    // Check if repayment_date is null or has an invalid date
                    if (is_null($row->repayment_date) || $row->repayment_date === '0000-00-00 00:00:00') {
                        return ''; // Return blank string
                    }

                    // Format the date if it is valid
                    return Carbon::parse($row->repayment_date)->format('d-m-Y');
                })

                ->editColumn('payment_date', function ($row) {
                    // Check if repayment_date is null or has an invalid date
                    if (is_null($row->payment_date) || $row->payment_date === '0000-00-00 00:00:00') {
                        return ''; // Return blank string
                    }

                    // Format the date if it is valid
                    return Carbon::parse($row->payment_date)->format('d-m-Y');
                })

                ->editColumn('invoice_date', function ($row) {
                    return Carbon::parse($row->invoice_date)->format('d-m-Y');
                })
                ->editColumn('deal_due_date', function ($row) {
                    return Carbon::parse($row->deal_due_date)->format('d-m-Y');
                })
                ->editColumn('invoice_due_date', function ($row) {
                    return Carbon::parse($row->invoice_due_date)->format('d-m-Y');
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('jS M Y');
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->format('jS M Y');
                })
                ->rawColumns(['action', 'upload_invoice_path'])
                ->escapeColumns([])
                ->make(true);
        }

        return view('admin.deal.index');
    }
    public function index_invested_old1Aug(Request $request)
    {
        $user = Auth::user();
        $main_status = '';
        $userId = auth()->id(); // Get the authenticated user's ID
        if ($user->hasRole('Investor')) {
            # $data = Deal::where('status', 'Active')->get();
            $data = Deal::getDealsWithPaymentsForUser($userId);

            # dd($data);
        } else {
            #$data = Deal::all();
            $data = Deal::getDealsWithPaymentsForUserAll();
        }


        // if ($user->hasRole('Investor')) {
        //     $data = Deal::where('status', 'Active')->get();
        //    # dd($data);
        // } else {
        //     $data = Deal::all();
        // }
        if ($request->ajax()) {
            #$data = Deal::get();
            #$data = Deal::where('role_id', 3)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Gate::check('deal-edit')) {
                        $edit = '<a href="' . route('deal.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        ' . __('default.form.edit-button') . '
                                </a>';
                    } else {
                        $edit = '';
                    }
                    if (Gate::check('deal-delete')) {
                        $delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('deal.destroy') . '">
										<i class="fe fe-trash"></i>
		                                ' . __('default.form.delete-button') . '
									</button>';
                    } else {
                        $delete = '';
                    }
                    $action = $edit . ' ' . $delete;
                    return $action;
                })

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
                        $view = '<a href="' . route('deal.view_invested_deal', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-rupee"></i>
                                        ' . __('default.form.deal-view_invested_deal') . '
                                </a>';
                    } else {
                        $view = '';
                    }
                    return $view;
                })

                // ->addColumn('deal_buffer_days_val', function ($row) {
                //     return $row->deal_buffer_days_val;
                //     #return '';
                // })

                ->addColumn('deal_buffer_days_val', function ($row) {
                    // Assuming $row->deal_buffer_days_val contains the buffer days value
                    $buffer_days = $row->deal_buffer_days_val;

                    // Determine buffer status based on buffer days
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
                ->editColumn('invoice_date', function ($row) {
                    return Carbon::parse($row->invoice_date)->format('d-m-Y');
                })
                ->editColumn('deal_due_date', function ($row) {
                    return Carbon::parse($row->deal_due_date)->format('d-m-Y');
                })
                ->editColumn('invoice_due_date', function ($row) {
                    return Carbon::parse($row->invoice_due_date)->format('d-m-Y');
                })

                ->editColumn('payment_date', function ($row) {
                    // if (is_null($paymentDate) || trim($paymentDate) === '') {
                    //     return ''; // Return blank if payment_date is null or empty
                    // }
                    return Carbon::parse($row->payment_date)->format('d-m-Y');
                })

                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('jS M Y');
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->format('jS M Y');
                })
                ->rawColumns(['action', 'image'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.deal.index_invested');
    }

    public function index_invested(Request $request)
    {
        $user = Auth::user();
        $main_status = '';
        $userId = auth()->id(); // Get the authenticated user's ID
        if ($user->hasRole('Investor')) {
            $data = Deal::getDealsWithPaymentsForUser($userId);
        } else {
            $data = Deal::getDealsWithPaymentsForUserAll();
        }
        #dd($data);
        // Fetch bank details for the authenticated user
        $bankDetails = BankDetails::where('user_id', $userId)->get();

        if ($request->ajax()) {
            return $data123 = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Gate::check('deal-edit')) {
                        $edit = '<a href="' . route('deal.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                     <i class="fe fe-pencil"></i>
                                         ' . __('default.form.edit-button') . '
                                 </a>';
                    } else {
                        $edit = '';
                    }
                    if (Gate::check('deal-delete')) {
                        $delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('deal.destroy') . '">
                                         <i class="fe fe-trash"></i>
                                         ' . __('default.form.delete-button') . '
                                     </button>';
                    } else {
                        $delete = '';
                    }
                    $action = $edit . ' ' . $delete;
                    return $action;
                })
                ->addColumn('investor_name', function ($row) {
                    return $row->investor->name ?? 'N/A';
                })
                ->addColumn('company_name', function ($row) {
                    return $row->customer->company_name ?? 'N/A';
                })
                ->addColumn('anchor_company_name', function ($row) {
                    return $row->anchor->company_name ?? 'N/A';
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
                        $view = '<a href="' . route('deal.view_invested_deal', $row->id) . '" class="custom-edit-btn mr-1">
                                     <i class="fe fe-rupee"></i>
                                         ' . __('default.form.deal-view_invested_deal') . '
                                 </a>';
                    } else {
                        $view = '';
                    }
                    return $view;
                })
                ->addColumn('deal_buffer_days_val', function ($row) {
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
                })


                // ->addColumn('select_bank_name', function ($row) use ($bankDetails) {
                //     $options = '<option value="">Select Bank</option>';
                //     $currentDate = Carbon::now();
                //     $invoiceDueDate = Carbon::parse($row->invoice_due_date);
                //     $diff = $currentDate->diffInDays($invoiceDueDate, true);
                //     $isDisabled = $diff <= 1;

                //     // Debug output (remove after testing)
                //     #dd($currentDate, $invoiceDueDate, $diff, $isDisabled);
                //     // Calculate if today is within two days before the invoice_due_date
                //     $currentDate = Carbon::now();
                //     $invoiceDueDate = Carbon::parse($row->invoice_due_date);
                //     $bank_update_count = $row->bank_update_count;
                //     #dd($invoiceDueDate);
                //     $disableSelect = ($bank_update_count >= 2) ? true : false;
                //         #dd($disableSelect);
                //     foreach ($bankDetails as $bank) {
                //         $selected = ($row->investor_bank_id == $bank->id) ? 'selected' : '';
                //         $options .= '<option value="' . $bank->id . '" ' . $selected . '>' . $bank->nick_name . '</option>';
                //     }

                //     // Disable the select input if the condition is met
                //     $disabledAttribute = $disableSelect ? 'disabled' : '';

                //     return '<select class="form-control select-bank-name" data-id="' . $row->id . '" ' . $disabledAttribute . '>' . $options . '</select>';
                // })


                ->addColumn('select_bank_name', function ($row) use ($user) {
                    $bankDetails = BankDetails::where('user_id', $row->investor_id)->where('status', 'Verified')->get();
                    $options = '<option value="">Select Bank</option>';
                    $currentDate = Carbon::now();
                    $invoiceDueDate = Carbon::parse($row->invoice_due_date);
                    $diff = $currentDate->diffInDays($invoiceDueDate, true);
                    $isDisabled = $diff <= 1;

                    $bank_update_count = $row->bank_update_count;
                    $disableSelect = ($bank_update_count >= 2) ? true : false;

                    foreach ($bankDetails as $bank) {
                        $selected = ($row->investor_bank_id == $bank->id) ? 'selected' : '';
                        $options .= '<option value="' . $bank->id . '" ' . $selected . '>' . $bank->bank_name . '</option>';
                    }

                    // Disable the select input if the condition is met

                    if ($user->hasRole('Investor')) {
                        $disabledAttribute = $disableSelect ? 'disabled' : '';
                    } else {
                        $disabledAttribute = '';
                    }



                    return '<select class="form-control select-bank-name" data-id="' . $row->id . '" ' . $disabledAttribute . '>' . $options . '</select>';
                })

                ->editColumn('repayment_date', function ($row) {
                    // Check if repayment_date is null or has an invalid date
                    if (is_null($row->repayment_date) || $row->repayment_date === '0000-00-00 00:00:00') {
                        return ''; // Return blank string
                    }

                    // Format the date if it is valid
                    return Carbon::parse($row->repayment_date)->format('d-m-Y');
                })

                ->editColumn('invoice_date', function ($row) {
                    return Carbon::parse($row->invoice_date)->format('d-m-Y');
                })
                ->editColumn('deal_due_date', function ($row) {
                    return Carbon::parse($row->deal_due_date)->format('d-m-Y');
                })
                ->editColumn('invoice_due_date', function ($row) {
                    return Carbon::parse($row->invoice_due_date)->format('d-m-Y');
                })
                ->editColumn('payment_date', function ($row) {
                    return Carbon::parse($row->payment_date)->format('d-m-Y');
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('jS M Y');
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->format('jS M Y');
                })
                ->rawColumns(['action', 'image', 'select_bank_name'])
                ->escapeColumns([])
                ->make(true);
        }
        #dd($data123);
        return view('admin.deal.index_invested', compact('bankDetails'));
    }


    public function create()
    {
        $roles = Role::all();
        #$company = User::where('role_id', 3)->select('company_name', 'id')->get();
        $company = User::where('role_id', 3)
            ->where('status', 1)
            ->select('company_name', 'id')
            ->orderBy('id', 'desc') // Order by id in descending order
            ->get();


        $deal_period = DealPeriod::select('value', 'id')->get();
        $anchor = User::where('role_id', 4)->select('company_name', 'id')->get();
        #$crm = User::whereIn('role_id', [5, 6])->select('company_name', 'id')->get();
        $crm = User::select('users.name', 'users.id')
            ->join('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->whereIn('model_has_roles.role_id', [5, 6]);
            })
            ->get();
        return view('admin.deal.create', compact('roles', 'company', 'deal_period', 'anchor', 'crm'));
    }

    public function store(Request $request)
    {
        #dd($request);
        $rules = [
            'select_customer' => 'required',
            'deal_number' => 'required',
            'deal_period' => 'required',
            'deal_due_date_days' => 'required',
            'invoice_number' => 'required',
            'select_customer.*' => 'exists:users,id',
            #'select_anchor.*' => 'exists:users,id',
            'deal_period.*' => 'exists:deal_period,id',
             'select_anchor' => 'required',
            'select_anchor.*' => 'exists:users,id',
            # 'deal_name' => 'required|string|max:255',
            'invoice_value' => 'required|numeric|min:0',
            #'min_investment_amount' => 'required|numeric|min:0',
            # 'deal_expiry_date' => 'required|date|after:today',
            'invoice_date' => 'required|date|before_or_equal:today',
            #'deal_due_date' => 'required|date|after_or_equal:invoice_date',
            'deal_due_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minDate = Carbon::now()->startOfDay();
                    $maxDate = Carbon::now()->addDays(7)->endOfDay();

                    if (Carbon::parse($value)->lt($minDate) || Carbon::parse($value)->gt($maxDate)) {
                        $fail("The Deal Expiry Date must be within today and the next 7 days.");
                    }
                }
            ],

            'deal_live_date' => '',
            'repayment_amount' => '',
            'maturity_amount' => '',
            #'invoice_due_date' => 'required|date|after_or_equal:invoice_date',
            #'deal_buffer_days' => 'required|integer|min:0',
            'yield_returns' => 'required|numeric|min:0|max:100',
            #'rumbble_score' => 'required|numeric|min:0|max:100',
            # 'assign_crm' => 'required',
            #'assign_crm.*' => 'exists:users,id',
            #'upload_invoice' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
      
        // Define custom error messages
        $messages = [
            'select_customer.required' => __('default.form.validation.select_customer.required'),
            'select_customer.*.exists' => __('default.form.validation.select_customer.exists'),
            'select_anchor.required' => __('default.form.validation.select_anchor.required'),
            'select_anchor.*.exists' => __('default.form.validation.select_anchor.exists'),
            'deal_name.required' => __('default.form.validation.deal_name.required'),
            'invoice_value.required' => __('default.form.validation.invoice_value.required'),
            'invoice_value.numeric' => __('default.form.validation.invoice_value.numeric'),
            'invoice_value.min' => __('default.form.validation.invoice_value.min'),
            'min_investment_amount.required' => __('default.form.validation.min_investment_amount.required'),
            'min_investment_amount.numeric' => __('default.form.validation.min_investment_amount.numeric'),
            'min_investment_amount.min' => __('default.form.validation.min_investment_amount.min'),
            'deal_expiry_date.required' => __('default.form.validation.deal_expiry_date.required'),
            'deal_expiry_date.date' => __('default.form.validation.deal_expiry_date.date'),
            'deal_expiry_date.after' => __('default.form.validation.deal_expiry_date.after'),
            'invoice_date.required' => __('default.form.validation.invoice_date.required'),
            'invoice_date.date' => __('default.form.validation.invoice_date.date'),
            'invoice_date.before' => __('default.form.validation.invoice_date.before'),
            'deal_due_date.required' => __('default.form.validation.deal_due_date.required'),
            'deal_due_date.date' => __('default.form.validation.deal_due_date.date'),
            'deal_due_date.after_or_equal' => __('default.form.validation.deal_due_date.after_or_equal'),
            'invoice_due_date.required' => __('default.form.validation.invoice_due_date.required'),
            'invoice_due_date.date' => __('default.form.validation.invoice_due_date.date'),
            'invoice_due_date.after_or_equal' => __('default.form.validation.invoice_due_date.after_or_equal'),
            'deal_buffer_days.required' => __('default.form.validation.deal_buffer_days.required'),
            'deal_buffer_days.integer' => __('default.form.validation.deal_buffer_days.integer'),
            'deal_buffer_days.min' => __('default.form.validation.deal_buffer_days.min'),
            'yield_returns.required' => __('default.form.validation.yield_returns.required'),
            'yield_returns.numeric' => __('default.form.validation.yield_returns.numeric'),
            'yield_returns.min' => __('default.form.validation.yield_returns.min'),
            'yield_returns.max' => __('default.form.validation.yield_returns.max'),
            'rumbble_score.required' => __('default.form.validation.rumbble_score.required'),
            'rumbble_score.numeric' => __('default.form.validation.rumbble_score.numeric'),
            'rumbble_score.min' => __('default.form.validation.rumbble_score.min'),
            'rumbble_score.max' => __('default.form.validation.rumbble_score.max'),
            'assign_crm.required' => __('default.form.validation.assign_crm.required'),
            'assign_crm.*.exists' => __('default.form.validation.assign_crm.exists'),
            'upload_invoice.required' => __('default.form.validation.upload_invoice.required'),
            'upload_invoice.file' => __('default.form.validation.upload_invoice.file'),
            'upload_invoice.mimes' => __('default.form.validation.upload_invoice.mimes'),
            'upload_invoice.max' => __('default.form.validation.upload_invoice.max'),
        ];


        $validatedData = $this->validate($request, $rules, $messages);
        $input = request()->all();
        $newDealNumber = $this->generateUniqueDealNumber();

        #dd($validatedData);
        // $input['password'] = Hash::make($input['password']);
        // $input['role_id'] = 3;

        try {
            $deal = new Deal();

            $amounts = CommonFunctionController::calculateAmounts(
                $validatedData['invoice_value'],
                $validatedData['deal_period'],
                $validatedData['yield_returns']
            );
            // Calculate Maturity Amount with rounding up to 2 decimal places
            $maturityAmountWithoutRounding = $amounts['repayment_amount'] ?? '0';
            $yield_returns_amount = $amounts['maturity_amount'] ?? '0';
            $tds_amount1 = $amounts['tds_amount'] ?? '0';
            $maturityAmountWithRounding = round($maturityAmountWithoutRounding, 2);
            $tds_amount = round($tds_amount1, 2);

            $maturityAmountWithRound = round($maturityAmountWithoutRounding);

            #$deal->deal_name = $validatedData['deal_name'];
            $deal->invoice_value = $validatedData['invoice_value'];
            $deal->deal_due_date_days = $validatedData['deal_due_date_days'];
            $deal->min_investment_amount = $validatedData['invoice_value'];
            $deal->deal_expiry_date = date('Y-m-d H:i:s');
            $deal->maturity_amount_roundup = $maturityAmountWithRounding;
            $deal->maturity_amount = $maturityAmountWithRound;
            $deal->yield_returns_amount = $yield_returns_amount;
            $deal->tds_amount = $tds_amount;
            $deal->select_anchor = $validatedData['select_anchor'];
            # $deal->repayment_amount  = $validatedData['repayment_amount '];
            $deal->invoice_date = $validatedData['invoice_date'];
            $deal->deal_due_date = $validatedData['deal_due_date'];
            $deal->deal_live_date = $validatedData['deal_live_date'];
            #$deal->deal_number = $validatedData['deal_number'];
            $deal->deal_number = $newDealNumber;
            #$deal->invoice_due_date = $validatedData['invoice_due_date'];
            $deal->invoice_due_date = $validatedData['deal_due_date'];
            $deal->deal_period = $validatedData['deal_period'];
            $deal->invoice_number = $validatedData['invoice_number'];
            $deal->deal_buffer_days = $validatedData['deal_due_date_days'];
            $deal->yield_returns = $validatedData['yield_returns'];
            #$deal->rumbble_score = $validatedData['rumbble_score'];
            $deal->select_customer = $validatedData['select_customer'];
            #$deal->repayment_date = Carbon::parse($deal->invoice_date)->addDays($deal->deal_period);
            $deal->repayment_date = Carbon::parse($deal->invoice_date)->addDays($deal->deal_period - 1);

            #$deal->select_anchor = $validatedData['select_anchor'];
            #$deal->assign_crm = $validatedData['assign_crm'];
            $deal->save();

            // // Attach the selected customers, anchors, and CRMs
            // $deal->customers()->attach($validatedData['select_customer']);
            // $deal->anchors()->attach($validatedData['select_anchor']);
            // $deal->crms()->attach($validatedData['assign_crm']);

            // Handle file upload
            if ($request->hasFile('upload_invoice')) {
                $file = $request->file('upload_invoice');
                $path = $file->store('invoices', 'public');
                $deal->upload_invoice = $path;
                $deal->save();
            }

            Toastr::success(__('deal.message.store.success'));
            return redirect()->route('deal.index');
        } catch (Exception $e) {
            Toastr::error(__('deal.message.store.error'));
            return redirect()->route('deal.index');
        }
    }

    public function edit($id)
    {
        #$user = Deal::find($id);
        $user = Deal::find($id);
        $user->deal_live_date1 = $user->deal_live_date->format('Y-m-d\TH:i');

        $currentDate = Carbon::now()->startOfDay();

        // Parse the repayment date and set the time to 00:00:00
        $repaymentDate = Carbon::parse($user->repayment_date)->startOfDay();
    
        // Calculate the difference in days
        $days = $currentDate->diffInDays($repaymentDate, false);
        $days = $days + 1;
        // If the difference is negative, set days to 0
        if ($days < 0) {
            $days = 0;
        }
    
        $user->deal_period_pending = $days;
        // Format the dates
        $user->formatted_invoice_date_display = Carbon::parse($user->invoice_date)->format('d/m/Y');
        $user->formatted_invoice_date_input = Carbon::parse($user->invoice_date)->format('Y-m-d');

        $user->formatted_deal_due_date_display = Carbon::parse($user->deal_due_date)->format('d/m/Y');
        $user->formatted_deal_due_date_input = Carbon::parse($user->deal_due_date)->format('Y-m-d');

        $user->formatted_invoice_due_date_display = Carbon::parse($user->invoice_due_date)->format('d/m/Y');
        $user->formatted_invoice_due_date_input = Carbon::parse($user->invoice_due_date)->format('Y-m-d');

        $user->formatted_invoice_live_date_display = Carbon::parse($user->deal_live_date)->format('d/m/Y');
        $user->formatted_invoice_live_date_input = Carbon::parse($user->deal_live_date)->format('Y-m-d');

        // $company = User::where('role_id', 3)
        // ->select('company_name', 'id')
        // ->orderBy('company_name', 'desc') // Order by company_name in descending order
        // ->get();
        $company = User::where('role_id', 3)
            ->where('status', 1)
            ->select('company_name', 'id')
            ->orderBy('id', 'desc') // Order by id in descending order
            ->get();

        $deal_period = DealPeriod::select('value', 'id')->get();
        $anchors = User::where('role_id', 4)->where('status', 1)->select('company_name', 'id')->orderBy('id', 'desc')->get();
        #$crm = User::whereIn('role_id', [5, 6])->select('company_name', 'id')->get();
        $crm = User::select('users.name', 'users.id')
            ->join('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->whereIn('model_has_roles.role_id', [5, 6]);
            })
            ->get();
        $roles = Role::all();
        return view('admin.deal.edit', compact('user', 'roles', 'deal_period', 'company', 'anchors', 'crm'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'select_customer' => 'required',
            'select_anchor' => 'required',
            'deal_period' => 'required',
            'invoice_number' => 'required',
            'deal_due_date_days' => 'required',
            'select_customer.*' => 'exists:users,id',
            'deal_period.*' => 'exists:deal_period,id',
            # 'select_anchor' => 'required',
            #'select_anchor.*' => 'exists:users,id',
            # 'deal_name' => 'required|string|max:255',
            'invoice_value' => 'required|numeric|min:0',
            #'min_investment_amount' => 'required|numeric|min:0',
            # 'deal_expiry_date' => 'required|date|after:today',
            'invoice_date' => 'required|date|before_or_equal:today',
            #'deal_due_date' => 'required|date|after_or_equal:invoice_date',
            'deal_due_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minDate = Carbon::now()->startOfDay();
                    $maxDate = Carbon::now()->addDays(7)->endOfDay();

                    if (Carbon::parse($value)->lt($minDate) || Carbon::parse($value)->gt($maxDate)) {
                        $fail("The Deal Expiry Date must be within today and the next 7 days.");
                    }
                }
            ],

            'deal_live_date' => '',
            'invoice_due_date' => 'required|date|after_or_equal:invoice_date',
            #'deal_buffer_days' => 'required|integer|min:0',
            'yield_returns' => 'required|numeric|min:0|max:100',
            #'rumbble_score' => 'required|numeric|min:0|max:100',
            # 'assign_crm' => 'required',
            #'assign_crm.*' => 'exists:users,id',
            # 'upload_invoice' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        // Define custom error messages
        $messages = [
            'select_customer.required' => __('default.form.validation.select_customer.required'),
            'select_customer.*.exists' => __('default.form.validation.select_customer.exists'),
            'select_anchor.required' => __('default.form.validation.select_anchor.required'),
            'select_anchor.*.exists' => __('default.form.validation.select_anchor.exists'),
            'deal_name.required' => __('default.form.validation.deal_name.required'),
            'invoice_value.required' => __('default.form.validation.invoice_value.required'),
            'invoice_value.numeric' => __('default.form.validation.invoice_value.numeric'),
            'invoice_value.min' => __('default.form.validation.invoice_value.min'),
            'min_investment_amount.required' => __('default.form.validation.min_investment_amount.required'),
            'min_investment_amount.numeric' => __('default.form.validation.min_investment_amount.numeric'),
            'min_investment_amount.min' => __('default.form.validation.min_investment_amount.min'),
            'deal_expiry_date.required' => __('default.form.validation.deal_expiry_date.required'),
            'deal_expiry_date.date' => __('default.form.validation.deal_expiry_date.date'),
            'deal_expiry_date.after' => __('default.form.validation.deal_expiry_date.after'),
            'invoice_date.required' => __('default.form.validation.invoice_date.required'),
            'invoice_date.date' => __('default.form.validation.invoice_date.date'),
            'invoice_date.before' => __('default.form.validation.invoice_date.before'),
            'deal_due_date.required' => __('default.form.validation.deal_due_date.required'),
            'deal_due_date.date' => __('default.form.validation.deal_due_date.date'),
            'deal_due_date.after_or_equal' => __('default.form.validation.deal_due_date.after_or_equal'),
            'invoice_due_date.required' => __('default.form.validation.invoice_due_date.required'),
            'invoice_due_date.date' => __('default.form.validation.invoice_due_date.date'),
            'invoice_due_date.after_or_equal' => __('default.form.validation.invoice_due_date.after_or_equal'),
            'deal_buffer_days.required' => __('default.form.validation.deal_buffer_days.required'),
            'deal_buffer_days.integer' => __('default.form.validation.deal_buffer_days.integer'),
            'deal_buffer_days.min' => __('default.form.validation.deal_buffer_days.min'),
            'yield_returns.required' => __('default.form.validation.yield_returns.required'),
            'yield_returns.numeric' => __('default.form.validation.yield_returns.numeric'),
            'yield_returns.min' => __('default.form.validation.yield_returns.min'),
            'yield_returns.max' => __('default.form.validation.yield_returns.max'),
            'rumbble_score.required' => __('default.form.validation.rumbble_score.required'),
            'rumbble_score.numeric' => __('default.form.validation.rumbble_score.numeric'),
            'rumbble_score.min' => __('default.form.validation.rumbble_score.min'),
            'rumbble_score.max' => __('default.form.validation.rumbble_score.max'),
            'assign_crm.required' => __('default.form.validation.assign_crm.required'),
            'assign_crm.*.exists' => __('default.form.validation.assign_crm.exists'),
            'upload_invoice.required' => __('default.form.validation.upload_invoice.required'),
            'upload_invoice.file' => __('default.form.validation.upload_invoice.file'),
            'upload_invoice.mimes' => __('default.form.validation.upload_invoice.mimes'),
            'upload_invoice.max' => __('default.form.validation.upload_invoice.max'),
        ];

        $this->validate($request, $rules, $messages);
        $input = $request->all();
        $user = Deal::find($id);
        // if ($request->hasFile('upload_invoice')) {
        //     $file = $request->file('upload_invoice');
        //     $path = $file->store('invoices', 'public');
        //     $user->upload_invoice = $path;
        //     $user->save();
        // }
        if ($user->status == 'Invested') {
            $main_status = 'Invested';
        } else {
            if ($input['deal_due_date'] <= now()) {
                $main_status = 'Expired';
            } else {
                $main_status = 'Active';
            }
        }
        #dd($main_status);
        if ($request->hasFile('upload_invoice1')) {
            $file = $request->file('upload_invoice1');
            $path = $file->store('invoices', 'public');
            $user->upload_invoice = $path;
            $user->save();
        }
        $input['status'] = $main_status;
        $input['min_investment_amount'] = $input['invoice_value'];
        $input['deal_period'] = $input['deal_period'];
        $input['invoice_number'] = $input['invoice_number'];
        $input['deal_due_date_days'] = $input['deal_due_date_days'];
        // if ($request->hasFile('cheque_passbook')) {
        // 	$file = $request->file('cheque_passbook');
        // 	$path = $file->store('investor_doc', 'public');
        // 	$user->upload_invoice = $path;
        // 	$user->save();
        // }

        if (empty($input['image'])) {
            $input['image'] = $user->image;
        }

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $user->password;
        }
        #dd($input);

        try {
            $user->update($input);
            #dd($user);
            // $user->roles()->detach(); //delete all the roles
            // if ($request->roles) {
            //     $user->assignRole($request->input('roles'));
            // }

            Toastr::success(__('deal.message.update.success'));
            return redirect()->route('deal.index');
        } catch (Exception $e) {
            Toastr::error(__('deal.message.update.error'));
            return redirect()->route('deal.index');
        }
    }

    public function destroy()
    {
        $id = request()->input('id');
        $all_user = Deal::all();
        $count_all_user = $all_user->count();

        if ($count_all_user <= 1) {
            Toastr::error(__('deal.message.warning_last_user'));
            return redirect()->route('deal.index');
        } else {
            $getuser = Deal::find($id);
            if (!empty($getuser->image)) {
                $image_path = 'storage/' . $getuser->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            try {
                Deal::find($id)->delete();
                return back()->with(Toastr::error(__('deal.message.destroy.success')));
            } catch (Exception $e) {
                $error_msg = Toastr::error(__('deal.message.destroy.error'));
                return redirect()->route('deal.index')->with($error_msg);
            }
        }
    }

    public function profile()
    {
        return view('admin.deal.profile');
    }

    public function profile_update(Request $request, $id)
    {
        $rules = [
            'password'     => 'required|string|min:6|same:confirm-password',
        ];

        $messages = [
            'password.required'        => __('default.form.validation.password.required'),
            'password.same'            => __('default.form.validation.password.same'),
        ];

        $this->validate($request, $rules, $messages);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        try {
            $user = Deal::whereId($id)->update([
                'password' => $input['password']
            ]);

            Toastr::success(__('deal.message.profile.success'));
            return redirect()->route('profile');
        } catch (Exception $e) {
            Toastr::success(__('deal.message.profile.error'));
            return redirect()->route('profile');
        }
    }

    public function status_update(Request $request)
    {
        $user = Deal::find($request->id)->update(['status' => $request->status]);

        if ($request->status == 1) {
            return response()->json(['message' => 'Status activated successfully.']);
        } else {
            return response()->json(['message' => 'Status deactivated successfully.']);
        }
    }

    public function view_deal($id)
    {
        $deal = Deal::with('customer')->findOrFail($id);
      

        $bank_status = Deal::hasVerifiedBankDetails();
        $deal->bank_status = $bank_status;
        $bankStatusMessage = "Before investing, ensure that you verify your bank details and designate one bank account as the default.";

        $deal->bankStatusMessage = $bankStatusMessage;
        // Format the repayment_date if it's valid
        if (is_null($deal->repayment_date) || $deal->repayment_date === '' || $deal->repayment_date === '0000-00-00 00:00:00') {
            $deal->formatted_repayment_date = ''; // Assign blank string for invalid dates
        } else {
            try {
                // Format the date if it is valid
                $deal->formatted_repayment_date = Carbon::parse($deal->repayment_date)->format('d-m-Y');
            } catch (\Exception $e) {
                // Handle the case where the date parsing fails
                $deal->formatted_repayment_date = ''; // Return blank string or handle the error as needed
            }
        }

        // Format the repayment_date if it's valid
        if (is_null($deal->payment_date) || $deal->payment_date === '' || $deal->payment_date === '0000-00-00 00:00:00') {
            $deal->formatted_payment_date = ''; // Assign blank string for invalid dates
        } else {
            try {
                // Format the date if it is valid
                $deal->formatted_payment_date = Carbon::parse($deal->payment_date)->format('d-m-Y');
            } catch (\Exception $e) {
                // Handle the case where the date parsing fails
                $deal->formatted_payment_date = ''; // Return blank string or handle the error as needed
            }
        }
        $deal_invoice_value = $deal->invoice_value ?? '0';
        $deal_period_days = $deal->calculateDaysToRepayment();
        $deal_yield_return = $deal->yield_returns ?? '0';

        $amountsDeal = $deal->calculateAmounts($deal_invoice_value, $deal_period_days, $deal_yield_return); // Example values

        $maturityAmountDeal = $amountsDeal['maturity_amount'];
        $repaymentAmountDeal = $amountsDeal['repayment_amount'];
        #dd($deal);
        $deal->maturityAmountDeal = $maturityAmountDeal;
        $deal->repaymentAmountDeal = $repaymentAmountDeal;
        $deal->deal_period_days = $deal_period_days;
        #dd($deal);
        return view('admin.deal.view_deal', compact('deal'));
    }

    public function view_invested_deal($id)
    {
        #$deal = Deal::with('customer')->findOrFail($id);
        $user = Auth::user();
        if ($user->hasRole('Investor')) {
            $deal = Deal::getDealWithPayments($id, $user->id);
        } else {
            $deal = Deal::getDealWithPaymentsForAdmin($id, $user->id);
        }

        if (is_null($deal->repayment_date) || $deal->repayment_date === '' || $deal->repayment_date === '0000-00-00 00:00:00') {
            $deal->formatted_repayment_date = ''; // Assign blank string for invalid dates
        } else {
            try {
                // Format the date if it is valid
                $deal->formatted_repayment_date = Carbon::parse($deal->repayment_date)->format('d-m-Y');
            } catch (\Exception $e) {
                // Handle the case where the date parsing fails
                $deal->formatted_repayment_date = ''; // Return blank string or handle the error as needed
            }
        }

        // Format the repayment_date if it's valid
        if (is_null($deal->payment_date) || $deal->payment_date === '' || $deal->payment_date === '0000-00-00 00:00:00') {
            $deal->formatted_payment_date = ''; // Assign blank string for invalid dates
        } else {
            try {
                // Format the date if it is valid
                $deal->formatted_payment_date = Carbon::parse($deal->payment_date)->format('d-m-Y');
            } catch (\Exception $e) {
                // Handle the case where the date parsing fails
                $deal->formatted_payment_date = ''; // Return blank string or handle the error as needed
            }
        }

        return view('admin.deal.view_invested_deal', compact('deal'));
    }
    public function view(Request $request)
    {
        if ($request->ajax()) {
            $data = Deal::get();
            #$data = Deal::where('role_id', 3)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Gate::check('deal-edit')) {
                        $edit = '<a href="' . route('deal.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        ' . __('default.form.edit-button') . '
                                </a>';
                    } else {
                        $edit = '';
                    }
                    if (Gate::check('deal-delete')) {
                        $delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('deal.destroy') . '">
										<i class="fe fe-trash"></i>
		                                ' . __('default.form.delete-button') . '
									</button>';
                    } else {
                        $delete = '';
                    }
                    $action = $edit . ' ' . $delete;
                    return $action;
                })

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

                ->addColumn('deal_buffer_days_val', function ($row) {
                    #return $row->deal_buffer_days_val;
                    return '';
                })

                ->rawColumns(['action', 'image'])

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('admin.deal.index');
    }

    public function exportOld(Request $request)
    {
        $user = Auth::user();
        $query = Deal::query();

        if ($user->hasRole('Investor')) {
            $query->where('status', 'Active')
                ->where('deal_due_date', '>=', Carbon::today());
        }

        if ($request->filled('deal_status')) {
            $query->where('status', $request->deal_status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $deals = $query->get();



        return Excel::download(new DealsExport($deals), 'deals.xlsx');
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $query = Deal::query();

        if ($user->hasRole('Investor')) {
            $query->where('status', 'Active')
                ->where('deal_due_date', '>=', Carbon::today());
        }

        if ($request->filled('deal_status')) {
            $query->where('status', $request->deal_status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $deals = $query->get();

        // Add buffer days calculation
        foreach ($deals as $deal) {
            $buffer_days = $deal->deal_buffer_days_val;
            $buffer_days1 = ($buffer_days <= 0) ? '0' : $buffer_days;
            $buffer_status = ($buffer_days == 0) ? 'Expiry in Today' : (($buffer_days < 0) ? 'Expired' : '');

            if ($deal->status == 'Invested') {
                $main_status = 'Invested';
            } elseif ($deal->status == 'Expired') {
                $main_status = 'Expired';
            } else {
                if ($buffer_status == 'Expired') {
                    $main_status = $buffer_status;
                    $deal->status = 'Expired';
                    $deal->save();
                } elseif ($buffer_status == 'Expiry in Today') {
                    $main_status = $buffer_status;
                } else {
                    $main_status = $deal->status;
                }
            }

            $deal->buffer_days1 = $buffer_days1;
            $deal->main_status = $main_status;
        }

        return Excel::download(new DealsExport($deals), 'deals.xlsx');
    }
}

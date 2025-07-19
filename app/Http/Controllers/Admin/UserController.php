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
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\BankDetails;
use App\Models\CreditDetails;


class UserController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:user-list', ['only' => ['index', 'store']]);
		$this->middleware('permission:user-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
		$this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

		$user_list = Permission::get()->filter(function ($item) {
			return $item->name == 'user-list';
		})->first();
		$user_create = Permission::get()->filter(function ($item) {
			return $item->name == 'user-create';
		})->first();
		$user_edit = Permission::get()->filter(function ($item) {
			return $item->name == 'user-edit';
		})->first();
		$user_delete = Permission::get()->filter(function ($item) {
			return $item->name == 'user-delete';
		})->first();
		$profile_index = Permission::get()->filter(function ($item) {
			return $item->name == 'profile-index';
		})->first();


		if ($user_list == null) {
			Permission::create(['name' => 'user-list']);
		}
		if ($user_create == null) {
			Permission::create(['name' => 'user-create']);
		}
		if ($user_edit == null) {
			Permission::create(['name' => 'user-edit']);
		}
		if ($user_delete == null) {
			Permission::create(['name' => 'user-delete']);
		}
		if ($profile_index == null) {
			Permission::create(['name' => 'profile-index']);
		}
	}

	public function index_old(Request $request)
	{
		if ($request->ajax()) {
			#$data = User::get();
			$data = User::whereDoesntHave('roles', function ($query) {
				$query->whereIn('name', ['Investor', 'Customer', 'Anchor', 'Super Admin']);
			})->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					if (Gate::check('user-edit')) {
						$edit = '<a href="' . route('users.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        ' . __('default.form.edit-button') . '
                                </a>';
					} else {
						$edit = '';
					}
					if (Gate::check('user-delete')) {
						$delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('users.destroy') . '">
										<i class="fe fe-trash"></i>
		                                ' . __('default.form.delete-button') . '
									</button>';
					} else {
						$delete = '';
					}
					$view = '<button class="view-user-btn" data-id="' . $row->id . '">
                            <i class="fe fe-eye view-icon"></i> 
                         </button>';

					return $view . ' ' . $edit . ' ' . $delete;
					// $action = $edit . ' ' . $delete;
					// return $action;
				})

				->addColumn('status', function ($row) {
					if ($row->status == 1) {
						$current_status = 'Checked';
					} else {
						$current_status = '';
					}
					$status = "
                            <input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeUserStatus(event.target, $row->id);' " . $current_status . ">
							<label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
					return $status;
				})

				->addColumn('image', function ($row) {
					if ($row->image == null or empty($row->image)) {
						$image = '<img src="' . asset('/assets/admin/img/default-user.png') . '" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 50px;">';
					} else {
						$image = '<img src="' . asset($row->image) . '" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 60px; height: 45px;">';
					}
					return $image;
				})

				->rawColumns(['action', 'image'])

				->addColumn('role', function ($user) {
					$role = str_replace(array('[', ']'), '', $user->getRoleNames());
					return $role = str_replace(array('"'), ' ', $role);
				})

				->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
				->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
				->escapeColumns([])
				->make(true);
		}
		return view('admin.users.index');
	}

	public function index(Request $request)
{
    if ($request->ajax()) {
        if (Auth::user()->hasRole('Super Admin')) {
            $data = User::get();
        } else {
            $data = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Investor', 'Customer', 'Anchor', 'Super Admin']);
            })->get();
        }
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Gate::check('user-edit')) {
                    $edit = '<a href="' . route('users.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                <i class="fe fe-pencil"></i>
                                    ' . __('default.form.edit-button') . '
                            </a>';
                } else {
                    $edit = '';
                }
                if (Gate::check('user-delete')) {
                    $delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('users.destroy') . '">
                                    <i class="fe fe-trash"></i>
                                    ' . __('default.form.delete-button') . '
                                </button>';
                } else {
                    $delete = '';
                }
                $view = '<button class="view-user-btn" data-id="' . $row->id . '">
                        <i class="fe fe-eye view-icon"></i> 
                     </button>';

                return $view . ' ' . $edit . ' ' . $delete;
            })

            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    $current_status = 'Checked';
                } else {
                    $current_status = '';
                }
                $status = "
                        <input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeUserStatus(event.target, $row->id);' " . $current_status . ">
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                ";
                return $status;
            })

            ->addColumn('image', function ($row) {
                if ($row->image == null or empty($row->image)) {
                    $image = '<img src="' . asset('/assets/admin/img/default-user.png') . '" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 50px;">';
                } else {
                    $image = '<img src="' . asset($row->image) . '" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 60px; height: 45px;">';
                }
                return $image;
            })

            ->rawColumns(['action', 'image'])

            ->addColumn('role', function ($user) {
                $role = str_replace(array('[', ']'), '', $user->getRoleNames());
                return $role = str_replace(array('"'), ' ', $role);
            })

            ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
            ->escapeColumns([])
            ->make(true);
    }
    return view('admin.users.index');
}


	public function create()
	{
		$roles = Role::all();
		return view('admin.users.create', compact('roles'));
	}

	public function store(Request $request)
	{

		$rules = [
			'name' 			=> 'required',
			'email' 		=> 'required|email|unique:users,email',
			'password' 		=> 'required|same:confirm-password',
			'roles' 		=> 'required',
			'mobile' 		=> 'required|string|unique:users,mobile',
			'image' 		=> 'nullable',
		];

		$messages = [
			'name.required'    		=> __('default.form.validation.name.required'),
			'email.required'    	=> __('default.form.validation.email.required'),
			'email.email'    		=> __('default.form.validation.email.email'),
			'email.unique'    		=> __('default.form.validation.email.unique'),
			'password.required'    	=> __('default.form.validation.password.required'),
			'password.same'    		=> __('default.form.validation.password.same'),
			'roles.required'    	=> __('default.form.validation.roles.required'),
			'mobile.required'    	=> __('default.form.validation.mobile.required'),
		];
		$this->validate($request, $rules, $messages);
		$input = $request->all();
		// Process image upload if provided
		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$imageName = time() . '_' . $image->getClientOriginalName();

			// Move the uploaded file to the desired directory
			$image->move(public_path('uploads/users'), $imageName);

			// Store the file path in the database
			$input['image'] = 'uploads/users/' . $imageName;
		}


		$input['password'] = Hash::make($input['password']);

		try {
			$user = User::create($input);

			if ($request->roles) {
				$user->assignRole($request->input('roles'));
			}

			Toastr::success(__('user.message.store.success'));
			return redirect()->route('users.index');
		} catch (Exception $e) {
			Toastr::error(__('user.message.store.error'));
			return redirect()->route('users.index');
		}
	}


	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::all();
		return view('admin.users.edit', compact('user', 'roles'));
	}

	public function update(Request $request, $id)
	{
		#dd($request);
		$rules = [
			'name' 			=> 'required',
			'password' 		=> 'same:confirm-password',
			'roles' 		=> 'required',
			'image' 		=> 'nullable',
		];

		$messages = [
			'name.required'    		=> __('user.form.validation.name.required'),
			'password.required'    	=> __('user.form.validation.password.required'),
			'password.same'    		=> __('user.form.validation.password.same'),
			'roles.required'    	=> __('user.form.validation.roles.required'),
		];


		$this->validate($request, $rules, $messages);
		$input = $request->all();

		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$imageName = time() . '_' . $image->getClientOriginalName();

			// Move the uploaded file to the desired directory
			$image->move(public_path('uploads/users'), $imageName);

			// Store the file path in the database
			$input['image'] = 'uploads/users/' . $imageName;
		}

		$user = User::find($id);

		if (empty($input['image'])) {
			$input['image'] = $user->image;
		}

		if (!empty($input['password'])) {
			$input['password'] = Hash::make($input['password']);
		} else {
			$input['password'] = $user->password;
		}

		try {
			$user->update($input);
			$user->roles()->detach(); //delete all the roles
			if ($request->roles) {
				$user->assignRole($request->input('roles'));
			}

			Toastr::success(__('user.message.update.success'));
			return redirect()->route('users.index');
		} catch (Exception $e) {
			Toastr::error(__('user.message.update.error'));
			return redirect()->route('users.index');
		}
	}

	public function destroy()
	{
		$id = request()->input('id');
		$all_user = User::all();
		$count_all_user = $all_user->count();

		if ($count_all_user <= 1) {
			Toastr::error(__('user.message.warning_last_user'));
			return redirect()->route('users.index');
		} else {
			$getuser = User::find($id);
			if (!empty($getuser->image)) {
				$image_path = 'storage/' . $getuser->image;
				if (File::exists($image_path)) {
					File::delete($image_path);
				}
			}
			try {
				User::find($id)->delete();
				return back()->with(Toastr::error(__('user.message.destroy.success')));
			} catch (Exception $e) {
				$error_msg = Toastr::error(__('user.message.destroy.error'));
				return redirect()->route('users.index')->with($error_msg);
			}
		}
	}

	public function profile(Request $request)
	{
		$bank_status = $request->query('bank_status', 2);

		if (auth()->user()->hasRole('Investor')) {

			$bankDetails = BankDetails::where('user_id', Auth::id())->get();
			$creditDetails = CreditDetails::where('credit_details.user_id', Auth::id())
    ->join('bank_details', 'bank_details.id', '=', 'credit_details.bank_id')
    ->select('credit_details.credit_card_no','credit_details.id','credit_details.credit_bank_name','credit_details.nick_name', 'bank_details.bank_name as bank_name_credit')
    ->get();

        #dd($bankDetails);
			$user = Auth::user();
			$userId = $user->id;
			$user = User::find($userId);
			$roles = Role::all();
			return view('admin.users.profileedit', compact('user', 'roles', 'bankDetails', 'creditDetails', 'bank_status'));
			#return view('admin.users.profileedit');
		} else {
			return view('admin.users.profile');
		}
	}

	public function profile_update(Request $request, $id)
	{
		if (auth()->user()->hasRole('Investor')) {
			$rules = [
				#'name' => 'required',
				#'email' => 'required|email|unique:users,email',
				'password' 		=> 'same:confirm-password',
				'mobile' => 'required|string',
				#'pan_number' => 'required|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
				#'pan_name' => 'required|string|max:255',
				#'account_holder_name' => 'required|string|max:255',
				#'account_number' => 'required|string|max:20',
				#'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
				'image' 		=> 'nullable',
			];


			$messages = [
				'name.required' => __('default.form.validation.name.required'),
				'email.required' => __('default.form.validation.email.required'),
				'email.email' => __('default.form.validation.email.email'),
				'email.unique' => __('default.form.validation.email1.unique'),
				'password.required' => __('default.form.validation.password.required'),
				'password.min' => 'The password must be at least 6 characters.',
				'password.regex' => 'The password must contain at least one special character.',
				'mobile.required' => __('default.form.validation.mobile.required'),
				'pan_name.required'            => __('default.form.validation.pan_name.required'),
				#'account_holder_name.required'            => __('default.form.validation.account_holder_name.required'),
				#'account_number.required'        => __('default.form.validation.account_number.required'),
				#'mobile.ifsc_code'        => __('default.form.validation.ifsc_code.required'),
			];


			$ddd = $this->validate($request, $rules, $messages);

			$input = $request->all();
			$user = User::find($id);
			if ($request->hasFile('image')) {
				$image = $request->file('image');
				$imageName = time() . '_' . $image->getClientOriginalName();

				// Move the uploaded file to the desired directory
				$image->move(public_path('uploads/users'), $imageName);

				// Store the file path in the database
				$input['image'] = 'uploads/users/' . $imageName;
			}

			if ($request->hasFile('cheque_passbook')) {
				$file = $request->file('cheque_passbook');
				$path = $file->store('investor_doc', 'public');
				$user->cheque_pass = $path;
				$user->save();
			}
			if (empty($input['image'])) {
				$input['image'] = $user->image;
			}

			if (!empty($input['password'])) {
				$input['password'] = Hash::make($input['password']);
			} else {
				$input['password'] = $user->password;
			}

			try {
				$user->update($input);
				$user->roles()->detach(); //delete all the roles
				if ($request->roles) {
					$user->assignRole($request->input('roles'));
				}

				Toastr::success(__('user.message.profile.success'));
				return redirect()->route('profile');
			} catch (Exception $e) {
				Toastr::error(__('user.message.profile.error'));
				return redirect()->route('profile');
			}
		} else {
			$rules = [
				'password' 	=> 'required|string|min:6|same:confirm-password',
			];

			$messages = [
				'password.required'    	=> __('default.form.validation.password.required'),
				'password.same'    		=> __('default.form.validation.password.same'),
			];

			$this->validate($request, $rules, $messages);
			$input = $request->all();
			$input['password'] = Hash::make($input['password']);

			try {
				$user = User::whereId($id)->update([
					'password' => $input['password']
				]);

				Toastr::success(__('user.message.profile.success'));
				return redirect()->route('profile');
			} catch (Exception $e) {
				Toastr::success(__('user.message.profile.error'));
				return redirect()->route('profile');
			}
		}
	}

	public function status_update(Request $request)
	{
		$user = User::find($request->id)->update(['status' => $request->status]);

		if ($request->status == 1) {
			return response()->json(['message' => 'Status activated successfully.']);
		} else {
			return response()->json(['message' => 'Status deactivated successfully.']);
		}
	}

	//Frontend Started Investor Signup

	public function showSignUpForm()
	{
		return view('frontend.signup');
	}

	public function signUp(Request $request)
	{
		dd($request);
		$rules = [
			'name' 			=> 'required',
			'email' 		=> 'required|email|unique:users,email',
			'password' 		=> 'required|same:confirm-password',
			'mobile' 		=> 'required|string|unique:users,mobile',
		];

		$messages = [
			'name.required'    		=> __('default.form.validation.name.required'),
			'email.required'    	=> __('default.form.validation.email.required'),
			'email.email'    		=> __('default.form.validation.email.email'),
			'email.unique'    		=> __('default.form.validation.email.unique'),
			'password.required'    	=> __('default.form.validation.password.required'),
			'mobile.required'    	=> __('default.form.validation.mobile.required'),
		];

		$this->validate($request, $rules, $messages);
		$input = request()->all();
		$input['password'] = Hash::make($input['password']);
		$input['role_id'] = 7;
		try {
			$user = User::create($input);
			if ($request->roles) {
				#$user->assignRole($request->input('roles'));
				$user->assignRole('Investor');
			}

			Toastr::success(__('user.message.store.success'));
			return redirect()->route('next-form');
		} catch (Exception $e) {
			Toastr::error(__('user.message.store.error'));
			return redirect()->route('signup');
		}

		Auth::login($user);

		return redirect()->route('next-form');
	}

	public function showNextForm()
	{
		return view('frontend.userauth');
	}

	public function export(Request $request)
	{
		$query = User::query();

		// Apply filters if any
		if ($request->filled('status')) {
			$query->where('status', $request->status);
		}

		if ($request->filled('from_date')) {
			$query->whereDate('created_at', '>=', $request->from_date);
		}

		if ($request->filled('to_date')) {
			$query->whereDate('created_at', '<=', $request->to_date);
		}

		$users = $query->get();

		return Excel::download(new UsersExport($users), 'users.xlsx');
	}
}

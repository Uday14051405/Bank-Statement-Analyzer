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
use App\Models\BankDetails;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvestorExport;

class InvestorBackendController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:investor-list', ['only' => ['index', 'store']]);
		$this->middleware('permission:investor-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:investor-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:investor-delete', ['only' => ['destroy']]);
		$this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

		$user_list = Permission::get()->filter(function ($item) {
			return $item->name == 'investor-list';
		})->first();
		$user_create = Permission::get()->filter(function ($item) {
			return $item->name == 'investor-create';
		})->first();
		$user_edit = Permission::get()->filter(function ($item) {
			return $item->name == 'investor-edit';
		})->first();
		$user_delete = Permission::get()->filter(function ($item) {
			return $item->name == 'investor-delete';
		})->first();
		$profile_index = Permission::get()->filter(function ($item) {
			return $item->name == 'profile-index';
		})->first();


		if ($user_list == null) {
			Permission::create(['name' => 'investor-list']);
		}
		// if ($user_create == null) {
		// 	Permission::create(['name' => 'investor-create']);
		// }
		if ($user_edit == null) {
			Permission::create(['name' => 'investor-edit']);
		}
		if ($user_delete == null) {
			Permission::create(['name' => 'investor-delete']);
		}
		// if ($profile_index == null) {
		// 	Permission::create(['name' => 'profile-index']);
		// }
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			#$data = User::get();
			$data = User::where('role_id', 7)->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$edit = $delete = $view = '';

					if (Gate::check('investor-edit')) {
						$edit = '<a href="' . route('investor.edit', $row->id) . '" class="custom-edit-btn mr-1">
									<i class="fe fe-pencil"></i> ' . __('default.form.edit-button') . '
								</a>';
					}

					if (Gate::check('investor-delete')) {
						$delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('investor.destroy') . '">
										<i class="fe fe-trash"></i> ' . __('default.form.delete-button') . '
									</button>';
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
		return view('admin.investor.index');
	}

	public function export(Request $request)
	{
		$query = User::query();

		// Apply filters if any


		$query->where('role_id', 7);

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

		return Excel::download(new InvestorExport($users), 'InvestorExport.xlsx');
	}

	public function showold($id)
	{
		$user = User::with('roles')->findOrFail($id);

		return response()->json([
			'name' => $user->name,
			'email' => $user->email,
			'mobile' => $user->mobile,
			'role' => implode(', ', $user->getRoleNames()->toArray()),
			'status' => $user->status,
			'created_at' => $user->created_at->format('jS M Y'),
			'updated_at' => $user->updated_at->format('jS M Y'),
			// Add more fields as needed
		]);
	}

	public function show(Request $request)
	{
		// $user = User::findOrFail($request->id);
		// $bankDetails = BankDetails::where('user_id', $request->id)->get();
		// return response()->json($user->getUserDetails());
		$user = User::findOrFail($request->id);
		$bankDetails = BankDetails::where('user_id', $request->id)->get();
		return response()->json([
			'user' => $user->getUserDetails(),
			'bankDetails' => $bankDetails,
		]);
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::all();
		return view('admin.investor.edit', compact('user', 'roles'));
	}

	public function update(Request $request, $id)
	{
		$rules = [
			'name' => 'required',
			#'email' => 'required|email|unique:users,email',
			'password' 		=> 'same:confirm-password',
			#'mobile' => 'required|string|unique:users,mobile',
			'pan_number' => 'required|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
			'pan_name' => 'required|string|max:255',
			'account_holder_name' => 'required|string|max:255',
			'account_number' => 'required|string|max:20',
			'ifsc_code' => 'required|string|max:20|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
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
			'account_holder_name.required'            => __('default.form.validation.account_holder_name.required'),
			'account_number.required'        => __('default.form.validation.account_number.required'),
			'mobile.ifsc_code'        => __('default.form.validation.ifsc_code.required'),
		];


		$this->validate($request, $rules, $messages);
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
		if (empty($input['image'])) {
			$input['image'] = $user->image;
		}
		if ($request->hasFile('cheque_passbook')) {
			$file = $request->file('cheque_passbook');
			$path = $file->store('investor_doc', 'public');
			$user->cheque_pass = $path;
			$user->save();
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

			Toastr::success(__('investor.message.update.success'));
			return redirect()->route('investor.index');
		} catch (Exception $e) {
			Toastr::error(__('investor.message.update.error'));
			return redirect()->route('investor.index');
		}
	}

	public function destroy()
	{
		$id = request()->input('id');
		$all_user = User::all();
		$count_all_user = $all_user->count();

		if ($count_all_user <= 1) {
			Toastr::error(__('investor.message.warning_last_user'));
			return redirect()->route('investor.index');
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
				return back()->with(Toastr::error(__('investor.message.destroy.success')));
			} catch (Exception $e) {
				$error_msg = Toastr::error(__('investor.message.destroy.error'));
				return redirect()->route('investor.index')->with($error_msg);
			}
		}
	}
}

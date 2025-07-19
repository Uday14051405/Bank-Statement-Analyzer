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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;
use App\Models\Event;
use App\Models\ContactUs;
use App\Enums\EventTypeEnum;

class CustomerController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:customer-list', ['only' => ['index', 'store']]);
		$this->middleware('permission:customer-event', ['only' => ['showEvent', 'showEventUnique']]);
		$this->middleware('permission:customer-contact-us', ['only' => ['getContacts']]);
		$this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
		$this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
		$this->middleware('permission:customer-delete', ['only' => ['destroy']]);
		$this->middleware('permission:profile-index', ['only' => ['profile', 'profile_update']]);

		$user_list = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-list';
		})->first();
		
		$customer_contact_us = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-contact-us';
		})->first();
		$user_event_list = Permission::get()->filter(function ($item) {
			return $item->name == 'customer-event';
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


		if ($user_list == null) {
			Permission::create(['name' => 'customer-list']);
		}
		if ($customer_contact_us == null) {
			Permission::create(['name' => 'customer-contact-us']);
		}
		if ($user_event_list == null) {
			Permission::create(['name' => 'customer-event']);
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
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			#$data = User::get();
			$data = User::where('role_id', 3)->get();
			return Datatables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					if (Gate::check('customer-edit')) {
						$edit = '<a href="' . route('customer.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        ' . __('default.form.edit-button') . '
                                </a>';
					} else {
						$edit = '';
					}
					if (Gate::check('customer-delete')) {
						$delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('customer.destroy') . '">
										<i class="fe fe-trash"></i>
		                                ' . __('default.form.delete-button') . '
									</button>';
					} else {
						$delete = '';
					}
					$view = '<a class="view-user-btn" href="' . url('/admin/customer/event_list') . '?mobile=' . $row->mobile . '" data-id="' . $row->id . '">
            <i class="fe fe-eye view-icon"></i>
         </a>';


					#return $view . ' ' . $edit . ' ' . $delete;
					return  $view . ' ' .$delete;

					#return $action;
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

				// ->addColumn('image', function($row){
				//     if ($row->image == null or empty($row->image)) {
				//     	$image = '<img src="/assets/admin/img/default-user.png" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 50px;">';
				//     }else{
				//     	$image = '<img src="'.$row->image.'" class="w-50 rounded-circle img-fluid img-thumbnail" style="max-width: 60px; height: 45px;">';
				//     }
				//     return $image;
				// })

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
		return view('admin.customer.index');
	}

	public function create()
	{
		$anchors = User::where('role_id', 4)->get();
		$roles = Role::all();
		return view('admin.customer.create', compact('roles', 'anchors'));
	}

	public function store(Request $request)
	{
		$rules = [
			'name' 			=> 'required',
			'email' 		=> 'required|email|unique:users,email',
			'password' 		=> 'required|same:confirm-password',
			'roles' 		=> 'required',
			'anchors' 		=> 'required',
			'mobile' 		=> 'required|string|unique:users,mobile',
			'image' 		=> 'nullable',
			'company_name' 			=> 'required',
			'pan_number' 			=> 'required',
		];

		$messages = [
			'name.required'    		=> __('default.form.validation.name.required'),
			'company_name.required'    		=> __('default.form.validation.name.required'),
			'pan_number.required'    		=> __('default.form.validation.name.required'),
			'email.required'    	=> __('default.form.validation.email.required'),
			'email.email'    		=> __('default.form.validation.email.email'),
			'email.unique'    		=> __('default.form.validation.email.unique'),
			'password.required'    	=> __('default.form.validation.password.required'),
			'password.same'    		=> __('default.form.validation.password.same'),
			'roles.required'    	=> __('default.form.validation.roles.required'),
			'mobile.required'    	=> __('default.form.validation.mobile.required'),
		];

		$this->validate($request, $rules, $messages);
		$input = request()->all();
		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$imageName = time() . '_' . $image->getClientOriginalName();

			// Move the uploaded file to the desired directory
			$image->move(public_path('uploads/users'), $imageName);

			// Store the file path in the database
			$input['image'] = 'uploads/users/' . $imageName;
		}
		#dd($input);
		$input['password'] = Hash::make($input['password']);
		$input['role_id'] = 3;

		try {
			$user = User::create($input);
			if ($request->roles) {
				$user->assignRole($request->input('roles'));
			}

			if ($request->anchors) {
				$user->anchors()->sync($request->input('anchors')); // Use sync to update the pivot table
				#$user->assignRole($request->input('roles'));
			}
			Toastr::success(__('customer.message.store.success'));
			return redirect()->route('customer.index');
		} catch (Exception $e) {
			Toastr::error(__('customer.message.store.error'));
			return redirect()->route('customer.index');
		}
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::all();
		$anchors = User::where('role_id', 4)->where('status', 1)->select('company_name', 'id')->orderBy('id', 'desc')->get();
		return view('admin.customer.edit', compact('user', 'roles', 'anchors'));
	}

	public function update(Request $request, $id)
	{
		$rules = [
			'name' 			=> 'required',
			'password' 		=> 'same:confirm-password',
			'roles' 		=> 'required',
			'anchors'          => 'nullable|array', // Ensure anchors is an array if provided
			'anchors.*'        => 'exists:users,id', // Validate that each anchor ID exists in the anchors table
			'image'            => 'nullable|image',

		];

		$messages = [
			'name.required'    		=> __('customer.form.validation.name.required'),
			'password.required'    	=> __('customer.form.validation.password.required'),
			'password.same'    		=> __('customer.form.validation.password.same'),
			'roles.required'    	=> __('customer.form.validation.roles.required'),
		];
		#dd($request);
		$valdata =  $this->validate($request, $rules, $messages);
		#dd($valdata);
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
			if ($request->anchors) {
				#$user->anchors()->sync($request->input('anchors')); // Use sync to update the pivot table
				#$user->assignRole($request->input('roles'));
				$user->anchors()->sync($request->input('anchors', []));
			}
			#$user->anchors()->sync($request->input('anchors', []));
			Toastr::success(__('customer.message.update.success'));
			return redirect()->route('customer.index');
		} catch (Exception $e) {
			Toastr::error(__('customer.message.update.error'));
			return redirect()->route('customer.index');
		}
	}

	public function destroy()
	{
		$id = request()->input('id');
		$all_user = User::all();
		$count_all_user = $all_user->count();

		if ($count_all_user <= 1) {
			Toastr::error(__('customer.message.warning_last_user'));
			return redirect()->route('customer.index');
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
				return back()->with(Toastr::error(__('customer.message.destroy.success')));
			} catch (Exception $e) {
				$error_msg = Toastr::error(__('customer.message.destroy.error'));
				return redirect()->route('customer.index')->with($error_msg);
			}
		}
	}

	public function profile()
	{
		return view('admin.customer.profile');
	}

	public function profile_update(Request $request, $id)
	{
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

			Toastr::success(__('customer.message.profile.success'));
			return redirect()->route('profile');
		} catch (Exception $e) {
			Toastr::success(__('customer.message.profile.error'));
			return redirect()->route('profile');
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

	public function export(Request $request)
	{
		$query = User::query();

		// Apply filters if any


		$query->where('role_id', 3);

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

		return Excel::download(new CustomerExport($users), 'CustomerExport.xlsx');
	}

	public function show(Request $request)
	{
		// $user = User::findOrFail($request->id);
		// $bankDetails = BankDetails::where('user_id', $request->id)->get();
		// return response()->json($user->getUserDetails());
		$user = User::findOrFail($request->id);
		//dd($user->getUserDetails());
		//$bankDetails = BankDetails::where('user_id', $request->id)->get();
		$bankDetails = '';
		return response()->json([
			'user' => $user->getUserDetails(),
			'bankDetails' => $bankDetails,
		]);
	}

	public function showEvent1(Request $request)
	{
		if ($request->ajax()) {
			$data = Event::with('user')->get();

			return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$delete = '<button class="custom-delete-btn remove-event" data-id="' . $row->id . '">
                                    <i class="fe fe-trash"></i> Delete
                                </button>';
					return $delete;
				})
				->addColumn('user', function ($row) {
					return $row->user ? $row->user->name : 'N/A';
				})
				->addColumn('status', function ($row) {
					$currentStatus = $row->status ? 'checked' : '';
					return "<input type='checkbox' data-id='{$row->id}' class='toggle-status' {$currentStatus}>";
				})
				->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
				->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
				->rawColumns(['action', 'status'])
				->make(true);
		}
		return view('admin.customer.event');
	}

	public function showEvent(Request $request)
	{
		$mobile = $request->query('mobile') ?? '';
		if ($request->ajax()) {
			$query = Event::query();
			$status = $request->deal_status ?? '';

			$eventType = collect(EventTypeEnum::cases())->firstWhere('name', $status);

			$deal_status = $eventType ? $eventType->value : '';
			//dd($deal_status);
			if (!empty($request->from_date) && !empty($request->to_date)) {
				$query->whereBetween('event_time', [$request->from_date, $request->to_date]);
			}

			if (!empty($deal_status)) {
				$query->where('event_type', $deal_status);
			}

			if (!empty($request->mobile_number)) {
				$query->where('mobile_number', 'like', "%{$request->mobile_number}%");
			}

			return DataTables::of($query)
				->addIndexColumn()
				->addColumn('user', function ($row) {
					return $row->user ? $row->user->name : 'N/A'; // Assuming a user relation exists
				})
				->addColumn('action', function ($row) {
					if (Gate::check('customer-edit')) {
						$edit = '<a href="' . route('customer.edit', $row->id) . '" class="custom-edit-btn mr-1">
								<i class="fe fe-pencil"></i>
									' . __('default.form.edit-button') . '
							</a>';
					} else {
						$edit = '';
					}
					if (Gate::check('customer-delete')) {
						$delete = '<button class="custom-delete-btn remove-user" data-id="' . $row->id . '" data-action="' . route('customer.destroy') . '">
									<i class="fe fe-trash"></i>
									' . __('default.form.delete-button') . '
								</button>';
					} else {
						$delete = '';
					}
					$view = '<button class="view-user-btn" data-id="' . $row->id . '">
						<i class="fe fe-eye view-icon"></i> 
					 </button>';

					#return $view . ' ' . $edit . ' ' . $delete;
					return  $view;

					#return $action;
				})

				->make(true);
		}

		return view('admin.customer.event', compact('mobile'));
	}

	public function getContacts(Request $request)
    {
		$mobile = $request->query('mobile') ?? '';
		if ($request->ajax()) {
			$query = ContactUs::query()->with('user');
			//$query = ContactUs::query();
	
			// Apply filters
			if ($request->mobile_number) {
				$query->where('contact_number', 'like', '%' . $request->mobile_number . '%');
			}
	
			if ($request->email) {
				$query->where('email', 'like', '%' . $request->email . '%');
			}
	
			if ($request->from_date) {
				$query->whereDate('created_at', '>=', $request->from_date);
			}
	
			if ($request->to_date) {
				$query->whereDate('created_at', '<=', $request->to_date);
			}
	
			$data = $query->get();
	
			return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$delete = '<button class="btn btn-danger btn-sm delete-contact" data-id="' . $row->id . '">
									<i class="fe fe-trash"></i> Delete
								</button>';
					return $delete;
				})
				->addColumn('user', function ($row) {
					return $row->user ? $row->user->name : 'Guest';
				})
				->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
				->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
				->rawColumns(['action'])
				->make(true);
		}
		return view('admin.customer.contact_us', compact('mobile'));
    }


}

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
use App\Exports\AnchorExport;

class AnchorController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:anchor-list', ['only' => ['index','store']]);
		$this->middleware('permission:anchor-create', ['only' => ['create','store']]);
		$this->middleware('permission:anchor-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:anchor-delete', ['only' => ['destroy']]);
		$this->middleware('permission:profile-index', ['only' => ['profile','profile_update']]);

        $user_list = Permission::get()->filter(function($item) {
            return $item->name == 'anchor-list';
        })->first();
        $user_create = Permission::get()->filter(function($item) {
            return $item->name == 'anchor-create';
        })->first();
        $user_edit = Permission::get()->filter(function($item) {
            return $item->name == 'anchor-edit';
        })->first();
        $user_delete = Permission::get()->filter(function($item) {
            return $item->name == 'anchor-delete';
        })->first();
        $profile_index = Permission::get()->filter(function($item) {
            return $item->name == 'profile-index';
        })->first();


        if ($user_list == null) {
            Permission::create(['name'=>'anchor-list']);
        }
        if ($user_create == null) {
            Permission::create(['name'=>'anchor-create']);
        }
        if ($user_edit == null) {
            Permission::create(['name'=>'anchor-edit']);
        }
        if ($user_delete == null) {
            Permission::create(['name'=>'anchor-delete']);
        }
        if ($profile_index == null) {
            Permission::create(['name'=>'profile-index']);
        }
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
            #$data = User::get();
            $data = User::where('role_id', 4)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
					if (Gate::check('user-edit')) {
                        $edit = '<a href="'.route('anchor.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i>
                                        '.__('default.form.edit-button').'
                                </a>';
                    }else{
                        $edit = '';
                    }
                    if (Gate::check('user-delete')) {
                        $delete = '<button class="custom-delete-btn remove-user" data-id="'.$row->id.'" data-action="'.route('anchor.destroy').'">
										<i class="fe fe-trash"></i>
		                                '.__('default.form.delete-button').'
									</button>';
                    }else{
                        $delete = '';
                    }

					$view = '<button class="view-user-btn" data-id="' . $row->id . '">
                            <i class="fe fe-eye view-icon"></i> 
                         </button>';

						 return $view . ' ' . $edit . ' ' . $delete;
                    // $action = $edit.' '.$delete;
                    // return $action;
                })

                ->addColumn('status', function($row){
                	if ($row->status == 1) {
                		$current_status = 'Checked';
                	}else{
                		$current_status = '';
                	}
                    $status = "
                            <input type='checkbox' id='status_$row->id' id='user-$row->id' class='check' onclick='changeUserStatus(event.target, $row->id);' " .$current_status. ">
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
	                $role = str_replace(array('[',']'),'',$user->getRoleNames());
	                return $role = str_replace(array('"'),' ',$role);
	            })

                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
	            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
	            ->escapeColumns([])
                ->make(true);
        }
        return view('admin.anchor.index');
	}

	public function create()
	{
		$roles = Role::all();
		return view('admin.anchor.create',compact('roles'));
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
		$input['role_id'] = 4;

		try {
			$user = User::create($input);
			if($request->roles)
            {
				$user->assignRole($request->input('roles'));
			}

			Toastr::success(__('anchor.message.store.success'));
		    return redirect()->route('anchor.index');

		} catch (Exception $e) {
			Toastr::error(__('anchor.message.store.error'));
		    return redirect()->route('anchor.index');
		}
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::all();
		return view('admin.anchor.edit',compact('user','roles'));
	}

	public function update(Request $request, $id)
	{
		$rules = [
            'name' 			=> 'required',
			'password' 		=> 'same:confirm-password',
			'roles' 		=> 'required',
			'image' 		=> 'nullable',
        ];

        $messages = [
            'name.required'    		=> __('anchor.form.validation.name.required'),
            'password.required'    	=> __('anchor.form.validation.password.required'),
            'password.same'    		=> __('anchor.form.validation.password.same'),
            'roles.required'    	=> __('anchor.form.validation.roles.required'),
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

		if(!empty($input['password'])){
			$input['password'] = Hash::make($input['password']);
		}else{
			$input['password'] = $user->password;
		}

		try {
			$user->update($input);
            $user->roles()->detach(); //delete all the roles
            if($request->roles)
            {
                $user->assignRole($request->input('roles'));
            }

            Toastr::success(__('anchor.message.update.success'));
		    return redirect()->route('anchor.index');
		} catch (Exception $e) {
            Toastr::error(__('anchor.message.update.error'));
		    return redirect()->route('anchor.index');
		}
	}

	public function destroy()
	{
		$id = request()->input('id');
		$all_user = User::all();
		$count_all_user = $all_user->count();

		if ($count_all_user <= 1) {
			Toastr::error(__('anchor.message.warning_last_user'));
		    return redirect()->route('anchor.index');
		}else{
			$getuser = User::find($id);
			if(!empty($getuser->image)){
				$image_path = 'storage/'.$getuser->image;
				if(File::exists($image_path)) {
				    File::delete($image_path);
				}
			}
			try {
				User::find($id)->delete();
				return back()->with(Toastr::error(__('anchor.message.destroy.success')));
			} catch (Exception $e) {
				$error_msg = Toastr::error(__('anchor.message.destroy.error'));
				return redirect()->route('anchor.index')->with($error_msg);
			}
		}
	}

	public function profile()
	{
		return view('admin.anchor.profile');
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

			Toastr::success(__('anchor.message.profile.success'));
		    return redirect()->route('profile');
		} catch (Exception $e) {
			Toastr::success(__('anchor.message.profile.error'));
		    return redirect()->route('profile');
		}	
	}

	public function status_update(Request $request)
	{
		$user = User::find($request->id)->update(['status' => $request->status]);

		if($request->status == 1)
        {
            return response()->json(['message' => 'Status activated successfully.']);
        }
        else{
            return response()->json(['message' => 'Status deactivated successfully.']);
        }  
	}

	public function export(Request $request)
    {
        $query = User::query();

        // Apply filters if any

		
            $query->where('role_id',4);

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

        return Excel::download(new AnchorExport($users), 'AnchorExport.xlsx');
    }

	public function getAnchors($customerId)
    {
        // Fetch anchors based on customer ID (example logic)
        $anchors = User::whereHas('customers', function ($query) use ($customerId) {
            $query->where('customer_id', $customerId);
        })->get();

        // Return the anchors as JSON
        return response()->json($anchors);
    }
}

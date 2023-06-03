<?php

namespace App\Http\Controllers\backend\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = User::orderBy('id','DESC')->get();
        return view('admin.user.index',compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $q)
    {
        try {
            $this->validate($q, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);
    
            $user = User::create(['name' => $q->name,
                'email' => $q->email,
                'password' => Hash::make($q->password),
                'roles_name' => $q->roles,
            ]);
    
            $user->assignRole($q->input('roles'));
            
            session()->flash('Add', 'Added user succesfully');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.user.edit',compact('user','roles','userRole'));
    }

    public function update(Request $q, $id)
    {
        $this->validate($q, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);

        $input = $q->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        } else{
            Arr::except($input,array('password'));
        }

        $user = User::find($id);

        $user->update(['name' => $q->name,
            'email' => $q->email,
            'password' => Hash::make($q->password),
            'roles_name' => $q->roles,
        ]);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($q->input('roles'));
        session()->flash('edit', 'Updated user succesfully');
        return redirect('users');
    }

    public function destroy($id)
    {
        // dd(Auth::user()->roles->where('name' , 'admin'));
        // if((Auth::id() == $id) == true || Auth::user()->role ) {

        // }
        User::destroy($id);
        session()->flash('Deleted', 'Deleted user succesfully');
        return redirect()->back();
    }
}

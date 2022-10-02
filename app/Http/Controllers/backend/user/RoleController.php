<?php

namespace App\Http\Controllers\backend\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $q)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.roles.index' ,compact('roles'))->with('i', ($q->input('page', 1) - 1) * 5);    
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }

    public function store(Request $q)
    {
        try {
            $this->validate($q, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);
        
            $role = Role::create(['name' => $q->input('name')]);
            $role->syncPermissions($q->input('permission'));
        
            session()->flash('Add', 'Role created successfully');
            return redirect()->route('roles.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)->get();
    
        return view('admin.roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
    
        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $q, $id)
    {
        try {
            $this->validate($q, [
                'name' => 'required',
                'permission' => 'required',
            ]);
        
            $role = Role::find($id);
            $role->name = $q->input('name');
            $role->save();
        
            $role->syncPermissions($q->input('permission'));
        
            session()->flash('edit', 'Permission Edit Successfuly');
            return redirect()->route('roles.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Role::where('id', $id)->delete();

        session()->flash('Deleted', 'Permission Deleted Successfuly');
        return redirect()->back();
    }
}

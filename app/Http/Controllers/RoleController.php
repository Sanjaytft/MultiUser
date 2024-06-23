<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:delete role');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view ('roleView.role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('roleView.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string','unique:roles,name']
        ]);
        Role::create ([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role created Sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        return view ('roleView.role.edit', [
            //array or a compact function 
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string','unique:Roles,name,' 
            .$role->id]
        ]);
        $role->update ([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status', 'Role Deleted Sucessfully');
    }

    public function addPermissionToRole($roleId)
    {
        
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            //Creating assosative array type
            ->pluck('role_has_permissions.permission_id')
            ->all();
            
        return view ('roleView.role.add-permissions',[
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole (Request $request, $roleId) 
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrfail($roleId); 
        //assign or sync permission to role
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions added to role');

    }
    
}

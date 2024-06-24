<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller 
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view permission',['only' => ['index']]);
    //     $this->middleware('permission:create permission',['only' => ['create', 'store']]);
    //     $this->middleware('permission:update permission',['only' => ['update', 'edit']]);
    //     $this->middleware('permission:delete permission',['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return view ('roleView.permission.index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('roleView.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string','unique:permissions,name']
        ]);
        Permission::create ([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission created Sucessfully');
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
    public function edit(Permission $permission)
    {

        return view ('roleView.permission.edit', [
            //array or a compact function 
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string','unique:permissions,name,' 
            .$permission->id]
        ]);
        $permission->update ([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permissionId)
    {
        
        $permission = Permission::find($permissionId);
        $permission->delete($permissionId);
        return redirect('permissions')->with('status', 'Permission Deleted Sucessfully');
    }
}

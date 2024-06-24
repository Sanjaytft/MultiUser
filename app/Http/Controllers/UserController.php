<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:delete permission',['only' => ['index']]);
    //     $this->middleware('permission:create permission',['only' => ['create', 'store']]);
    //     $this->middleware('permission:update permission',['only' => ['update', 'edit']]);
    //     $this->middleware('permission:delete permission',['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view ('roleView.user.index', [
            'users' => $users
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit (User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view ('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'required', 'string',
            'roles' => 'required'
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(! empty ($request->password) ) 
        {
            $data += [
                'password' => Hash::make($request->password),
            ];

        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Updated sucessfully with role');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User Deleted sucessfully');
    }
}

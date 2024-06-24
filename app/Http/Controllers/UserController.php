<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
// {

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
    

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit (User $user)
    // {
    //     $roles = Role::pluck('name', 'name')->all();
    //     $userRoles = $user->roles->pluck('name', 'name')->all();
    //     return view ('role-permission.user.edit', [
    //         'user' => $user,
    //         'roles' => $roles,
    //         'userRoles' => $userRoles
    //     ]);

    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => 'required', 'string',
    //         'roles' => 'required'
    //     ]);


    //     $data = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //     ];

    //     if(! empty ($request->password) ) 
    //     {
    //         $data += [
    //             'password' => Hash::make($request->password),
    //         ];

    //     }

    //     $user->update($data);
    //     $user->syncRoles($request->roles);

    //     return redirect('/users')->with('status', 'User Updated sucessfully with role');

    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy( $userId)
    // {
    //     $user = User::findOrFail($userId);
    //     $user->delete();

    //     return redirect('/users')->with('status', 'User Deleted sucessfully');
    // }

    {

            public function index()
        {
            $users = User::get();
            return view ('roleView.user.index', [
                'users' => $users
            ]);
            
        }
        /**
         * Display a listing of User.
         *
         * @return \Illuminate\Http\Response
         */
        // public function index()
        // {
        //     if (! Gate::allows('users_manage')) {
        //         return abort(401);
        //     }
    
        //     $users = User::all();
    
        //     return view('roleView.user.index', compact('users'));
        // }
    
        /**
         * Show the form for creating new User.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            if (! Gate::allows('users_manage')) {
                return abort(401);
            }
            $roles = Role::get()->pluck('name', 'name');
    
            return view('roleView.user.create', compact('roles'));
        }
    
        /**
         * Store a newly created User in storage.
         *
         * @param  \App\Http\Requests\StoreUsersRequest  $request
         * @return \Illuminate\Http\Response
         */
        public function store(StoreUsersRequest $request)
        {
            if (! Gate::allows('users_manage')) {
                return abort(401);
            }
            $user = User::create($request->all());
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);
    
            return redirect()->route('roleView.user.index');
        }
    
    
        /**
         * Show the form for editing User.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(User $user)
        {
            if (! Gate::allows('users_manage')) {
                return abort(401);
            }
            $roles = Role::get()->pluck('name', 'name');
    
            return view('roleView.user.edit', compact('user', 'roles'));
        }
    
        /**
         * Update User in storage.
         *
         * @param  \App\Http\Requests\UpdateUsersRequest  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateUsersRequest $request, User $user)
        {
            if (! Gate::allows('users_manage')) {
                return abort(401);
            }
    
            $user->update($request->all());
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->syncRoles($roles);
    
            return redirect()->route('roleView.user.index');
        }
    
        public function show(User $user)
        {
            if (! Gate::allows('users_manage')) {
                return abort(401);
            }
    
            $user->load('roles');
    
            return view('roleView.user.show', compact('user'));
        }
    
        /**
         * Remove User from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($userId)
        {
            
    
            $user = User::findOrFail($userId);
            $user->delete();
    
            return redirect('/users')->route('roleView.user.index')->with('status', 'User Deleted Sucessfully');
        }
    
        /**
         * Delete all selected User at once.
         *
         * @param Request $request
         */
        public function massDestroy(Request $request)
        {
            if (! Gate::allows('users_manage')) {
                return abort(401);
            }
            User::whereIn('id', request('ids'))->delete();
    
            return response()->noContent();
        }
    
    }

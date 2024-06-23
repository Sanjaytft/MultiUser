@extends('layouts.app')

@section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status')}}</div>
                        @endif
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4> List of Users
                            <a href="{{ url('roles/create')}}" class="btn btn-primary float-end"> Add New Roles</a>
                            </h4>
                        </div>
                            <div class="card-body">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Roles </th>
                                    <th > Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                    
                                    <tr>
                                        <td> {{ $user->id }}</td>
                                        <td> {{ $user->name }}</td>
                                        <td> {{ $user->email }}</td>
                                        <td>
                                            {{-- get the names of the users roles --}}
                                            @if(! empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge bgs-primary mx-1"> {{ $rolename }}</label>

                                            @endif
                                        </td>
                                        
                                        <td>
                                            <a href="{{ url('users/'.$user->id.'/edit')}}" class="btn btn-success"> Edit</a>
                                            <a href="{{ url('users/'.$user->id.'/delete')}}" class="btn btn-danger"> Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
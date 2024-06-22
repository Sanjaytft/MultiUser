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
                            <h4> List of Users Roles
                            <a href="{{ url('roles/create')}}" class="btn btn-primary float-end"> Add New Roles</a>
                            </h4>
                        </div>
                            <div class="card-body">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th > Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                    
                                    <tr>
                                        <td> {{ $role->id }}</td>
                                        <td> {{ $role->name }}</td>
                                        {{-- //resources route follow this structure --}}
                                        <td> 
                                            <a href="{{ url('roles/'.$role->id.'/edit')}}" class="btn btn-success"> Edit</a>
                                            <a href="{{ url('roles/'.$role->id.'/delete')}}" class="btn btn-danger"> Delete</a>
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
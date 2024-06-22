@extends('layouts.app')

@section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create New Roles</h4>
                            <a href="{{ url('roles/create')}}" class="btn btn-danger float-end">Go Back</a>
                            <div class="card-body">
                                <form action="{{ url('roles') }}" method="POST"> 
                                    @csrf
                                    <div class="mb-3">
                                        <label for="">Role Name</label>
                                        <input type="text" name="name" class="form-control"> 
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary"> Save</button>
                                    </div>    

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
<div>
@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Users') }}
                            </span>

                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('message'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    
                                    <tr>
                                        <th colspan="5">
                                        <input type="text" class="form-control" placeholder="Buscar..." wire:model="searchTerm">
                                        </th>
                                    </tr>    

                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>

                                        <th>Last Name</th>

                                        <th>Email</th>

                                        <th>Role</th>

                                        <th>Permission</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            
											<td>{{ $user->name }}</td>

                                            <td>{{ $user->last_name }}</td>

                                            <td>{{ $user->email }}</td>

                                            <th>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" ></label>
                                                <div class="col-md-8">
                                                    <select class="form-control" wire:model="role_id" name="role_id" id="role_id" required>
                                                    <option value="">Select Role</option>
                                                        @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" wire:change="changePermission()">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            </th>

                                            <th>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" ></label>
                                                <div class="col-md-8">
                                                    <select class="form-control" wire:model="permission_id" name="permission_id" id="permission_id" required wire:change="updateUserPermission({{ $user->id }})">
                                                    <option value="">Select Role</option>
                                                        @foreach ($permissions as $permission)
                                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>
                                                                                                        
                                                </div>
                                            </div>
                                            </th>

                                            <th>
                                                
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

<div>
@extends('adminlte::page')

@section('title', 'Program Day Routines')

@section('content_header')
    <h1>Program Day Routines</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Program Day Routines') }}
                            </span>

                            <div class="float-right">
                            <a href="{{ route('admin.addprogramdayroutine') }}" class="btn btn-success pull-right">Agregar Nuevo</a>
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
                                        
										<th>Title</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programdayroutines as $programdayroutine)
                                        <tr>
                                            <td>{{ $programdayroutine->id }}</td>
                                            
											<td>{{ $programdayroutine->title }}</td>

                                            <th>

                                            <a href="{{ route('admin.editprogramdayroutine',['programdayroutine_id' => $programdayroutine->id]) }}"> <i class="fa fa-edit fa-2x"></i></a>
                                            <a href="#" onclick="confirm('¿Estas seguro que deseas eliminar este registro?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProgramDayRoutine({{ $programdayroutine->id }})" style="margin-left:10px;"> <i class="fa fa-times fa-2x text-danger"></i></a>

                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $programdayroutines->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop

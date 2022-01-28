@extends('adminlte::page')

@section('title', 'Exercises')

@section('content_header')
    <h1>Exercises</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Exercise</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('exercises.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $exercise->description }}
                        </div>
                        <div class="form-group">
                            <strong>Program Id:</strong>
                            {{ $exercise->program->name }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $exercise->user->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
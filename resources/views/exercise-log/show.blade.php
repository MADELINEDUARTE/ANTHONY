@extends('adminlte::page')

@section('title', 'Exercise Logs')

@section('content_header')
    <h1>Exercise Logs</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Exercise Log</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('exercise-logs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $exerciseLog->description }}
                        </div>
                        <div class="form-group">
                            <strong>Start:</strong>
                            {{ $exerciseLog->start }}
                        </div>
                        <div class="form-group">
                            <strong>Finish:</strong>
                            {{ $exerciseLog->finish }}
                        </div>
                        <div class="form-group">
                            <strong>Exercise Id:</strong>
                            {{ $exerciseLog->exercise_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $exerciseLog->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $exerciseLog->status_id }}
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

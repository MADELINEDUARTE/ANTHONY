@extends('adminlte::page')

@section('title', 'Routine Logs')

@section('content_header')
    <h1>Routine Logs</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Routine Log</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('routine-logs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Subscription Program Day Routine Id:</strong>
                            {{ $routineLog->subscriptionProgramDayRoutine->id }}
                        </div>
                        <div class="form-group">
                            <strong>Repetitions:</strong>
                            {{ $routineLog->repetitions }}
                        </div>
                        <div class="form-group">
                            <strong>Weight:</strong>
                            {{ $routineLog->weight }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $routineLog->user->name }}
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


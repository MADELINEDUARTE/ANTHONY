@extends('adminlte::page')

@section('title', 'Program Day Routines')

@section('content_header')
    <h1>Program Day Routines</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Program Day Routine</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('program-day-routines.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $programDayRoutine->title }}
                        </div>
                        <div class="form-group">
                            <strong>Video:</strong>
                            {{ $programDayRoutine->video }}
                        </div>
                        <div class="form-group">
                            <strong>Sets:</strong>
                            {{ $programDayRoutine->sets }}
                        </div>
                        <div class="form-group">
                            <strong>Repetitions:</strong>
                            {{ $programDayRoutine->repetitions }}
                        </div>
                        <div class="form-group">
                            <strong>Program Day Id:</strong>
                            {{ $programDayRoutine->programDay->name }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $programDayRoutine->status->description }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $programDayRoutine->user->name }}
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
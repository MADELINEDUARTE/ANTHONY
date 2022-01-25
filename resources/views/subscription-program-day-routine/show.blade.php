@extends('adminlte::page')

@section('title', 'Subscription Programs Days Routine')

@section('content_header')
    <h1>Subscription Programs Days Routine</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Subscription Program Day Routine</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('subscription-program-day-routines.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Subscription Programs Id:</strong>
                            {{ $subscriptionProgramDayRoutine->subscription_programs_id }}
                        </div>
                        <div class="form-group">
                            <strong>Program Days Id:</strong>
                            {{ $subscriptionProgramDayRoutine->program_days_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $subscriptionProgramDayRoutine->user_id }}
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



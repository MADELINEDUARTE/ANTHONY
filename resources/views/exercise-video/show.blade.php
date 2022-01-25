@extends('adminlte::page')

@section('title', 'Exercise Video')

@section('content_header')
    <h1>Exercise Video</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Exercise Video</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('exercise-videos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Video:</strong>
                            {{ $exerciseVideo->video }}
                        </div>
                        <div class="form-group">
                            <strong>Exercise Id:</strong>
                            {{ $exerciseVideo->exercise_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $exerciseVideo->user_id }}
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

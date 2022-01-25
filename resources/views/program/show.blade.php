@extends('adminlte::page')

@section('title', 'Program')

@section('content_header')
    <h1>Program</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Program</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('programs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $program->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $program->description }}
                        </div>
                        <div class="form-group">
                            <strong>Program Category Id:</strong>
                            {{ $program->program_category_id }}
                        </div>
                        <div class="form-group">
                            <strong>Video:</strong>
                            {{ $program->video }}
                        </div>
                        <div class="form-group">
                            <strong>Number Of Days:</strong>
                            {{ $program->number_of_days }}
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            {{ $program->image }}
                        </div>
                        <div class="form-group">
                            <strong>Popular:</strong>
                            {{ $program->popular }}
                        </div>
                        <div class="form-group">
                            <strong>Recommended:</strong>
                            {{ $program->recommended }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $program->status_id }}
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


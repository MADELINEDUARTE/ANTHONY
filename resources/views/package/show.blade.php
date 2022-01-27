@extends('adminlte::page')

@section('title', 'Package')

@section('content_header')
    <h1>Package</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Package</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('packages.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $package->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $package->description }}
                        </div>
                        <div class="form-group">
                            <strong>Number Of Programs:</strong>
                            {{ $package->number_of_programs }}
                        </div>
                        <div class="form-group">
                            <strong>Amount:</strong>
                            {{ $package->amount }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $package->status->description }}
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


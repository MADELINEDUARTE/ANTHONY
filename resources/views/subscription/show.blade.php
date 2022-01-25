@extends('adminlte::page')

@section('title', 'Subscription')

@section('content_header')
    <h1>Subscription</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Subscription</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('subscriptions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Package Id:</strong>
                            {{ $subscription->package_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $subscription->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $subscription->status_id }}
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

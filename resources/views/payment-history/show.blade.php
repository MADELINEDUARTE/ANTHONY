@extends('adminlte::page')

@section('title', 'Payment History')

@section('content_header')
    <h1>Payment History</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Payment History</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('payment-histories.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Payment Date:</strong>
                            {{ $paymentHistory->payment_date }}
                        </div>
                        <div class="form-group">
                            <strong>Amount:</strong>
                            {{ $paymentHistory->amount }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $paymentHistory->status_id }}
                        </div>
                        <div class="form-group">
                            <strong>Subscription Id:</strong>
                            {{ $paymentHistory->subscription_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $paymentHistory->user_id }}
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


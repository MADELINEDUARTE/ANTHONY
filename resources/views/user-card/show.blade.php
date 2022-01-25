@extends('adminlte::page')

@section('title', 'User Card')

@section('content_header')
    <h1>User Card</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show User Card</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('user-cards.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Number:</strong>
                            {{ $userCard->number }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $userCard->name }}
                        </div>
                        <div class="form-group">
                            <strong>Cvv:</strong>
                            {{ $userCard->cvv }}
                        </div>
                        <div class="form-group">
                            <strong>Expiration Date:</strong>
                            {{ $userCard->expiration_date }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $userCard->user_id }}
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


@extends('adminlte::page')

@section('title', 'Comments')

@section('content_header')
    <h1>Comments</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Comment</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comments.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Reason:</strong>
                            {{ $comment->reason }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $comment->description }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $comment->type }}
                        </div>
                        <div class="form-group">
                            <strong>Subscription Id:</strong>
                            {{ $comment->subscription->id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $comment->user_id }}
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


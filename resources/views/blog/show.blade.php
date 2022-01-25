@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Blog</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Blog</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $blog->title }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $blog->description }}
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            {{ $blog->image }}
                        </div>
                        <div class="form-group">
                            <strong>Video:</strong>
                            {{ $blog->video }}
                        </div>
                        <div class="form-group">
                            <strong>Status Id:</strong>
                            {{ $blog->status_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $blog->user_id }}
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


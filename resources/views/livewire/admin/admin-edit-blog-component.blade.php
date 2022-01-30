<div>
@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Blog</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Edit Blog</span>
                    </div>
                    <div class="card-body">
                        <form role="form" enctype="multipart/form-data" wire:submit.prevent="updateBlog">
                            @csrf
                            @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        {{ Form::label('title') }}
                                        {{ Form::text('title', '', ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title', 'wire:model' => 'title']) }}
                                        {!! $errors->first('title', '<div class="invalid-feedback">:message</p>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description') }}
                                        {{ Form::text('description', '', ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description', 'wire:model' => 'description']) }}
                                        {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
                                    </div>
                                    
                                    {{--
                                    <div class="form-group">
                                        {{ Form::label('video') }}
                                        {{ Form::text('video', '', ['class' => 'form-control' . ($errors->has('video') ? ' is-invalid' : ''), 'placeholder' => 'Video', 'wire:model' => 'video']) }}
                                        {!! $errors->first('video', '<div class="invalid-feedback">:message</p>') !!}
                                    </div>
                                    --}}

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" >Video</label>
                                        <div class="col-md-8">
                                            <input type="file" placeholder="Video" class="input-file" wire:model="newVideo">
                                            @error('video')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            @if ($newVideo)
                                            <a target="_blank" href="{{ $newVideo->temporaryUrl() }}">
                                                <video width="320" height="240" controls>
                                                <source src="{{ $newVideo->temporaryUrl() }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                                </video> 
                                            </a>
                                            @else    
                                            <video width="320" height="240" controls>
                                            <source src="{{ asset('assets/videos/blogs') }}/{{ $video }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                            </video> 
                                            @endif
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" >Imagen</label>
                                        <div class="col-md-8">
                                            <input type="file" placeholder="Imagen" class="input-file" wire:model="newImage">
                                            @error('image')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            @if ($newImage)
                                            <img src="{{ $newImage->temporaryUrl() }}" width="120" />
                                            @else    
                                            <img src="{{ asset('assets/images/blogs') }}/{{ $image }}" width="120" />
                                            @endif
                                        </div>
                                    </div>                                    


                                    <div class="form-group">
                                        <label class="col-md-2 control-label" >Status</label>
                                        <div class="col-md-8">
                                            <select class="form-control" wire:model="status_id" name="status_id" id="status_id" required>
                                            <option value="">Select Status</option>
                                                @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->description }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
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
@stop
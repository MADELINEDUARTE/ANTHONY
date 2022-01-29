<div>
@extends('adminlte::page')

@section('title', 'Program')

@section('content_header')
    <h1>Program</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Edit Program</span>
                    </div>
                    <div class="card-body">
                        <form role="form" enctype="multipart/form-data" wire:submit.prevent="updateProgram">
                            @csrf
                            @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        {{ Form::label('name') }}
                                        {{ Form::text('name', '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'wire:model' => 'name']) }}
                                        {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description') }}
                                        {{ Form::text('description', '', ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description', 'wire:model' => 'description']) }}
                                        {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" >Program Category</label>
                                        <div class="col-md-8">
                                            <select class="form-control" wire:model="program_category_id" name="program_category_id" id="program_category_id" required>
                                            <option value="">Select Program Category</option>
                                                @foreach ($program_categories as $program_category)
                                                <option value="{{ $program_category->id }}">{{ $program_category->description }}</option>
                                                @endforeach
                                            </select>
                                            @error('program_category_id')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
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
                                            <source src="{{ asset('assets/videos/programs') }}/{{ $video }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                            </video> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('number_of_days') }}
                                        {{ Form::text('number_of_days', '', ['class' => 'form-control' . ($errors->has('number_of_days') ? ' is-invalid' : ''), 'placeholder' => 'Number Of Days', 'wire:model' => 'number_of_days']) }}
                                        {!! $errors->first('number_of_days', '<div class="invalid-feedback">:message</p>') !!}
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
                                            <img src="{{ asset('assets/images/programs') }}/{{ $image }}" width="120" />
                                            @endif
                                        </div>
                                    </div>                                    


                                    <div class="form-group">
                                    <label class="col-md-2 control-label" >Popular</label>
                                        <div class="col-md-8">
                                            <select class="form-control" wire:model="popular" name="popular" id="popular" required>
                                            <option value="">Popular</option>
                                                <option value="0" selected>No</option>
                                                <option value="1">Si</option>
                                            </select>
                                            @error('popular')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="col-md-2 control-label" >Recommended</label>
                                        <div class="col-md-8">
                                            <select class="form-control" wire:model="recommended" name="recommended" id="recommended" required>
                                            <option value="">Recommended</option>
                                                <option value="0" selected>No</option>
                                                <option value="1">Si</option>
                                            </select>
                                            @error('recommended')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
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
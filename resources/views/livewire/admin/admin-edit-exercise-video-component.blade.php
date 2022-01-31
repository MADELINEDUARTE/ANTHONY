<div>
@extends('adminlte::page')

@section('title', 'Exercise Video')

@section('content_header')
    <h1>Exercise Video</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Exercise Video</span>
                    </div>
                    <div class="card-body">
                        <form role="form" enctype="multipart/form-data" wire:submit.prevent="updateExerciseVideo">
                            @csrf
                            @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
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
                                            <source src="{{ asset('assets/videos/exercisevideos') }}/{{ $video }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                            </video> 
                                            @endif
                                        </div>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" >Exercise</label>
                                        <div class="col-md-8">
                                            <select class="form-control" wire:model="exercise_id" name="exercise_id" id="exercise_id" required>
                                            <option value="">Select Exercise</option>
                                                @foreach ($exercises as $exercise)
                                                <option value="{{ $exercise->id }}">{{ $exercise->description }}</option>
                                                @endforeach
                                            </select>
                                            @error('exercise_id')
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
<div>
@extends('adminlte::page')

@section('title', 'Program Day Routine')

@section('content_header')
    <h1>Program Day Routine</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Edit Program Day Routine</span>
                    </div>
                    <div class="card-body">
                        <form role="form" enctype="multipart/form-data" wire:submit.prevent="updateProgramDayRoutine">
                            @csrf
                            @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                            @endif
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    
                                <div class="form-group">
                                    {{ Form::label('title') }}
                                    {{ Form::text('title', $programDayRoutine->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title', 'wire:model' => 'title']) }}
                                    {!! $errors->first('title', '<div class="invalid-feedback">:message</p>') !!}
                                </div>
                                
                                {{--
                                <div class="form-group">
                                    {{ Form::label('video') }}
                                    {{ Form::text('video', $programDayRoutine->video, ['class' => 'form-control' . ($errors->has('video') ? ' is-invalid' : ''), 'placeholder' => 'Video']) }}
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
                                            <source src="{{ asset('assets/videos/programdayroutines') }}/{{ $video }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                            </video> 
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group">
                                    {{ Form::label('sets') }}
                                    {{ Form::text('sets', $programDayRoutine->sets, ['class' => 'form-control' . ($errors->has('sets') ? ' is-invalid' : ''), 'placeholder' => 'Sets', 'wire:model' => 'sets']) }}
                                    {!! $errors->first('sets', '<div class="invalid-feedback">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('repetitions') }}
                                    {{ Form::text('repetitions', $programDayRoutine->repetitions, ['class' => 'form-control' . ($errors->has('repetitions') ? ' is-invalid' : ''), 'placeholder' => 'Repetitions', 'wire:model' => 'repetitions']) }}
                                    {!! $errors->first('repetitions', '<div class="invalid-feedback">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('program_day_id') }}
                                    {{-- Form::text('program_day_id', $programDayRoutine->program_day_id, ['class' => 'form-control' . ($errors->has('program_day_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Day Id']) --}}
                                    <select class="form-control" wire:model="program_day_id" name="program_day_id" id="program_day_id" wire:model="program_day_id" required>
                                    <option value="">Select Program Day</option>
                                        @foreach ($programdays as $programday)
                                        <option value="{{ $programday->id }}" {{ $programDayRoutine->program_day_id == $programday->id ? "selected" : "" }}>{{ $programday->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('program_day_id', '<div class="invalid-feedback">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status_id') }}
                                    {{-- Form::text('status_id', $programDayRoutine->status_id, ['class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : ''), 'placeholder' => 'Status Id']) --}}
                                    <select class="form-control" wire:model="status_id" name="status_id" id="status_id" wire:model="status_id" required>
                                    <option value="">Select Status</option>
                                        @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $programDayRoutine->status_id == $status->id ? "selected" : "" }}>{{ $status->description }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('status_id', '<div class="invalid-feedback">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('user_id') }}
                                    {{ Auth::user()->name }}
                                    {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id', 'wire:model' => 'user_id']) }}
                                    {!! $errors->first('user_id', '<div class="invalid-feedback">:message</p>') !!}
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
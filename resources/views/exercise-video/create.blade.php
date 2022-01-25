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
                        <form method="POST" action="{{ route('exercise-videos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('exercise-video.form')

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
    <script> console.log('Hi!'); </script>
@stop

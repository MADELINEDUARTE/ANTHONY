@extends('adminlte::page')

@section('title', 'Program Day Routines')

@section('content_header')
    <h1>Program Day Routines</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Program Day Routine</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('program-day-routines.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('program-day-routine.form')

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

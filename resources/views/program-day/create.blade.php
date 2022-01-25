@extends('adminlte::page')

@section('title', 'Program Days')

@section('content_header')
    <h1>Program Days</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Program Day</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('program-days.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('program-day.form')

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

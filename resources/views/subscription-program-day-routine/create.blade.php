@extends('adminlte::page')

@section('title', 'Subscription Programs Days Routine')

@section('content_header')
    <h1>Subscription Programs Days Routine</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Subscription Program Day Routine</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('subscription-program-day-routines.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('subscription-program-day-routine.form')

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


@extends('adminlte::page')

@section('title', 'Frequently Asked Questions')

@section('content_header')
    <h1>Frequently Asked Questions</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Frequently Asked Question</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('frequently-asked-questions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('frequently-asked-question.form')

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

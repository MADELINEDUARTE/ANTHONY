@extends('adminlte::page')

@section('title', 'Frequently Asked Questions')

@section('content_header')
    <h1>Frequently Asked Questions</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Frequently Asked Question</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('frequently-asked-questions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Question:</strong>
                            {{ $frequentlyAskedQuestion->question }}
                        </div>
                        <div class="form-group">
                            <strong>Answer:</strong>
                            {{ $frequentlyAskedQuestion->answer }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $frequentlyAskedQuestion->user_id }}
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

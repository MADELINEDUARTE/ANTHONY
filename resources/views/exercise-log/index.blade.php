@extends('adminlte::page')

@section('title', 'Exercise Logs')

@section('content_header')
    <h1>Exercise Logs</h1>
@stop

@section('content')
    <section class="content container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Exercise Log') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('exercise-logs.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Description</th>
										<th>Start</th>
										<th>Finish</th>
										<th>Exercise Id</th>
										<th>User Id</th>
										<th>Status Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exerciseLogs as $exerciseLog)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $exerciseLog->description }}</td>
											<td>{{ $exerciseLog->start }}</td>
											<td>{{ $exerciseLog->finish }}</td>
											<td>{{ $exerciseLog->exercise_id }}</td>
											<td>{{ $exerciseLog->user_id }}</td>
											<td>{{ $exerciseLog->status_id }}</td>

                                            <td>
                                                <form action="{{ route('exercise-logs.destroy',$exerciseLog->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('exercise-logs.show',$exerciseLog->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('exercise-logs.edit',$exerciseLog->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $exerciseLogs->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

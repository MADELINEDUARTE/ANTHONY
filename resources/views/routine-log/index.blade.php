@extends('adminlte::page')

@section('title', 'Routine Logs')

@section('content_header')
    <h1>Routine Logs</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Routine Log') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('routine-logs.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Subscription Program Day Routine Id</th>
										<th>Repetitions</th>
										<th>Weight</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routineLogs as $routineLog)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $routineLog->subscription_program_day_routine_id }}</td>
											<td>{{ $routineLog->repetitions }}</td>
											<td>{{ $routineLog->weight }}</td>
											<td>{{ $routineLog->user_id }}</td>

                                            <td>
                                                <form action="{{ route('routine-logs.destroy',$routineLog->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('routine-logs.show',$routineLog->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('routine-logs.edit',$routineLog->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $routineLogs->links() !!}
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


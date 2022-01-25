@extends('adminlte::page')

@section('title', 'Program Day Routines')

@section('content_header')
    <h1>Program Day Routines</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Program Day Routine') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('program-day-routines.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Title</th>
										<th>Video</th>
										<th>Sets</th>
										<th>Repetitions</th>
										<th>Program Day Id</th>
										<th>Status Id</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programDayRoutines as $programDayRoutine)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $programDayRoutine->title }}</td>
											<td>{{ $programDayRoutine->video }}</td>
											<td>{{ $programDayRoutine->sets }}</td>
											<td>{{ $programDayRoutine->repetitions }}</td>
											<td>{{ $programDayRoutine->program_day_id }}</td>
											<td>{{ $programDayRoutine->status_id }}</td>
											<td>{{ $programDayRoutine->user_id }}</td>

                                            <td>
                                                <form action="{{ route('program-day-routines.destroy',$programDayRoutine->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('program-day-routines.show',$programDayRoutine->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('program-day-routines.edit',$programDayRoutine->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $programDayRoutines->links() !!}
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

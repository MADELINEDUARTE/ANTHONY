@extends('adminlte::page')

@section('title', 'Program Days')

@section('content_header')
    <h1>Program Days</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Program Day') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('program-days.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Program Id</th>
										<th>Name</th>
										<th>Number</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programDays as $programDay)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $programDay->program->name }}</td>
											<td>{{ $programDay->name }}</td>
											<td>{{ $programDay->number }}</td>
											<td>{{ $programDay->user->name }}</td>

                                            <td>
                                                <form action="{{ route('program-days.destroy',$programDay->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('program-days.show',$programDay->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('program-days.edit',$programDay->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $programDays->links('pagination::bootstrap-4') !!}
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

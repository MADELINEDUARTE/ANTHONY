@extends('adminlte::page')

@section('title', 'Program')

@section('content_header')
    <h1>Program</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Program') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('programs.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Name</th>
										<th>Description</th>
										<th>Program Category Id</th>
										<th>Video</th>
										<th>Number Of Days</th>
										<th>Image</th>
										<th>Popular</th>
										<th>Recommended</th>
										<th>Status Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programs as $program)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $program->name }}</td>
											<td>{{ $program->description }}</td>
											<td>{{ $program->program_category_id }}</td>
											<td>{{ $program->video }}</td>
											<td>{{ $program->number_of_days }}</td>
											<td>{{ $program->image }}</td>
											<td>{{ $program->popular }}</td>
											<td>{{ $program->recommended }}</td>
											<td>{{ $program->status_id }}</td>

                                            <td>
                                                <form action="{{ route('programs.destroy',$program->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('programs.show',$program->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('programs.edit',$program->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $programs->links() !!}
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

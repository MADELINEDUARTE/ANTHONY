@extends('adminlte::page')

@section('title', 'Exercise Video')

@section('content_header')
    <h1>Exercise Video</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Exercise Video') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('exercise-videos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Video</th>
										<th>Exercise Id</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exerciseVideos as $exerciseVideo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $exerciseVideo->video }}</td>
											<td>{{ $exerciseVideo->exercise_id }}</td>
											<td>{{ $exerciseVideo->user_id }}</td>

                                            <td>
                                                <form action="{{ route('exercise-videos.destroy',$exerciseVideo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('exercise-videos.show',$exerciseVideo->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('exercise-videos.edit',$exerciseVideo->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $exerciseVideos->links() !!}
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

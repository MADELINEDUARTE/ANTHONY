@extends('adminlte::page')

@section('title', 'Subscription Programs')

@section('content_header')
    <h1>Subscription Programs</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Subscription Program') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('subscription-programs.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Subscription Id</th>
										<th>Program Id</th>
										<th>Status Id</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptionPrograms as $subscriptionProgram)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $subscriptionProgram->subscription->id }}</td>
											<td>{{ $subscriptionProgram->program->name }}</td>
											<td>{{ $subscriptionProgram->status->description }}</td>
											<td>{{ $subscriptionProgram->user->name }}</td>

                                            <td>
                                                <form action="{{ route('subscription-programs.destroy',$subscriptionProgram->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('subscription-programs.show',$subscriptionProgram->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('subscription-programs.edit',$subscriptionProgram->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $subscriptionPrograms->links('pagination::bootstrap-4') !!}
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


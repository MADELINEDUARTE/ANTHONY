@extends('adminlte::page')

@section('title', 'User Card')

@section('content_header')
    <h1>User Card</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User Card') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('user-cards.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Number</th>
										<th>Name</th>
										<th>Cvv</th>
										<th>Expiration Date</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userCards as $userCard)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $userCard->number }}</td>
											<td>{{ $userCard->name }}</td>
											<td>{{ $userCard->cvv }}</td>
											<td>{{ $userCard->expiration_date }}</td>
											<td>{{ $userCard->user_id }}</td>

                                            <td>
                                                <form action="{{ route('user-cards.destroy',$userCard->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('user-cards.show',$userCard->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('user-cards.edit',$userCard->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $userCards->links() !!}
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


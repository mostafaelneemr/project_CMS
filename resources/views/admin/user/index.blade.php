@extends('layouts.backend.master')

@section('title')
    users
@endsection

@section('content')
    
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">users</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">dashboard</a></li>
                <li class="breadcrumb-item active">users</li>
            </ol>
        </div>
    </div>
</div>

@include('admin.message')

<!-- main body -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                
                @can('role-create')
                    <div class="pull-lift">
                        <a class="btn btn-success" href="{{ route('users.create') }}">add user</a>
                    </div>
                @endcan

                <div class="table-responsive mt-15">
                    <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>email</th>
                            <th>role</th>
                            <th width="280px">operation</th>
                        </tr>
                        @foreach ($data as $key => $user)
                        <tr style=" text-align: center;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('role-edit')
                                <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}">edit</a>
                                @endcan

                                @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit( 'delete' , ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                @endcan
                                
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')  
@endsection
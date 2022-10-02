@extends('layouts.backend.master')

@section('title')
    Roles permessions
@endsection

@section('content')
    
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Roles permessions</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">dashboard</a></li>
                <li class="breadcrumb-item active">roles</li>
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
                    <a class="btn btn-success" href="{{ route('roles.create') }}">add role</a>
                @endcan

                <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                    <tr>
                        <th>#</th>
                        <th>role name</th> 
                        <th width="280px">operations</th>
                    </tr>
                    @foreach ($roles as $role)
                        <tr style=" text-align: center;">
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('role-list')
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">show</a>
                                @endcan

                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">edit</a>
                                @endcan

                                @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('delete' , ['class' => 'btn btn-danger']) !!}
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
@endsection

@section('js')
@endsection

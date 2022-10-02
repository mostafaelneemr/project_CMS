@extends('layouts.backend.master')

@section('title')
    edit role
@endsection

@section('css')
    {{-- <style>
        .font {
            font-size: 20px
        }
    </style> --}}
@endsection

@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Edit : {{$role->name}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active" onclick="history.back()"><a href="#">Back</a></li>
            </ol>
        </div>
    </div>
</div>

    {{-- @include('admin.message) --}}

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role permissions :</strong>
            <br/><br/>
            @foreach($permission as $value)
                <label style="font-size: 20px">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-3">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</div>
{!! Form::close() !!}
@endsection

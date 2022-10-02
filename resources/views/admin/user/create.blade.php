@extends('layouts.backend.master')

@section('title')
    create user
@endsection

@section('content')

@include('admin.message')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Create user</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()">back</a></li>
            </ol>
        </div>
    </div>
</div>

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>name</strong>
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
            @if($errors->has('name')) 
            <span class="help=block alert-danger">{!! $errors->first('name') !!} </span>
            @endif
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>email</strong>
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
            @if($errors->has('email')) 
            <span class="help=block alert-danger">{!! $errors->first('email') !!} </span>
            @endif
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>password</strong>
            {!! Form::password('password', array('class' => 'form-control')) !!}
            @if($errors->has('password')) 
            <span class="help=block alert-danger">{!! $errors->first('password') !!} </span>
            @endif
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>confirm password</strong>
            {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
            @if($errors->has('confirm-password')) 
            <span class="help=block alert-danger">{!! $errors->first('confirm-password') !!} </span>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>role</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">add</button>
    </div>

</div>
{!! Form::close() !!}

@endsection
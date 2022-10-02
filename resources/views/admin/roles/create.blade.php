@extends('layouts.backend.master')

@section('title')
    {{__('add new permossion')}}
@endsection

@section('css')
@endsection


@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">create permessions</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">dashboard</a></li>
                <li class="breadcrumb-item active">create roles</li>
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
                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-7 col-sm-7 col-md-12">
                            <div class="form-group">
                                <strong>role name :</strong><br>
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                        </div><br>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body ">
                                    <h5 class="card-title">role permissions</h5>
                                    <div class="accordion gray plus-icon round">
                                        <div class="acd-group">
                                            <a href="#" class="acd-heading">user permissions</a>
                                            <div class="acd-des">
                                                @foreach($permission as $value)
                                                <div>
                                                    <label style="font-size: 15px;"> - {{ $value->name }}</label>  
                                                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }} 
                                                </div>
                                                @endforeach
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success">add</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
@endsection

@section('js')
@endsection

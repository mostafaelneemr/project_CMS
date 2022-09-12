@extends('layouts.backend.master')

@section('title')
    Settings
@endsection

@section('css')
@endsection

@section('content')

@include('admin.message')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Settings</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('home')}}" class="default-color">Home site page</a></li>
                <li class="breadcrumb-item active">settigs</li>
            </ol>
        </div>
    </div>
</div>
<!-- main body -->
<div class="card card-statistics mb-30">
    <div class="card-body">
        <h5 class="card-title">Settings</h5>
        <div class="row">
            <div class="col-lg-12">
                {!! Form::model($settings,['method'=>'PATCH','url' => 'admin/setting/update']) !!}
                    @foreach($settings as $setting)
	                    <div class="form-group">
		                    {!! Form::label($setting->name) !!}
		                    {!! Form::text($setting->name, $setting->value, ['class' => 'form-control', 'required' => 'required']) !!}
	                    </div>
                    @endforeach

                    <div class="form-group">
	                    {!! Form::submit('Update Settings', ['class' => 'btn btn-success form-control']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        {{-- <form class="form" action="{{url('admin/setting.update')}}" method="patch">
            @csrf

            @foreach ($settings as $setting)
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label" name="name">{{ $setting->name }}</label>
                <div class="col-sm-10">
                    <input type="text" name="value" value="{{ $setting->value }}" class="form-control" id="" placeholder="Email">
                </div>
            </div>
            @endforeach

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form> --}}
    </div>
</div>
@endsection

@section('js')
@endsection
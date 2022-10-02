@extends('layouts.backend.master')

@section('title')
    show permissions
@endsection

@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">permissions : {{$role->name}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">show permission</li>
            </ol>
        </div>
    </div>
</div>

<!-- main body -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12" style="font-size: 20px">
                    <div class="form-group">
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            <span class="badge badge-info p-2">{{ $v->name }}</span>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();"><i class="ft-x"></i>back</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

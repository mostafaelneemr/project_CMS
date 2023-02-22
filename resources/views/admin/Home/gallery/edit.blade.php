@extends('layouts.backend.master')

@section('title')
    edit portfolio section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit portfolio section</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">edit portfolio</li>
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
                    <form class="form" action="{{route('gallery-section.update', $pics->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{$pics->id}}" />
                        <input type="hidden" name="old_image" value="{{$pics->image_url}}" />

                        <div class="form-group">
                            <div class="text-center">
                                <img src="{{asset($pics->image_url)}}"
                                    class="rounded-circle  h-25 w-25"  alt="image slider">
                            </div>
                        </div>

                        <div class="form-group">
                            <label> picture</label>
                            <label class="file center-block">
                                <input type="file" id="file" name="image_url">
                                <span class="file-custom"></span>
                            </label>
                            @error('image_url')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="form-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>title</label>
                                    <input type="text" name="title" value="{{$pics->title}}" class="form-control @error('title') is-invalid @enderror" required>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                            </div>
                        </div>
    
                        <div class="form-actions">
                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();"><i class="ft-x"></i>back</button>
                            <button type="submit" class="btn btn-success"><i class="la la-check-square-o"></i>save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
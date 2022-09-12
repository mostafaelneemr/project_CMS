@extends('layouts.backend.master')

@section('title')
    edit slider section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit slider section</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">dashboard</a></li>
                    <li class="breadcrumb-item active">edit slider</li>
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
                    <form class="form" action="{{route('home-slider.update', $sliders->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input name="id" value="{{$sliders->id}}" type="hidden">
                        {{-- <div class="form-group">
                            <div class="text-center">
                                <img
                                    src="{{$sliders->image_url}}"
                                    class="rounded-circle  height-150" alt="image slider">
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label>picture</label>
                            <label class="file center-block">
                                <input type="file" id="file" name="image_url">
                                <span class="file-custom"></span>
                            </label>
                            @error('image_url')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    
                        <div class="form-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>title</label>
                                    <input type="text" name="title" value="{{$sliders->title}}" class="form-control @error('title') is-invalid @enderror" >
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>sub title</label>
                                    <input type="text" name="sub_title" value="{{$sliders->sub_title}}" class="form-control @error('sub_title') is-invalid @enderror">
                                    @error('sub_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="form-group col-md-4">
                                    <label>button</label>
                                    <input type="text" name="button" value="{{$sliders->button}}" class="form-control @error('button') is-invalid @enderror">
                                    @error('button')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="form-actions">
                            <button type="button" class="btn btn-warning mr-1"
                                    onclick="history.back();"><i class="ft-x"></i>back
                            </button>
                            <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>save</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection



@section('js')
@endsection
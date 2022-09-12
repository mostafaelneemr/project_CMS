@extends('layouts.backend.master')

@section('title')
    Edit service section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit service section</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Edit service page</li>
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
                        <form class="form" action="{{route('service-section.update', $services->id)}}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="form-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>thumbnail</label>
                                        <input type="text" name="thumbnail" value="{{$services->thumbnail}}" class="form-control @error('thumbnail') is-invalid @enderror" >
                                        @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>title</label>
                                        <input type="text" name="title" value="{{$services->title}}" class="form-control @error('title') is-invalid @enderror" >
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>details</label>
                                        <textarea name="details" class="form-control" id="details" rows="5">{!! $services->details !!}</textarea>
                                        @error('details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>published</label>
                                        <select name="is_published" class="select2 form-control">
                                            <optgroup label="choose publish ablut post">
                                                <option value=1>publish</option>
                                                <option value=0>draft</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-warning mr-1"
                                        onclick="history.back();"><i class="ft-x"></i>back
                                </button>
                                <button type="submit" class="btn btn-success"><i class="la la-check-square-o"></i>save</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('details');
        });
    </script>
@endsection
@extends('layouts.backend.master')

@section('title')
    edit page
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Edit page</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">edit page</li>
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
                    <form class="form" action="{{route('pages.update', $pages->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label> picture</label>
                            <label id="projectinput7" class="file center-block">
                                <input type="file" id="file" name="thumbnail">
                                <span class="file-custom"></span>
                            </label>
                            @error('thumbnail')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    
                        <div class="form-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>title</label>
                                    <input type="text" name="title" value="{{$pages->title}}" class="form-control @error('title') is-invalid @enderror" >
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>sub title</label>
                                    <input type="text" name="sub_title" value="{{$pages->sub_title}}" class="form-control @error('sub_title') is-invalid @enderror">
                                    @error('sub_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>details</label>
                                    <textarea name="details" class="form-control" id="details" rows="5">{!! $pages->details !!}</textarea>
                                    @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('details');
        });
    </script>
@endsection
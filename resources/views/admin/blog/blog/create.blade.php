@extends('layouts.backend.master')

@section('title')
    create blog section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Create blog section</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">create blog section</li>
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
                        <form class="form" action="{{route('blog-section.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label> picture</label>
                                <label id="projectinput7" class="file center-block">
                                    <input type="file" id="file" name="image_url" required>
                                    <span class="file-custom"></span>
                                </label>
                                @error('image_url')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>thumbnail</label>
                                        <input type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" value="{{ old('thumbnail') }}" required />
                                        @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required />
                                        @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>description</label>
                                        <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>day</label>
                                        <input type="number" name="day" id="day" class="form-control @error('day') is-invalid @enderror" value="{{ old('day') }}" required />
                                        @error('day')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>month</label>
                                        <input type="month" name="month" class="form-control @error('month') is-invalid @enderror" value="{{ old('month') }}" required /> 
                                        @error('month')
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('description');
        });
    </script>
@endsection
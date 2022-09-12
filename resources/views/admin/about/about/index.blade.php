@extends('layouts.backend.master')

@section('title')
    about-section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">About</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">About Us page</li>
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
                {{-- button Add new Product --}}
                <div class="row">
                    <div class="col mb-3">
                        @if (\App\Models\backend\home\about::where('content_type', 'about')->count() == 0)
                            <a href="{{route('about-section.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                        @endif
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered p-0 text-center table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>title</th>
                            <th>details</th>
                            <th>operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($abouts as $about)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td> <img style="width: 150px; height: 100px;" src="{{asset($about->image_url)}}"></td>
                                <td>{{$about->title}}</td>
                                <td>{!! $about->details !!}</td>
                                <td>
                                    <a href="{{route('about-section.edit',$about->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        
                                    <button class="btn btn-danger btn-sm" data-about_id="{{$about->id}}"
                                        data-toggle="modal" data-target="#deletedabout"><i class="fa fa-trash" title="delete"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                @include('admin.about.about.delete')
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('#deletedabout').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var about_id = button.data('about_id')
        var modal = $(this)
        modal.find('.modal-body #about_id').val(about_id);
    })
</script>
@endsection
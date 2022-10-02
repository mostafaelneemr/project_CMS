@extends('layouts.backend.master')

@section('title')
    slider-section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Slider</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">slider home page</li>
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
                {{-- button Add new slider --}}
                @can('role-create')
                <div class="row">
                    <div class="col mb-3">
                        @if (\App\Models\backend\home\slider::where('slider_type', 'about')->count() == 0)
                            <a href="{{route('about-slider.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                        @endif
                    </div>
                </div>
                @endcan

                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered p-0 text-center table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>title</th>
                            <th>sub titile</th>
                            <th>operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td> <img style="width: 150px; height: 100px;" src="{{asset($slider->image_url)}}"></td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->sub_title}}</td>
                                <td>

                                    @can('role-edit')
                                    <a href="{{route('about-slider.edit',$slider->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    @can('role-delete')
                                    <button class="btn btn-danger btn-sm" data-slide_id="{{$slider->id}}"  data-toggle="modal" 
                                        data-target="#deleteslider"><i class="fa fa-trash"  title="Delete"></i></button>
                                    @endcan
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @include('admin.about.slider.delete')
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#deleteslider').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var slide_id = button.data('slide_id')
        var modal = $(this)
        modal.find('.modal-body #slide_id').val(slide_id);
    })
</script>
@endsection


@extends('layouts.backend.master')

@section('title')
    portfolio-section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Portfolio</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">portfolio page</li>
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
                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    {{-- button Add new Product --}}
                                    <div class="row">
                                        <div class="col mb-3">
                                                <a href="{{route('gallery-section.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                                        </div>
                                    </div>
                
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped table-bordered p-0 text-center table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>image</th>
                                                <th>title</th>
                                                <th>operation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pics as $pic)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td> <img style="width: 200px; height: 100px;" src="{{asset($pic->image_url)}}"></td>
                                                    <td>{{$pic->title}}</td>
                                                    <td>
                                                        <a href="{{route('gallery-section.edit',$pic->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        
                                                        <button class="btn btn-danger btn-sm" data-pic_id="{{$pic->id}}"
                                                            data-toggle="modal" data-target="#deletedportfolio"><i class="fa fa-trash" title="delete"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('admin.Home.gallery.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('#deletedportfolio').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var pic_id = button.data('pic_id')
        var modal = $(this)
        modal.find('.modal-body #pic_id').val(pic_id);
    })
</script>
@endsection
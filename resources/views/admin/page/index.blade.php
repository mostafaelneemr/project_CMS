@extends('layouts.backend.master')

@section('title')
    Pages
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Pages</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">page links</li>
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
                                                <a href="{{route('pages.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                                        </div>
                
                                    </div>
                
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped table-bordered p-0 text-center table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>image</th>
                                                <th>title</th>
                                                <th>sub title</th>
                                                <th>details</th>
                                                <th>operation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pages as $page)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td> <img style="width: 150px; height: 100px;" src="{{asset($page->thumbnail)}}"></td>
                                                    <td>{{$page->title}}</td>
                                                    <td>{{$page->sub_title }}</td>
                                                    <td>{!! $page->details !!}</td>
                                                    <td>
                                                        <a href="{{route('pages.edit',$page->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        
                                                        <button class="btn btn-danger btn-sm" data-page_id="{{$page->id}}"
                                                            data-toggle="modal" data-target="#deletedpage"><i class="fa fa-trash" title="delete"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('admin.page.delete')
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
    $('#deletedpage').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var page_id = button.data('page_id')
        var modal = $(this)
        modal.find('.modal-body #page_id').val(page_id);
    })
</script>
@endsection
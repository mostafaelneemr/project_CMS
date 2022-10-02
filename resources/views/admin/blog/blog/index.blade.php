@extends('layouts.backend.master')

@section('title')
    blog section
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Blogs</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">blog page</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- main body -->

    @include('admin.message')

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    
                    @can('role-create')
                    <div class="row">
                        <div class="col mb-3">
                                <a href="{{route('blog-section.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                        </div>
                    </div>
                    @endcan

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>thumbnail</th>
                                <th>photo</th>
                                <th>title</th>
                                <th>description</th>
                                <th>operation</th> 
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$blog->thumbnail}}</td>
                                    <td> <img style="width: 150px; height: 100px;" src="{{asset($blog->image_url)}}"></td>
                                    <td>{{$blog->title}}</td>
                                    <td>{!! $blog->description !!}</td>
                                    {{-- <td class={{$service->is_published == 1 ? 'text-success':'text-danger'}}>{{$service->is_published == 1 ? 'published' : 'draft'}}</td> --}}
                                    <td>
                                        @can('role-edit')
                                        <a href="{{route('blog-section.edit',$blog->id)}}" class="btn btn-info btn-sm"
                                           title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                        @endcan

                                        @can('role-delete')
                                        <button class="btn btn-danger btn-sm" data-blog_id="{{$blog->id}}"
                                            data-toggle="modal" data-target="#deletedblog"><i class="fa fa-trash" title="delete"></i></button>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.blog.blog.delete')
    </div>    
@endsection

@section('js')
<script>
    $('#deletedblog').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var blog_id = button.data('blog_id')
        var modal = $(this)
        modal.find('.modal-body #blog_id').val(blog_id);
    })
</script>
@endsection
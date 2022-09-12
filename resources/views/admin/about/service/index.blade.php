@extends('layouts.backend.master')

@section('title')
    service-section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Service</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">service page</li>
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
                    {{-- button Add new service --}}
                    <div class="row">
                        <div class="col mb-3">
                                <a href="{{route('about-service.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>details</th>
                                <th>published</th>
                                <th>operation</th> 
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$service->title}}</td>
                                    <td>{!! $service->details !!}</td>
                                    <td class={{$service->is_published == 1 ? 'text-success':'text-danger'}}>{{$service->is_published == 1 ? 'published' : 'draft'}}</td>
                                    <td>
                                        <a href="{{route('service-section.edit',$service->id)}}" class="btn btn-info btn-sm"
                                           title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>

                                        <button class="btn btn-danger btn-sm" data-serv_id="{{$service->id}}"
                                        data-toggle="modal" data-target="#deletedservice"><i class="fa fa-trash" title="delete"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.service.service.delete')
    </div>    
@endsection

@section('js')
<script>
    $('#deletedservice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var serv_id = button.data('serv_id')
        var modal = $(this)
        modal.find('.modal-body #serv_id').val(serv_id);
    })
</script>
@endsection
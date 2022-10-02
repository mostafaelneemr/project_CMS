@extends('layouts.backend.master')

@section('title')
    helps-section
@endsection

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Helps</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">helps home page</li>
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

                @can('role-create')
                <div class="row">
                    <div class="col mb-3">
                        @if (\App\Models\backend\home\about::where('content_type', 'home')->count() == 0)
                            <a href="{{route('help-section.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
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
                            <th>details</th>
                            <th>button</th>
                            <th>operation</th>
                        </tr>
                         </thead>
                        <tbody>
                        @foreach($helps as $help)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td> <img style="width: 150px; height: 100px;" src="{{asset($help->image_url)}}"></td>
                                <td>{{$help->title}}</td>
                                <td>{!! $help->details !!}</td>
                                <td>{{$help->button }}</td>
                                <td>
                                    @can('role-edit')
                                    <a href="{{route('help-section.edit',$help->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    @can('role-delete')
                                    <button class="btn btn-danger btn-sm" data-help_id="{{$help->id}}"
                                        data-toggle="modal" data-target="#deletedhelp"><i class="fa fa-trash" title="delete"></i></button>
                                        @endcan

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                     </table>
                </div>
            </div>
            @include('admin.Home.helps.delete')
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#deletedhelp').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var help_id = button.data('help_id')
        var modal = $(this)
        modal.find('.modal-body #help_id').val(help_id);
    })
</script>
@endsection
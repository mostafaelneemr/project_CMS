@extends('layouts.backend.master')

@section('title')
    logo-section
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">logo</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">logo</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- main body -->

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
                                                <a href="{{route('logo-section.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                                        </div>
                                    </div>
                
                                    <div class="table-responsive">
                                        <table id="" class="table table-success table-bordered p-0 text-center table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>title</th>
                                                <th>image</th>
                                                <th>operation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($logos as $logo)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$logo->brand}}</td>
                                                    <td> <img style="width: 150px; height: 100px;" src="{{asset($logo->logo)}}"></td>
                                                    <td>
                                                        <a href="{{route('logo-section.edit',$logo->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        
                                                        <button class="btn btn-danger btn-sm" data-logo_id="{{$logo->id}}"  data-toggle="modal" 
                                                            data-target="#deletedlogo"><i class="fa fa-trash"  title="Delete"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('admin.service.logo.delete')
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
    $('#deletedlogo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var logo_id = button.data('logo_id')
        var modal = $(this)
        modal.find('.modal-body #logo_id').val(logo_id);
    })
</script>
@endsection
@extends('layouts.backend.master')

@section('title')
    about-teams
@endsection

@section('css')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">Teams</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Team about page</li>
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
                                            {{-- @if (\App\Models\backend\home\about::where('content_type', 'about')->count() == 0) --}}
                                                <a href="{{route('about-team.create')}}" class="btn btn-success" role="button" aria-pressed="true">create</a> 
                                            {{-- @endif --}}
                                        </div>
                
                                    </div>
                
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped table-bordered p-0 text-center table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>image</th>
                                                <th>title</th>
                                                <th>sub_title</th>
                                                <th>operation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($teams as $team)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td> <img style="width: 100px; height: 150px;" src="{{asset($team->image)}}"></td>
                                                    <td>{{$team->title}}</td>
                                                    <td>{{$team->sub_title }}</td>
                                                    <td>
                                                        <a href="{{route('about-team.edit',$team->id)}}" class="btn btn-info btn-sm" title="Edit" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        
                                                        <button class="btn btn-danger btn-sm" data-team_id="{{$team->id}}"
                                                            data-toggle="modal" data-target="#deleteteam"><i class="fa fa-trash" title="delete"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @include('admin.about.team.delete')
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
    $('#deleteteam').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var team_id = button.data('team_id')
        var modal = $(this)
        modal.find('.modal-body #team_id').val(team_id);
    })
</script>
@endsection
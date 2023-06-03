@extends('layouts.backend.master')

@section('title')
    Settings
@endsection

@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- message status and error M.N -->
            @include('admin.message')

            <div class="example-preview">
                <ul class="nav nav-tabs nav-tabs-line">
                    @foreach($settingGroups as $key => $value)
                        <li class="nav-item">
                            <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#kt_tab_pane_1_{{$key}}_tab_content" role="tab">
                                {{str_replace('_',' ',$value->group_name)}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="card-body">
                <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    {{ csrf_field() }}
                    <div class="tab-content mt-5" id="myTabContent">


                    @foreach($settingGroups as $key => $value)
                        <div class="tab-pane fade @if($key == 0) active show @endif" id="kt_tab_pane_1_{{$key}}_tab_content" role="tabpanel">
                            @foreach($setting[$key] as $sKey => $sValue)
                                @if($sValue->input_type == 'text')
                                    <div class="form-group row">
                                        {!! Form::label($sValue->name,$sValue->{'shown_name_'.\App::getLocale()},['class'=>'col-3 col-form-label']) !!}
                                        <div class="col-9">
                                            {!! Form::text($sValue->name,$sValue->value,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                @elseif($sValue->input_type == 'number')
                                    <div class="form-group row">
                                        {!! Form::label($sValue->name,$sValue->{'shown_name_'.\App::getLocale()},['class'=>'col-3 col-form-label']) !!}
                                        <div class="col-9">
                                            {!! Form::number($sValue->name,$sValue->value,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                @elseif($sValue->input_type == 'textarea')
                                    <div class="form-group row">
                                        {!! Form::label($sValue->name,$sValue->{'shown_name_'.\App::getLocale()},['class'=>'col-3 col-form-label']) !!}
                                        <div class="col-9">
                                            {!! Form::textarea($sValue->name,$sValue->value,['class'=>'form-control','rows'=>3]) !!}
                                        </div>
                                    </div>
                                @elseif($sValue->input_type == 'image')
                                    <div class="form-group row">
                                        {!! Form::label($sValue->name,$sValue->{'shown_name_'.\App::getLocale()},['class'=>'col-3 col-form-label']) !!}
                                        <div  @if($sValue->value) class="col-7" @else class="col-9" @endif>
                                            {!! Form::file($sValue->name,['class'=>'form-control','rows'=>3, 'enctype'=>"multipart/form-data" ]) !!}
                                        </div>
                                        @if($sValue->value)
                                            <div class="col-2">
                                                <a target="_blank" href="{{asset($sValue->value)}}">{{__('View')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($sValue->input_type == 'select')
                                    <div class="form-group row">
                                        {!! Form::label($sValue->name,$sValue->{'shown_name_'.\App::getLocale()},['class'=>'col-3 col-form-label']) !!}
                                        <div class="col-9">
                                            @php
                                                $listValues = $sValue->option_list;
                                                $listSelect = [];
                                                foreach($listValues as $lKey => $lValue){
                                                $listSelect[$lKey] = __($lValue);
                                                }
                                            @endphp
                                            {!! Form::select($sValue->name,$listSelect,$sValue->value,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
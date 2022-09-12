@extends('layouts.website.master')

@section('title')
    {{$page->slug}} 
@endsection

@section('css')
    <style>
        .line {
            color: #000;
        }
    </style>
@endsection

@section('content')
<section id="subheader" class="text-light" data-bgimage="url({{asset($page->thumbnail)}})" data-stellar-background-ratio=".2">
    <div class="overlay-bg t50">
         <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$page->title}}</h1>
                    <p>{{$page->sub_title}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="section-side" class="line no-padding">
    <div class="container">
        <div class="row">
            <div class="inner-padding">
                <div class="col-md-12 wow fadeIn">
                    <h2 class="mb20">We Make Your Dream</h2>
                    <p>{!! $page->details !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection
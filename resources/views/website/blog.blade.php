@extends('layouts.website.master')

@section('title')
    Blog 
@endsection

@section('css')
    <style>
        .overlay-img { height:300px };
    </style>
@endsection

@section('content')
    <!-- section begin -->
    @foreach ($sliders as $slider)
    <section id="subheader" class="text-light" data-bgimage="url({{asset($slider->image_url)}})" data-stellar-background-ratio=".2">
        <div class="overlay-bg t50">
             <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{$slider->title}}</h1>
						<p>{{$slider->sub_title}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    <!-- section close -->

     <!-- section begin -->
    <section id="section-services" data-bgcolor="#f9f9f9">
        <div class="container">
            <div class="row">
                 @foreach ($blogs as $blog)                
                <div class="col-md-4 mb30">
                     <div class="picframe wow mb20">
                        <a href="{{url('blog/' . $blog->slug)}}">
                            <span class="overlay">
								<span class="title">
									<span>{{$blog->thumbnail}}</span>
								</span>
                             </span>
                            <img src="{{asset($blog->image_url)}}" class="wow overlay-img" alt="" />
                        </a>
                    </div>

                     <div class="post-item s1 item">
                        <div class="date-box">
                            <div class="m">{{$blog->day}}</div>
                            <div class="d">{{$blog->month}}</div>
                         </div>

                         <div class="post-content">
                            <div class="post-text">
                                <h3><a href="{{url('blog/' . $blog->slug)}}">{{$blog->title}}</a></h3>
                                <p>{!! $blog->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- section close -->
@endsection

@section('js')
@endsection
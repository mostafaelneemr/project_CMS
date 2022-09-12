@extends('layouts.website.master')

@section('title')
    Services
@endsection

@section('css')
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
    <section id="section-services">
        <div class="container">
            <div class="row sequence">
                <!-- feature box begin -->
            @foreach ($services as $service)
                <div class="col-md-4 col-sm-6 mb40 sq-item wow sq-item wow">
                    <div class="feature-box style-2 left">
                        <i class="icon-pencil"></i>
                        <div class="text">
                            <a href="{{url('service/' . $service->slug)}}"><h3>{{$service->title}}</h3> </a>
                            {!! $service->details !!}
                        </div>
                    </div>
                </div>
            @endforeach
                <!-- feature box close -->
            </div>
        </div>
    </section>
    <!-- section close -->


    <!-- section begin -->
    <section id="section-clients" aria-label="section" class="pt60 pb40" data-bgcolor="#f9f9f9">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center wow fadeInUp">
                    <div class="owl-carousel owl-sponsors gray">
                    @foreach ($logos as $logo)                    
                        <div class="item"><img src="{{asset($logo->logo)}}" alt=""></div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
@endsection

@section('js')
@endsection
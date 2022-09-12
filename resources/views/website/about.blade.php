@extends('layouts.website.master')

@section('title')
    About Us 
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
    @foreach ($abouts as $about)        
    <section id="section-side" class="side-bg no-padding" data-bgcolor="#f9f9f9">
        <div class="image-container col-md-7 pull-left d-block d-sm-none d-md-block">
            <div class="background-image" data-bgimage="url({{asset($about->image_url)}})"></div>
        </div>

        <div class="container">
            <div class="row">
                <div class="inner-padding">
                    <div class="col-md-4 offset-md-8 wow fadeIn">
                        <h2 class="mb20">{{$about->title}}</h2>
                        <p>{!! $about->details !!}</p>
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
            <div class="row align-items-center">
				<div class="col-md-8">
					<div class="row sequence">
						<!-- feature box begin -->
                        @foreach ($services as $service)                            
						<div class="col-md-6 mb40 sq-item wow sq-item wow">
							<div class="feature-box style-2">
								<i class="icon-pencil"></i>
								<div class="text">
									<h3>{{$service->title}}</h3>
									{!! $service->details !!}
								</div>
							</div>
						</div>
                        @endforeach
						<!-- feature box close -->
					</div>
				</div>
						
				<div class="col-md-4">
					<figure class="picframe invert transparent hover-shadow">
                            <span class="overlay-v">
								<span class="v-center">
									<span>
										<a id="play-video" class="video-play-button popup-youtube" href="{{setting('link-video')}}">
											<span></span>
										</a>
									</span>
								</span>
							</span>
                         <img src="{{asset('website/images/misc/3.jpg')}}" class="img-fullwidth" alt="">
                    </figure>
				</div>
		    </div>
					
        </div>
    </section>
    <!-- section close -->

	<!-- section begin -->
	<section class="bg-color text-light pt40 pb40">
		<div class="container">
             <div class="row">
				<div class="col-md-12 text-center">
					<h2 class="no-bottom">Meet The Team</h2>
				</div>
			</div>
		</div>
	</section>
	<!-- section close -->


	<!-- section begin -->
    <section id="section-team" class="no-padding">
        <div class="container-fluid">
            <div class="row no-gutters">
                @foreach ($teams as $team) 
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="profile_pic text-center">
                        <figure class="picframe sc-icon mb20">
                            <div class="icons">
                                <a href="{{setting('facebook')}}" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                <a href="{{setting('twitter')}}" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                <a href="{{setting('linked')}}" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a>
                                <a href="{{setting('github')}}" target="_blank"><i class="fa fa-google-plus fa-lg"></i></a>
                            </div>
                            <img src="{{asset($team->image)}}" class="img-fluid" alt="">
                        </figure>
                        <h3>{{$team->title}}</h3>
                        <span class="subtitle">{{$team->sub_title}}</span>
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
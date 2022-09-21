@extends('layouts.website.master')
    
@section('title')
    Home 
@endsection

@section('css')
@endsection

@section('content')
    <!-- section begin -->
    @foreach ($sliders as $slider)
    <section id="section-intro" class="full-height relative owl-slide-wrapper text-light no-top no-bottom" data-stellar-background-ratio=".2" 
        data-bgimage="url({{asset($slider->image_url)}})"> 
        <div class="overlay-bg t50">
            <div class="center-y relative">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                                <div class="spacer-double d-block d-sm-none d-md-block"></div>
                                 <h3>{{$slider->title}}</h3>
                                <h1 class="big b">{{$slider->sub_title}}</h1>
                                <div class="spacer-single"></div>
                                <a href="{{setting('link-button')}}" class="btn-custom">{{$slider->button}}</a> 
                         </div>
                    </div>
                </div>
            </div>
        </div>
    
        <a href="#section-services" class="scroll-to">
            <span class="mouse">
                <span class="scroll"></span>
            </span>
        </a>
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
					        <div class="feature-box style-2 left">
						        <i class="icon-pencil"></i>
							        <div class="text">
								        <a href="{{route('service')}}"><h3>{{$service->title}}</h3></a>
				    				        {!! $service->details !!}
							        </div>
						    </div>
					    </div>
                        @endforeach
						<!-- feature box close -->
					</div>
				</div>
					
			    <div class="col-md-4">
					<figure class="picframe invert transparent hover-shadow rounded">
                            <span class="overlay-v">
								<span class="v-center">
									<span>
										<a id="play-video" class="video-play-button popup-youtube" href="{{setting('link-video')}}">
											<span></span>
										</a>
									</span>
								</span>
							</span>
                        <img src="{{asset('website/images/misc/2.jpg')}}" class="img-fullwidth" alt="">
                    </figure>
			    </div>
			</div>	
        </div>
    </section>
    <!-- section close -->

		<!-- section begin -->
        {{-- <section class="bg-color text-light pt60 pb60">
                    <div class="container">
    
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6 mb-sm-30">
                                <div class="de_count">
                                    <h3 class="timer" data-to="8240" data-speed="2500">0</h3>
                                    <span>Hours of Works</span>
                                </div>
                            </div>
    
                            <div class="col-md-3 col-sm-6 col-xs-6 mb-sm-30">
                                <div class="de_count">
                                    <h3 class="timer" data-to="315">0</h3>
                                    <span>Projects Done</span>
                                </div>
                            </div>
    
                            <div class="col-md-3 col-sm-6 col-xs-6 mb-sm-30">
                                <div class="de_count">
                                    <h3 class="timer" data-to="250">0</h3>
                                    <span>Satisfied Customers</span>
                                </div>
                            </div>
    
                            <div class="col-md-3 col-sm-6 col-xs-6 mb-sm-30">
                                <div class="de_count">
                                    <h3 class="timer" data-to="32" data-speed="2500">0</h3>
                                    <span>Awards Winning</span>
                                </div>
                            </div>
                        </div>
                    </div>
        </section> --}}
        <!-- section close -->

    <!-- section begin -->
    <section data-bgcolor="#f9f9f9">
        <div class="container">
            <div class="row align-items-center">
                @foreach ($helps as $help)
                <div class="col-md-6">
                    <img src="{{asset($help->image_url)}}" class="mb-sm-30 img-fluid" alt="">
                </div>
                <div class="col-md-5 offset-md-1">
                    <h2 class="mb20">{{$help->title}}</h2>
                    <p>{!! $help->details !!}</p>
                    <div class="spacer-half"></div>
                    <a href="{{setting('Link-button')}}" class="btn-custom scroll-to">{{$help->button}}</a>
                </div>
                @endforeach
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <!-- section begin -->
    <section id="section-portfolio" aria-label="section-portfolio" class="no-top no-bottom" data-bgcolor="#fafafa">
        <div class="container-fluid">
             <div class="row no-gutters gallery-wrap sequence_pf">
    
                <!-- gallery item -->
            @foreach($galleries as $gallery)
                <div class="col-lg-4 col-md-6 col-sm-6 sq-item">
                    <div class="picframe wow">
                         <div data-value="project-details-image.html">
                             <span class="overlay">
                                    <span class="title"> <span>{{$gallery->title}}</span> </span>
                            </span>
                            <img src="{{asset($gallery->image_url)}}" class="wow" alt="" />
                        </div>
                    </div>
                </div>
            @endforeach
                <!-- close gallery item -->
            </div>
        </div>
     </section>
    <!-- section close -->

    <section id="section-blog" data-bgcolor="#f9f9f9">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="blog-carousel" class="owl-carousel owl-theme">
                        @foreach ($blogs as $blog)                        
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
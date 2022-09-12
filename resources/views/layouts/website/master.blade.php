<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('layouts.website.head')
</head>

<body>
    <div id="wrapper">

        <div class="page-overlay">
            <div class="preloader-wrap">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>

        <!-- header begin -->
        <header class="transparent scroll-light clone smaller">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- logo begin -->
                        <div id="logo">
                            <a href="{{route('home')}}">
                                <img class="logo" src="{{asset('website/images/logo-light.png')}}" alt="">
                                <img class="logo-2" src="{{asset('website/images/logo-dark.png')}}" alt="">
                            </a>
                        </div>
                        <!-- logo close -->
                        <!-- small button begin -->
                        <span id="menu-btn"></span>
                        <!-- small button close -->
                        <!-- mainmenu begin -->
                        <nav>
                            <ul id="mainmenu">
                                <li><a href="{{route('home')}}">Home</a>
                                    
                                    @if (getPages()->count() > 0)
									<ul class="na mega">
                                        <li>
                                            <div class="container">
                                                <div class="menu-content">
                                                    <div class="row">
                                                        
                                                        @if ($pages = getPages())
                                                        @foreach ($pages as $page)
														<div class="col-md-12 mb-lg-4 mb-sm-0">
                                                            <a href="{{url('page/' . $page->slug)}}" class="no-padding">
                                                                {{$page->title}}
															</a>
														</div>
                                                        @endforeach
                                                        @endif
                                                        
														<div class="clearfix"></div>
													</div>
												</div>
											</div>
										</li>                                        
                                    </ul>
                                    @endif
                                    
								</li>
								<li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('service')}}">Services</a></li>
                                <li><a href="{{route('portfolio')}}">Portfolio</a></li>
                                <li><a href="{{route('blog')}}">Blog</a></li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </nav>
						<!-- mainmenu close -->

                    </div>

                </div>
            </div>
        </header>
        <!-- header close -->

        <!-- content begin -->
        <div id="content" class="no-bottom no-top">
            <div id="top"></div>
            <!-- section begin -->
            {{-- <section id="subheader" class="text-light" data-bgimage="url({{asset('website/images/background/13.jpg')}}" data-stellar-background-ratio=".2">
                <div class="overlay-bg t50">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Our Blog</h1>
								<p>Latest update from the company</p>
                            </div>
                        </div>
                    </div>

                </div>

            </section> --}}
            <!-- section close -->

            <!-- section begin -->
                {{-- <section id="section-services" data-bgcolor="#f9f9f9"> --}}
                    @yield('content')
                {{-- </section> --}}
            <!-- section close -->

        </div>
        <!-- content close -->

        <!-- footer begin -->
        <footer>
            @include('layouts.website.footer')
        </footer>
        <!-- footer close -->

        <a href="#" id="back-to-top" class="show"></a>

        <div id="preloader" style="background-size: cover; display:none;">
            <div class="preloader1" style="top:121px; background-size:cover;"></div>
        </div>

    </div>

    @include('layouts.website.script')
</body>
</html>
     <!-- section begin -->
     <section id="section-services" data-bgcolor="#f9f9f9">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb30">
                     <div class="picframe wow mb20">
                        <a href="">
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
                            <div class="m">Day : {{$blog->day}}</div>
                            <div class="d">Month : {{$blog->month}}</div>
                         </div>

                         <div class="post-content">
                            <div class="post-text">
                                <h3><a href="">{{$blog->title}}</a></h3>
                                <p>{!! $blog->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
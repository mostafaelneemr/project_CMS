<!-- section begin -->
<section id="section-services" data-bgcolor="#f9f9f9">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb30">
                <div class="picframe wow mb20">
                        <span class="overlay">
							<span class="title">
								<span>{{$services->thumbnail}}</span>
							</span>
                        </span>
                            <h1 class="text-center">{{$services->title}}</h1>

                        <div class="post-content">
                            <div class="post-text">
                                <p>{!! $services->details !!}</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section close -->
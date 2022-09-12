@extends('layouts.website.master')
    
@section('title')
    Portfolio 
@endsection

@section('css')
@endsection

@section('content')
    <!-- section begin -->
    <section id="section-portfolio" aria-label="section-portfolio" class="no-top no-bottom" data-bgcolor="#fafafa">
        <div class="container-fluid">
             <div class="row no-gutters gallery-wrap sequence_pf">
                <!-- gallery item -->
            @foreach($galleries as $gallery)
                <div class="col-lg-4 col-md-6 col-sm-6 sq-item">
                    <div class="picframe wow">
                         <div class="pf-click" data-value="project-details-image.html">
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
@endsection

@section('js')
@endsection
@extends('layouts.website.master')
    
@section('title')
    Contact 
@endsection

@section('content')
<div id="content" class="no-bottom no-top">
    <div id="top"></div>

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
    @if(Session::has('message'))
    <div class="alert alert-success">
        {{Session('message')}}
    </div>
    @endif
    
    <section id="section-contact" data-bgcolor="#f9f9f9">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-md-30">
                    <form name="contactForm" id='' class="de_form" method="post" action='{{route('contact.submit')}}'>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="field-set">
                                    <input type="text" name="name" id="name" class="form-control" @error('name') is-invalid @enderror value="{{ old('name') }}" placeholder="Your Name" required>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="line-fx"></div>
                                </div>

                                <div class="field-set">
                                    <input type="text" name="email" id="email" class="form-control" @error('email') is-invalid @enderror value="{{ old('email') }}" placeholder="Your Email" required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="line-fx"></div>
                                </div>

                                <div class="field-set">
                                    <input type="text" name="phone" id="phone" class="form-control" @error('phone') is-invalid @enderror value="{{ old('phone') }}" placeholder="Your Phone" required>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="line-fx"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="field-set">
                                    <textarea name="message" id="message" class="form-control" placeholder="Your Message"></textarea>
                                    @error('message')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="line-fx"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div id="submit">
                                    <input type="submit" id="" value="Submit Form" class="btn btn-custom color-2">
                                </div>
                                <div id="mail_success" class="success">Your message has been sent successfully.</div>
                                <div id="mail_fail" class="error">Sorry, error occured this time sending your message.</div>
                            </div>


                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <h6 class="id-color">Call Us</h6>
                        {{setting('call-us')}}
                    <div class="spacer-single"></div>
                    <h6 class="id-color">Address</h6>
                        {{setting('address')}}
                    <div class="spacer-single"></div>
                    <h6 class="id-color">Email Us</h6>
                        {{setting('email')}}
                </div>

            </div>

        </div>
    </section>
    <!-- section close -->

</div>
@endsection
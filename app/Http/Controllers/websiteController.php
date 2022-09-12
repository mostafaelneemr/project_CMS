<?php

namespace App\Http\Controllers;

use App\Events\PageViewer;
use App\Mail\VisitorContact;
use App\Models\backend\blog\Blog;
use App\Models\backend\home\about;
use App\Models\backend\home\gallery;
use App\Models\backend\home\Help;
use App\Models\backend\service\Service;
use App\Models\backend\home\Slider;
use App\Models\backend\home\team;
use App\Models\backend\service\logo;
use App\Models\viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class websiteController extends Controller
{
    public  function index()
    {
        $sliders = Slider::orderBy('id', 'DESC')->where('slider_type', 'home')->get();
        $services = Service::orderBy('id', 'DESC')->where('is_published', '1')->where('serv_type', 'home')->paginate(4);
        $helps = about::orderBy('id', 'DESC')->where('content_type', 'home')->where('is_published', '1')->latest()->paginate(1);
        $galleries = gallery::orderBy('id', 'DESC')->paginate(6);
        $blogs = Blog::orderBy('id', 'DESC')->get();
        $view = viewer::first();
        event(new PageViewer($view));
        return view('website.Home', compact('sliders', 'services', 'helps', 'galleries', 'blogs'));
    }

    public function about() {
        $sliders = Slider::orderBy('id', 'DESC')->where('slider_type', 'about')->get();
        $abouts = about::orderBy('id', 'DESC')->where('content_type', 'about')->get();
        $services = Service::orderBy('id', 'ASC')->where('serv_type', 'about')->paginate(2);
        $teams = team::orderBy('id', 'DESC')->paginate(4);
        return view('website.about', compact('sliders', 'abouts', 'services', 'teams'));
    }

    public function service()
    {
        $sliders = Slider::orderBy('id', 'DESC')->where('slider_type', 'service')->get();
        $services = service::orderBy('id', 'DESC')->where('is_published', '1')->get();
        $logos = logo::orderBy('id', 'DESC')->get();
        return view('website.services', compact('services', 'logos', 'sliders'));
    }

    public function portfolio()
    {
        $galleries = gallery::orderBy('id', 'DESC')->get();
        return view('website.portfolio', compact('galleries'));
    }

    public function blog()
    {   
        $sliders = Slider::orderBy('id', 'DESC')->where('slider_type', 'blog')->get();
        $blogs = Blog::orderBy('id', 'ASC')->get();
        return view('website.blog', compact('blogs', 'sliders'));
    }

    public function blogSlug($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('website.blog-slug', compact('blog'));
    }

    public function showContactForm(){
        $sliders = Slider::orderBy('id', 'DESC')->where('slider_type', 'contact')->get();
        return view('website.contact',compact('sliders'));
    }

    public function submitContactForm(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];
        Mail::to('sasatiger41@gmail.com')->send(new VisitorContact($data));
        
        session()->flash('message', 'thank you for contact');
        return redirect(route('contact'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\backend\blog\Blog;
use App\Models\backend\home\page;
use App\Models\backend\service\Service;

class websiteSlugController extends Controller
{
    public function blog($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('website.slug.blog-slug', compact('blog'));
    }

    public function service($slug)
    {
        $services = Service::where('slug', $slug)->first();
        return view('website.slug.service-slug', compact('services'));
    }

    public function page($slug)
    {
        $page = page::where('is_published', '1')->first();
        return view('website.slug.page', compact('page'));
    }
}

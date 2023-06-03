<?php

namespace App\Http\Controllers\backend\blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\slider\StoreSliderRequest;
use App\Http\Requests\slider\UpdateSliderRequest;
use App\Http\Requests\sliderRequest;
use App\Models\backend\home\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class blogSliderController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','store']]);
         $this->middleware('permission:slider-create', ['only' => ['create','store']]);
         $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sliders = Slider::where('slider_type', 'blog')->get();
        return view('admin.blog.slider.index', compact('sliders'));
    }

    public function create()
    {
        $slider = Slider::where('slider_type', 'blog')->count();
        if ($slider == 0) {
            return view('admin.blog.slider.create');
        }else{
            return redirect()->route('blog-slider.index');
        }
    }

    public function store(StoreSliderRequest $request)
    {
        try {
            $image = $request->file('image_url');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 540)->save('image/website/'.$name_gen);
            $filePath = 'image/website/'.$name_gen;

        Slider::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slider_type' => 'blog',
            'image_url' => $filePath,
        ]);

            session()->flash('Add', 'slider section add one slide');
            return redirect()->route('blog-slider.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('admin.blog.slider.edit', compact('sliders'));
    }

    public function update(UpdateSliderRequest $request, $id)
    {
        try {
            $sliders = Slider::findOrFail($id);

            if(!$sliders)
                return redirect()->back()->withErrors(['errors' => 'osps wrong']);

            if ($request->has('image_url')) {
                $filePath = uploadImage('website', $request->image_url);
                Slider::where('id', $id)->update([ 'image_url' => $filePath, ]);
            }

            $sliders->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]);

            session()->flash('edit', 'slider section is edited done');
            return redirect()->route('blog-slider.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $slider = Slider::findOrFail($request->blog_id);
            $image = Str::after($slider->image_url, 'image/');
            $image = public_path('image/' . $image);
            unlink($image);
            $slider->delete();

            session()->flash('Deleted' , 'slider section is deleted please create again one slider section for home page');
            return redirect()->back();

        } catch (\Exception $e) {
             return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
         }
    }
}

<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\slider\StoreSliderRequest;
use App\Http\Requests\slider\UpdateSliderRequest;
use App\Models\backend\home\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;



class homeSliderController extends Controller
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
        $sliders = Slider::where('slider_type', 'home')->get();
        return view('admin.Home.slider.index', compact('sliders'));
    }

    public function create()
    {
        $slider = Slider::where('slider_type', 'home')->count();
        if ($slider == 0) {
            return view('admin.Home.slider.create');
        }else{
            return redirect()->route('home-slider.index');
        }
    }

    public function store(StoreSliderRequest $request)
    {
        try {
            $image = $request->file('image_url');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1080)->save('image/website/'.$name_gen);
            $filePath = 'image/website/'.$name_gen;

            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'button' => $request->button,
                'slider_type' => 'home',
                'image_url' => $filePath,
            ]);

            $notification = array(
                'message' => 'Slider Section Is Added',
                'alert-type' => 'success',
            );
            return redirect::route('home-slider.index')->with($notification);
        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $sliders = Slider::findOrFail($id);
        return view('admin.Home.slider.edit', compact('sliders'));
    }

    public function update(UpdateSliderRequest $request, $id)
    {
        try {
            $sliders = Slider::findOrFail($id);
            $old_image = $request->old_image;

            if($request->file('image_url')) {
                @unlink($old_image);
                $image = $request->file('image_url');
                $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
                Image::make($image)->save('image/website/'.$name_gen);
                $filePath = 'image/website/'.$name_gen;
                Slider::where('id', $id)->update(['image_url' => $filePath]);
            }

            $sliders->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'button' => $request->button,
            ]);

            $notification = array(
                'message' => 'Slider Section Edited is Success',
                'alert-type' => 'info',
            );
            return redirect::route('home-slider.index')->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $slider = Slider::findOrFail($request->slide_id);
            // $image = Str::after($slider->image_url, 'image/');
            // $image = public_path('image/' . $image);
            // unlink($image);
            $img = $slider->image_url;
            @unlink($img);
            $slider->delete();

            session()->flash('Deleted' , 'slider section is deleted please create again one slider section for home page');
            $notification = array(
                'message' => 'Slider Section Home Is Deleted, Please Create One Again',
                'alert-type' => 'error',
            );
            return redirect::back()->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

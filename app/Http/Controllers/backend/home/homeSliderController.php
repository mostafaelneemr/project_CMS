<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\slider\StoreSliderRequest;
use App\Http\Requests\slider\UpdateSliderRequest;
use App\Models\backend\home\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class homeSliderController extends Controller
{
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
            return redirect(route('home-slider.index'));
        }
    }

    public function store(StoreSliderRequest $request)
    {
        try {
            $filePath = "";
            if ($request->has('image_url')) {
                $filePath = uploadImage('website', $request->image_url);
            };
        
        Slider::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'button' => $request->button,
            'slider_type' => 'home',
            'image_url' => $filePath,
        ]);

            session()->flash('Add','slider section add one slide');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]); 
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

            if(!$sliders)
                return redirect()->back()->withErrors(['errors' => 'osps wrong']);
            
            if ($request->has('image_url')) {
                $filePath = uploadImage('website', $request->image_url);
                Slider::where('id', $id)->update([ 'image_url' => $filePath, ]);
            }
            
            $sliders->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'button' => $request->button,
            ]);

            session()->flash('edit', 'slider section is edited done');
            return redirect(route('home-slider.index'));
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $slider = Slider::findOrFail($request->slide_id);
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

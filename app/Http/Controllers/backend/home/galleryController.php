<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Models\backend\home\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class galleryController extends Controller
{
    public function index()
    {
        $pics = gallery::all();
        return view('admin.Home.gallery.index', compact('pics'));
    }

    public function create()
    {
        return view('admin.Home.gallery.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|string|max:100',
                'image_url' => 'image|mimes:jpeg,png,jpg',
            ],
            [
                'title.string' => 'title should be string',
                'image_url.mimes' => 'image should be extension one of jpg , png or jpeg',
            ]);

            // $filePath = "";
            // if($request->has('image_url'));
            // $filePath = uploadImage('portfolio', $request->image_url);

            $image = $request->file('image_url');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->save('image/website/'.$name_gen);
            $filePath = 'image/website/'.$name_gen;

            gallery::create([ 'title' => $request->title, 'image_url' => $filePath, ]);

            // session()->flash('Add', 'one picture done added to gallery');
            $notification = array(
                'message' => 'One Picture Added to Gallery success',
                'alert-type' => 'success'
            );
            return redirect::route('gallery-section.index')->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $pics = gallery::findOrFail($id);
        return view('admin.Home.gallery.edit', compact('pics'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [ 
                'title' => 'required|string|max:100',
                'image_url' => 'image|mimes:jpeg,png,jpg',
            ],
            [
                'title.string' => 'title should be string',
                'image_url.mimes' => 'image should be extension one of jpg , png or jpeg',
            ]);
            $id = gallery::findOrFail($id);
            $old_image = $request->old_image;

            if($request->file('image_url')){
                @unlink($old_image);
                $image = $request->file('image_url');
                $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
                Image::make($image)->save('image/website/'.$name_gen);
                $filePath = 'image/website/'.$name_gen;
                gallery::where('id', $id)->update(['image_url' => $filePath]);
            }
            
            // $pics = gallery::findOrFail($id);
            // if($request->has('image_url')){
            //     $filePath = uploadImage('portfolio', $request->image_url);
            //     gallery::where('id', $id)->update([ 'image_url' => $filePath, ]);
            // }

            $id->update(['title' => $request->title,]);

            // session()->flash('edit', 'done edit picture from gallery');
            $notification = array(
                'message' => 'Edit Picture Is Success',
                'alert-type' => 'info',
            );
            return redirect::route('gallery-section.index')->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $pics = gallery::findOrFail($request->pic_id);
            // $image = Str::after($pics->image_url, 'image/');
            // $image = public_path('image/' . $image);

            $image = $pics->image_url;
            @unlink($image);
            $pics->delete();
        
            // session()->flash('Deleted', 'deleted one picture from gallery');
            $notification = array(
                'message' => 'Deleted Picture From Gallery is Success',
                'alert-type' => 'error'
            );
            return redirect::back()->with($notification);
            
        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

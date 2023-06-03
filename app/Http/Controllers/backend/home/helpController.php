<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\about\StoreAboutRequest;
use App\Http\Requests\about\UpdateAboutRequest;
use App\Models\backend\home\about;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class helpController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:home-list|home-create|home-edit|home-delete', ['only' => ['index','store']]);
         $this->middleware('permission:home-create', ['only' => ['create','store']]);
         $this->middleware('permission:home-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:home-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $helps = about::where('content_type', 'home')->get();
        return view('admin.Home.helps.index', compact('helps'));
    }

    public function create()
    {
        if (about::where('content_type', 'home')->count() == 0) {
            return view('admin.Home.helps.create');
        }else{
            return redirect::back();
            // return \Response()->view('website.error-404', array(), 404);
        }
    }

    public function store(StoreAboutRequest $request)
    {
        try {

            $image = $request->file('image_url');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(768, 459)->save('image/website/'.$name_gen);
            $filePath = 'image/website/'.$name_gen;

            about::create([
                'image_url' => $filePath,
                'title' => $request->title,
                'details' => $request->details,
                'button' => $request->button,
                'content_type' => 'home',
            ]);

            $notification = array(
                'message' => 'Help Section Added is Success',
                'alert-type' => 'success'
            );
            return redirect::route('help-section.index')->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $helps = about::findOrFail($id);
        return view('admin.Home.helps.edit', compact('helps'));
    }

    public function update(UpdateAboutRequest $request, $id)
    {
        try {
            $helps = about::findOrFail($id);
            $old_image = $request->old_image;
            // if($request->has('image_url')){
            //     $filePath = uploadImage('website', $request->image_url);
            //     about::where('id', $id)->update([ 'image_url' => $filePath, ]);
            // };

            if($request->file('image_url')){
                @unlink($old_image);
                $image = $request->file('image_url');
                $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
                Image::make($image)->save('image/website/'.$name_gen);
                $filePath = 'image/website/'.$name_gen;
                $helps->update(['image_url' => $filePath]);
            }

            $helps->update([
                'title' => $request->title,
                'details' => $request->details,
                'button' => $request->button,
            ]);

            // session()->flash('edit', 'done editing help section');
            $notification = array(
                'message' => 'Editing Help Section is Success',
                'alert-type' => 'info',
            );
            return redirect::route('help-section.index')->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $helps = about::findOrFail($request->help_id);
            // $image = Str::after($helps->image_url, 'image/');
            // $image = public_path('image/' . $image);

            $image = $helps->image_url;
            unlink($image);
            $helps->delete();

            // session()->flash('Deleted', 'section help is deleted please insert one helps section');
            $notification = array(
                'message' => 'Section Help is Deleted, Please add one again',
                'alert-type' => 'error',
            );
            return redirect::back()->with($notification);

        } catch (\Exception $e) {
            return redirect::back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

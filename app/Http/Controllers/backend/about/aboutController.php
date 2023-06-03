<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Http\Requests\about\StoreAboutRequest;
use App\Http\Requests\about\UpdateAboutRequest;
use App\Models\backend\home\about;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class aboutController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:about-list|about-create|about-edit|about-delete', ['only' => ['index','store']]);
         $this->middleware('permission:about-create', ['only' => ['create','store']]);
         $this->middleware('permission:about-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:about-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $abouts = about::where('content_type', 'about')->get();
        return view('admin.about.about.index', compact('abouts'));
    }

    public function create()
    {
        $about = about::where('content_type', 'about')->count();
        if ($about == 0) {
            return view('admin.about.about.create');
        }
    }

    public function store(StoreAboutRequest $request)
    {
        try {
            $image = $request->file('image_url');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1180)->save('image/website/'.$name_gen);
            $filePath = 'image/website/'.$name_gen;

            about::create([
                'image_url' => $filePath,
                'title' => $request->title,
                'details' => $request->details,
                'content_type' => 'about',
            ]);

            session()->flash('Add', 'Done added helps section');
            return redirect()->route('about-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $abouts = about::findOrFail($id);
        return view('admin.about.about.edit', compact('abouts'));
    }

    public function update(UpdateAboutRequest $request, $id)
    {
        try {
            $abouts = about::findOrFail($id);

            if($request->has('image_url')){
                $filePath = uploadImage('website', $request->image_url);
                about::where('id', $id)->update([ 'image_url' => $filePath, ]);
            };

            $abouts->update([
                'title' => $request->title,
                'details' => $request->details,
            ]);

            session()->flash('edit', 'done editing help section');
            return redirect()->route('about-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $abouts = about::findOrFail($request->about_id);
            $image = Str::after($abouts->image_url, 'image/');
            $image = public_path('image/' . $image);
            unlink($image);
            $abouts->delete();

            session()->flash('Deleted', 'section about is deleted please create one about section to review in about page');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

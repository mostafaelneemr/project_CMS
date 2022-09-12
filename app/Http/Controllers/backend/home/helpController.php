<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Http\Requests\about\StoreAboutRequest;
use App\Http\Requests\about\UpdateAboutRequest;
use App\Models\backend\home\about;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class helpController extends Controller
{
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
            return redirect()->back();
            // return \Response()->view('website.error-404', array(), 404);
        }    
    }

    public function store(StoreAboutRequest $request)
    {
        try {
            $filePath = "";
            if($request->has('image_url')) { 
                $filePath = uploadImage('website', $request->image_url);
            }

            about::create([
                'image_url' => $filePath,
                'title' => $request->title,
                'details' => $request->details,
                'button' => $request->button,
                'content_type' => 'home',
            ]);
            
            session()->flash('Add', 'Done added helps section');
            return redirect(route('help-section.index'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
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

            if($request->has('image_url')){
                $filePath = uploadImage('website', $request->image_url);
                about::where('id', $id)->update([ 'image_url' => $filePath, ]);
            };

            $helps->update([
                'title' => $request->title,
                'details' => $request->details,
                'button' => $request->button,
            ]);

            session()->flash('edit', 'done editing help section');
            return redirect()->route('help-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $helps = about::findOrFail($request->help_id);
            $image = Str::after($helps->image_url, 'image/');
            $image = public_path('image/' . $image);
            unlink($image);
            $helps->delete();

            session()->flash('Deleted', 'section help is deleted please insert one helps section');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

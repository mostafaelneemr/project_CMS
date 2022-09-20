<?php

namespace App\Http\Controllers\backend\home;

use App\Http\Controllers\Controller;
use App\Models\backend\home\page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class pageController extends Controller
{
    public function index()
    {
        $pages = page::all();
        return view('admin.page.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'thumbnail' => 'image|mimes:jpeg,png,jpg',
                'title' => 'required|string|unique:pages,title,',
                'sub_title' => 'string',
                'details' => 'string',
            ],[
                'thumbnail.mimes' => 'image should be extension one of jpg , png or jpeg',
                'title.unique' => 'title is already exist',
                'title.string' => 'title should be string',
                'sub_title.string' => 'sub title should be string',
                'details.string' => 'details should bs string',
            ]);

            $filePath = "";
            if ($request->has('thumbnail')) {
                $filePath = uploadImage('page', $request->thumbnail);
            };
        
        page::create([
            'thumbnail' => $filePath,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'sub_title' => $request->sub_title,
            'details' => $request->details,
            'is_published' => $request->is_published,
        ]);

        session()->flash('Add', 'done added new link in home page');
        return redirect()->route('pages.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $pages = page::findOrFail($id);
        return view('admin.page.edit', compact('pages'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'thumbnail' => 'image|mimes:jpeg,png,jpg',
                'title' => 'required|exists:pages,title|string',
                'sub_title' => 'string',
                'details' => 'string',
            ],[
                'thumbnail.mimes' => 'image should be extension one of jpg , png or jpeg',
                'title.exists' => 'title is already exist',
                'title.string' => 'title should be string',
                'sub_title.string' => 'sub title should be string',
                'details.string' => 'details should bs string',
            ]);
            
            $pages = page::findOrFail($id);

            if ($request->has('thumbnail')) {
                $filePath = uploadImage('page', $request->thumbnail);
                page::where('id', $id)->update([ 'thumbnail' => $filePath ]);
            }

            $pages->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'details' => $request->details,
                'is_published' => $request->is_published,
            ]);

            session()->flash('edit', 'done editing link in home page');
            return redirect()->route('pages.index');
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
    
    public function destroy(Request $request)
    {
        try {
            $pages = page::findOrFail($request->page_id);
            $image = Str::after($pages->thumbnail, 'image/');
            $image = public_path('image/' . $image);
            unlink($image);
            $pages->delete();

            session()->flash('Deleted', 'deleted one link from home page , please create another link to home page');
            return redirect()->route('pages.index');
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

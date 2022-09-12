<?php

namespace App\Http\Controllers\backend\blog;

use App\Http\Controllers\Controller;
use App\Models\backend\blog\Blog;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Str;

class blogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.blog.create');
    }

    public function store(Request $request)
    {   
        try {

            $this->validate($request, [
                'thumbnail' => 'required|unique:blogs,thumbnail|max:50|string',
                'title' => 'required|unique:blogs,title|max:100|string',
                'description' => 'required|string',
                'day' => 'required|integer|min:1|max:31',
                'month' => 'required',
                'image_url' => 'image|mimes:jpeg,png,jpg',
            ],[
                'thumbnail.unique' => 'thumbnail is already exist',
                'thumbnail.max' => 'thumbnail must be 50 charecter',
                'thumbnail.string' => 'thumbnail should be string',
                'title.unique' => 'title is already exist',
                'title.max' => 'title must be 50 charecter',
                'description.string' => 'description should bs string',
                'day.min' => 'choose day between 1 - 30 days',
                'day.max' => 'choose day between 1 - 30 days',
                'image_url.mimes' => 'image should be extension one of jpg , png or jpeg',
            ]);

            $filePath = "";
            if ($request->has('image_url')) {
                $filePath = uploadImage('blog', $request->image_url);
            };

        Blog::create([
            'thumbnail' => $request->thumbnail,
            'title' => $request->title,
            'slug' => Str::slug($request->thumbnail),
            'description' => $request->description,
            'day' => $request->day,
            'month' => $request->month,
            'image_url' => $filePath,
        ]);

        session()->flash('Add', 'done added blog section');
        return redirect()->route('blog-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $blogs = Blog::findOrFail($id);
        return view('admin.blog.blog.edit', compact('blogs'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'thumbnail' => 'required|max:50|string|exists:blogs,thumbnail',
                'title' => 'required|exists:blogs,title|max:100|string',
                'description' => 'required|string',
                'day' => 'required|integer|min:1|max:31',
                'month' => 'required',
                'image_url' => 'image|mimes:jpeg,png,jpg',
            ],[
                'thumbnail.unique' => 'thumbnail is already exist',
                'thumbnail.max' => 'thumbnail must be 50 charecter',
                'thumbnail.string' => 'thumbnail should be string',
                'title.unique' => 'title is already exist',
                'title.max' => 'title must be 50 charecter',
                'description.string' => 'description should bs string',
                'day.digits_between' => 'choose day between 1 - 30 days',
                'image_url.mimes' => 'image should be extension one of jpg , png or jpeg',
            ]);

            $blogs = Blog::findOrFail($id);

            if ($request->has('image_url')) {
                $filePath = uploadImage('blog', $request->image_url);
                Blog::where('id', $id)->update(['image_url' => $filePath]);
            };

            $blogs->update([
                'thumbnail' => $request->thumbnail,
                'title' => $request->title,
                'slug' => Str::slug($request->thumbnail),
                'description' => $request->description,
                'day' => $request->day,
                'month' => $request->month,
            ]);

            session()->flash('edit', 'blog section done editing');
            return redirect()->route('blog-section.index');
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $blogs = Blog::findOrFail($request->blog_id);
            $image = Str::after($blogs->image_url, 'image/');
            $image = public_path('image/' . $image);
            unlink($image);
            $blogs->delete();
            
            session()->flash('Deleted', 'blog section is deleted please create again one blog section for blog page');
            return redirect()->back();
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

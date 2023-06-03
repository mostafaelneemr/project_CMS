<?php

namespace App\Http\Controllers\backend\service;

use App\Http\Controllers\Controller;
use App\Models\backend\home\gallery;
use App\Models\backend\service\logo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class logoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index','store']]);
         $this->middleware('permission:service-create', ['only' => ['create','store']]);
         $this->middleware('permission:service-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $logos = logo::all();
        return view('admin.service.logo.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.service.logo.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'brand' => 'required|string|max:100',
                'logo' => 'required_without:id|image|mimes:jpeg,png,jpg',
            ],
            [
                'brand.string' => 'title should be string',
                'logo.mimes' => 'image should be extension one of jpg , png or jpeg',
            ]);
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(240, 80)->save('image/logo/'.$name_gen);
            $filePath = 'image/logo/'.$name_gen;
            logo::create([ 'logo' => $filePath, 'brand' => $request->brand, 'is_published' => $request->is_published]);

            session()->flash('Add', 'logo is added');
            return redirect(route('logo-section.index'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $logos = logo::findOrFail($id);
        return view('admin.service.logo.edit', compact('logos'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'brand' => 'required|string|max:100',
                'logo' => 'required_without:id|image|mimes:jpeg,png,jpg',
            ],
            [
                'brand.string' => 'title should be string',
                'brand.required' => 'name of brand is required',
                'logo.mimes' => 'image should be extension one of jpg , png or jpeg',
            ]);

            $logos = logo::findOrFail($id);
            if ($request->has('logo')) {
                $filePath = uploadImage('website', $request->logo);
                gallery::where('id' , $id)->update([ 'logo' => $filePath, ]);
            }

            $logos->update([
                'brand' => $request->brand,
                'is_published' => $request->is_published,
            ]);

            session()->flash('edit', 'logo is editing');
            return redirect()->route('logo-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $logos = logo::findOrFail($request->logo_id);
            $image = Str::after($logos->logo, 'image/');
            $image = public_path('image/' . $image);
            unlink($image);
            $logos->delete();

            session()->flash('Deleted', 'logo is deleted');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Http\Requests\service\StoreServiceRequest;
use App\Http\Requests\service\UpdateServiceRequest;
use App\Http\Requests\slider\UpdateSliderRequest;
use App\Models\backend\service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class aboutServController extends Controller
{
    public function index()
    {
        $services = Service::where('serv_type', 'about')->get();
        return view('admin.about.service.index', compact('services'));
    }

    public function create()
    {
        return view('admin.about.service.create');
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            Service::create([
                'thumbnail' => $request->thumbnail,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'details' => $request->details,
                'serv_type' => 'about',
                'is_published' => $request->is_published,
            ]);

            session()->flash('Add', 'done add service section to about page');
            return redirect()->route('about-service.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return view('admin.about.service.edit', compact('services'));
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        try {
            $service = Service::findOrFail($id);

            $service->update([
                'thumbnail' => $request->thumbnail,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'details' => $request->details,
                'is_published' => $request->is_published,
            ]);

            session()->flash('edit', 'edit service section done');
            return redirect()->route('service-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Service::destroy($request->serv_id);

            session()->flash('Delated', 'done of deleted service from about page');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

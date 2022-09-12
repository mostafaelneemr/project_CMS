<?php

namespace App\Http\Controllers\backend\service;

use App\Http\Controllers\Controller;
use App\Http\Requests\service\StoreServiceRequest;
use App\Http\Requests\service\UpdateServiceRequest;
use App\Models\backend\service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class serviceController extends Controller
{
    public function index()
    {
        $services = Service::where('serv_type', 'home')->get();
        return view('admin.service.service.index', compact('services'));
    }

    public function create()
    {
        return view('admin.service.service.create');
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            Service::create([
                'thumbnail' => $request->thumbnail,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'details' => $request->details,
                'serv_type' => 'home',
                'is_published' => $request->is_published,
            ]);

            session()->flash('Add', 'done add service section');
            return redirect()->route('service-section.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return view('admin.service.service.edit', compact('services'));
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

            session()->flash('Delated', 'deleted one service section from service page');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

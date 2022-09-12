<?php

namespace App\Http\Controllers\backend\about;

use App\Http\Controllers\Controller;
use App\Models\backend\home\team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class teamController extends Controller
{
    public function index()
    {
        $teams = team::all();
        return view('admin.about.team.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.about.team.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'title' => 'required|string',
                'sub_title' => 'required|string',
            ]);

            $filePath = "";
            if($request->has('image')){
                $filePath = uploadImage('team', $request->image);
            };
            team::create([
                'image' => $filePath,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]);

            session()->flash('Add', 'done added one person to the team');
            return redirect()->route('about-team.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $teams = team::findOrFail($id);
        return view('admin.about.team.edit', compact('teams'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'image' => 'required|image|mimes:png,jpg,jpeg',
                'title' => 'required|string',
                'sub_title' => 'required|string',
            ]);

            $team = team::findOrFail($id);

            if (!$team) {
                return redirect()->route('dashboard');
            }

            if ($request->has('image')) {
                $filePath = uploadImage('team', $request->image);
                team::where('id', $id)->update([ 'image' => $filePath, ]);
            };
            
            $team->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
            ]);

            session()->flash('edit', 'one person of team done editing');
            return redirect()->route('about-team.index');


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $teams = team::findOrFail($request->team_id);
            $image = Str::after($teams->image, 'team/');
            $image = public_path('image/' . $image);
            unlink($image);
            $teams->delete();

            session()->flash('Deleted', 'done deleted one person from team, please create another one to complete team in about page');
            return redirect()->route('about-team.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}

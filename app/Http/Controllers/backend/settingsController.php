<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\setting;
use Illuminate\Http\Request;

class settingsController extends Controller
{

    public function index(){
        $settings = setting::all();
        return view('admin.settings.index', compact('settings'))->render();
    }

    public function update(Request $request){
        try {
            foreach ($request->all() as $name => $value) {
                if ($name != '_method' && $name != '_token') {
                    $setting = Setting::whereName($name)->first();
    
                    $setting->update([
                            'value' => $value,
                        ]);
                }
            }
    
            return redirect()->route('settings')->with('status', 'done updated');
        
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }

    }
}

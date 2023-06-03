<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\setting;
use Illuminate\Http\Request;

class settingsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:setting', ['only' => ['index','update']]);
    }

    public function index(){

        $settingGroups = Setting::select('group_name')->groupBy('group_name')->where('is_visible',1  )
            ->where('group_name','!=','staff_app')->get();
        
        $setting = [];
        foreach ($settingGroups as $key => $value) {
            $setting[] = Setting::where('group_name',$value->group_name)->where('is_visible',1)->orderBy('sort','ASC')->get();
        }

        $this->viewData['settingGroups'] = $settingGroups;
        $this->viewData['setting'] = $setting;

        return view('admin.settings.index',$this->viewData);
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

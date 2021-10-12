<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::find(1);
        return view('backend.config.index', compact('config'));
    }

    public function update(Request $request)
    {
        $config            = Config::find(1);
        $config->title     = $request->title;
        $config->active    = $request->active;
        $config->facebook  = $request->facebook;
        $config->twitter   = $request->twitter;
        $config->linkedin  = $request->linkedin;
        $config->youtube   = $request->youtube;
        $config->github    = $request->github;
        $config->instagram = $request->instagram;

        if($request->hasFile('logo')){
            $logo = Str::slug($request->title) . '-logo.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('configs_uploads'), $logo);
            $config->logo = 'configs_uploads/' . $logo;
        }

        if($request->hasFile('favicon')){
            $favicon = Str::slug($request->title) . '-favicon.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('configs_uploads'), $favicon);
            $config->favicon = 'configs_uploads/' . $favicon;
        }

        $config->save();
        toastr()->success('Site ayarları başarıyla güncellendi.');
        return redirect()->back();
    }

}

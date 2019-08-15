<?php

namespace App\Http\Controllers\admin;

use App\SetImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    public function setImage(Request $request)
    {
        $id = SetImages::where('belong', $request->belong)->first();
        if(isset($id)){
            $set = SetImages::findOrFail($id->id);
        }else{
            $set = new SetImages();
        }

        $set->width = $request->width;
        $set->height = $request->height;
        $set->width_thu = $request->width_thu;
        $set->height_thu = $request->height_thu;
        $set->belong = $request->belong;

        isset($id)? $set->update(): $set->save();

        return back();
    }

    public function getImage(Request $request)
    {
        $get = SetImages::where('belong', $request->belong)->first();

    }
}

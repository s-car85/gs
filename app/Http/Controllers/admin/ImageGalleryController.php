<?php

namespace App\Http\Controllers\admin;

use App\ImageGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ImageGalleryController extends Controller
{

    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $images = ImageGallery::where('belong',$id)->orderBy('sort', 'asc')->get();
        return view('admin.gallery',compact('images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        ]);
        $image = new ImageGallery();
        $sort = DB::table($image->getTable())->where('belong', $request->belong)->max('sort');
        $image->image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move($this->photos_path, $image->image);
        $image->title = isset($request->title)? $request->title: '';
        $image->sort = $sort+1;
        $image->belong = $request->belong;

        $image->save();

        return back()
            ->with('success','Image Uploaded successfully.');
    }


    /**
     * Remove Image function
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = ImageGallery::findOrFail($id);

        \File::delete($this->photos_path.'/'.$img->image);
        $img->delete();
        return back()
            ->with('success','Image removed successfully.');
    }


    public function sort()
    {
        $array = Input::all();
        foreach ($array['p'] as $key=>$val) {
            echo $val.' '.$key.'-';
            DB::update("UPDATE `image_gallery` SET sort = ".$key." WHERE  `id` = ".$val);
        }
    }
}

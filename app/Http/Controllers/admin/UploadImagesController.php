<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductImages;
use Illuminate\Support\Facades\File;
use Image;

class UploadImagesController extends Controller
{

    private $tmp_path;
    private $tmp_path_real;
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/upload');
        $this->tmp_path = public_path('tmp');
        $this->tmp_path_real = asset('tmp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request)
    {
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $name = rand ( 0, time() );
            $imgs = $name.'.'.$image->getClientOriginalExtension();

            if($image){
                $status = true;
                $img = $this->tmp_path_real.'/'.$imgs;
                $imagePro = new  \App\Helpers\Functions('App\Http\Controllers\admin\UploadImagesController@edit');
                $imageGetPro = $imagePro->imageGet();

                $width = Image::make($image)->width();
                if ($width > $imageGetPro->width) {
                    Image::make($image)->fit($imageGetPro->width, $imageGetPro->height)->save($this->tmp_path.'/'.$imgs, 100);
                }else {
                    Image::make($image)->save($this->tmp_path.'/'.$imgs, 100);
                }
            }else{
                $img = 'err';
                $status = false;
            }

            return json_encode(['img' => $img, 'status' => $status, 'name' => $imgs, 'id' => $name, 'oldId' => $request->id]);
        }
    }

    public function destroy($id)
    {
        $productImg = ProductImages::findOrfail($id);
        $img = $this->photos_path . '/' . $productImg->filename;
        File::delete($img);
        $productImg->delete();

        return json_encode(['status' => true]);
    }
}

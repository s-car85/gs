<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\UploadedFile;

class SlidersController extends Controller
{
    protected $slider, $page;

    public function __construct(Slider $slider, Page $page)
    {

        $this->page = $page;
        $this->slider = $slider;

        parent::__construct();
    }

    public function index()
    {
        $pages = $this->page->where('gallery', 1)->pluck('name', 'id')->toArray();

        return view('admin.sliders.index', compact('pages', $pages));
    }


    public function slidersData(Request $request)
    {

        if($request->ajax()) {

            $slider = $this->slider->where('photo_id', $request->get('photo_id'))->orderBy('order')->get();

            return DataTables::of($slider)
                ->addColumn('thumb', function ($slider) {
                    return view('admin.sliders.thumb', compact('slider'))->render();
                })
                ->addColumn('action0', function ($slider) {
                    return view('admin.sliders.action0', compact('slider'))->render();
                })
                ->addColumn('action1', function ($slider) {
                    return view('admin.sliders.action1', compact('slider'))->render();
                })
                ->addColumn('responsive', function ($slider) {
                    return view('admin.sliders.responsive', compact('slider'))->render();
                })
                ->editColumn('order', '<i class="fa fa-arrows-alt" aria-hidden="true"></i>')
                ->rawColumns(['order','thumb', 'action0', 'action1', 'responsive'])
                ->make(true);
        }
    }

    public function reorderData(Request $request)
    {
        $count = 0;

        if (count($request->json()->all())) {
            $ids = $request->json()->all();
            foreach($ids as $i => $key)
            {
                $id = $key['id'];
                $position = $key['position'];

                $slider = $this->slider->find($id);

                $slider->order = $position;
                if($slider->save())
                {
                    $count++;
                }
            }
            return response()->json(['statut' => 'ok']);
        }

    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        ]);

            $countOrder = $this->slider->where('photo_id', $request['photoId'])->count();

            $slider = $this->makeSlider($request['path']);

            $slider->photo_id = (int) $request['photoId'];
            $slider->title = $request['title'];
            $slider->description = $request['description'];
            $slider->order = $countOrder + 1;

            $slider->save();

         return redirect(route('sliders.index'));
    }
    public function updateSlider($slider, UploadedFile $file)
    {
        return $slider->saveAs($file->getClientOriginalName())
            ->move($file);
    }
    public function makeSlider(UploadedFile $file)
    {

        return Slider::named($file->getClientOriginalName())
                    ->move($file);
    }
    public function create(Slider $slider)
    {
        $pages = $this->page->where('gallery', 1)->pluck('name', 'id')->toArray();
        return view('admin.sliders.form', compact('slider', 'pages'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        ]);

        $slider = $this->slider->findOrFail($id);

        if($slider->path != 'sliders/photos/no-image.png'){
            if (\File::exists(public_path() . '/' . $slider->path)) {
                \File::delete(public_path() . '/' . $slider->path);
                \File::delete(public_path() . '/' . $slider->thumbnail_path);
            }
        }

        $countOrder = $slider->where('photo_id', $request['photoId'])->count();

        if($request['path'] !== null){
            $this->updateSlider($slider, $request['path']);
        }


        $slider->photo_id = (int) $request['photoId'];
        $slider->title = $request['title'];
        $slider->description = $request['description'];
        $slider->order = $countOrder + 1;

        $slider->update();

        return redirect(route('sliders.index'));
    }

    public function edit($id)
    {
        $pages = $this->page->where('gallery', 1)->pluck('name', 'id')->toArray();
        $slider = $this->slider->findOrFail($id);

       return view('admin.sliders.form', compact('slider', 'pages'));
    }


    public function destroySlider(Request $request)
    {
        if($request->ajax()) {

            $slider = $this->slider->findOrFail($request->get('id'));
             if($slider->path != 'sliders/photos/no-image.png'){
                if (\File::exists(public_path() . '/' . $slider->path)) {
                    \File::delete(public_path() . '/' . $slider->path);
                    \File::delete(public_path() . '/' . $slider->thumbnail_path);
                }
             }

            $slider->delete();
        }

        //flash()->overlay(trans('flash.success'),trans('flash.photos.pdeleted'));

        //return redirect(route('admin.photos.index'));
    }

    public function imageDelete(Request $request){

        if($request->ajax()){

             $slider = $this->slider->findOrFail($request->get('photo_id'));

              if (\File::exists(public_path().'/'. $slider->baseDir . $slider->path)) {
                  if($slider->path != 'sliders/photos/no-image.png'){
                    \File::delete(public_path().'/' .$slider->baseDir . $slider->path);
                    \File::delete(public_path().'/' .$slider->baseDir . $slider->thumbnail_path);
                     $slider->path =  'sliders/photos/no-image.png';
                     $slider->thumbnail_path = 'sliders/photos/tn-no-image.png';
                     $slider->save();
                  }
             }
             return response('{}', 200);
        }

    }


}

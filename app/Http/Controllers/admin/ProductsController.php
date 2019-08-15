<?php

namespace App\Http\Controllers\admin;


use App\ProductAddition;
use App\ProductImages;
use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CiCategories;
use Illuminate\Support\Facades\DB;
use Image;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    private $photos_path;
    private $tmp_path;
    private $image;
    private $imagePro;

    public function __construct(Request $request)
    {
        $this->photos_path = public_path('/upload');
        $this->tmp_path = public_path('/tmp');
        $this->image = new \App\Helpers\Functions($request->route()->getActionName());
        $this->imagePro = new \App\Helpers\Functions('App\Http\Controllers\admin\UploadImagesController@edit');
    }

    public function index(){

    }

    public function create()
    {

    }

    public function createProduct($id, Request $request)
    {
        $imageGet = $this->image->imageGet();
        $imageSet = $this->image->imageSet();
        $imageGetPro = $this->imagePro->imageGet();
        $imageSetPro = $this->imagePro->imageSet();
        $products = Product::where('category_id', $id)->get();
        $cat = CiCategories::findorfail($id)->first();
        $categories = CiCategories::where('belong', $cat->belong)->get();
        $select = [''];
        $ids = $id;
        foreach ($categories as $category) {
            $select[$category->id] = $category->name;
        }
        return view('admin.products', compact('ids', 'select', 'imageGet', 'imageSet', 'imageGetPro', 'imageSetPro', 'products'));
    }

    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'normal' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6024',
            'hover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6024',
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);

        $saveImg = array();

        $product = new Product();
        $sort = DB::table($product->getTable())->where('category_id', $request->category_id)->max('sort');
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->qua = $request->qua;
        $product->note = $request->note;
        $product->price = $request->price;
        $product->image = '';
        $product->old_price = $request->old_price;
        $product->sort = $sort + 1;
        $product->save();

        $id = $product->id;

        if(isset($id)){
            // image 1 normal & cart
            if (request()->hasFile('normal')){
                 $file = $validation['normal']; // get the validated file
                 $images['normal'] = $file;
            }
            /// image 2 hover
            if (request()->hasFile('hover')){
                $file = $validation['hover']; // get the validated file
                $images['hover'] = $file;
            }
            // product image save
            $saveImg = $this->productNHC(null, $images);
            Product::findOrFail($id)->update(['image' => $saveImg]);
            // product images
            if (!empty($request->images_obj)) {
                $images = json_decode($request->images_obj);
                $this->productImages($images, $id);
            }
            // product dynamic element
            if (!empty($request->dynamic_obj)) {
                $addions = json_decode($request->dynamic_obj);
                $this->productElement($addions, $id);
            }

            $this->emptyTmp();
            return back()->with('success', 'product successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = CiCategories::where('belong', $id)->get();
        return view('admin.products.index', compact('categories', 'id'));
    }

    public function productsData($id)
    {
        $cb = function ($query) use ($id) {
            $query->where('ci_categories.belong', '=', $id);
        };

        $products = Product::whereHas('category', $cb)->orderBy('sort')->get();

        return DataTables::of($products)
            ->addColumn('img', function ($products) {
                return view('admin.products.img', compact('products'))->render();
            })
            ->addColumn('action1', function ($products) {
                return view('admin.products.action1', compact('products'))->render();
            })
            ->addColumn('action0', function ($products) {
                return view('admin.products.action0', compact('products'))->render();
            })
            ->addColumn('action2', function ($products) {
                return view('admin.products.action2', compact('products'))->render();
            })
            ->editColumn('sort', '<i class="fa fa-arrows-alt" aria-hidden="true"></i>')
            ->rawColumns(['sort', 'img', 'action0', 'action1', 'action2'])
            ->make();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $select = [];
        $image = new \App\Helpers\Functions($request->route()->getActionName());
        $imagePro = new \App\Helpers\Functions('App\Http\Controllers\admin\UploadImagesController@edit');
        $imageGet = $image->imageGet();
        $imageSet = $image->imageSet();
        $imageGetPro = $imagePro->imageGet();
        $imageSetPro = $imagePro->imageSet();

        $product = Product::findOrFail($id);
        $categories = CiCategories::where('belong', $product->category->belong)->get();

        foreach ($categories as $category) {
            $select[$category->id] = $category->name;
        }
        return view('admin.products', compact('select', 'imageGet', 'imageSet', 'imageGetPro', 'imageSetPro', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required'
        ]);
        $product = Product::findOrFail($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->qua = $request->qua;
        $product->note = $request->note;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        // product images
        if (!empty($request->images_obj)) {
            $imagesObj = json_decode($request->images_obj);
            $this->productImages($imagesObj, $id);
        }
        // product dynamic element
        if (!empty($request->dynamic_obj)) {
            $addions = json_decode($request->dynamic_obj);
            $this->productElement($addions, $id);
        }

        if (request()->hasFile('normal')) {
            $validation = $this->validate($request, [
                'normal' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6024'
            ]);
            $file = $validation['normal']; // get the validated file
            $images['normal'] = $file;

            $saveImg = $this->productNHC($product->image, $images);
        }

        if (request()->hasFile('hover')){
            $validation = $this->validate($request, [
                'hover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6024'
            ]);
            $file = $validation['hover']; // get the validated file
            $images['hover'] = $file;

            $saveImg = $this->productNHC($product->image, $images);
        }

        $product->save();
        $this->emptyTmp();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (isset(json_decode($product->image)[0])) {
            foreach (json_decode($product->image)[0] as $key => $value) {
                $img = $this->photos_path . '/' . $value;

                File::delete($img);
            }
        }

        if (isset($product->productImages)) {
            foreach ($product->productImages as $image) {
                $img = $this->photos_path . '/' . $image->filename;

                File::delete($img);
            }
        }
        ProductAddition::where('product_id', $id)->delete();
        $product->delete();

        return response()->json(['success' => true], 200);
    }

    public function productNHC($arr = null, $files)
    {
        if ($files){
            $imageGet = $this->image->imageGet();
            $name = time();
            foreach ($files as $key => $file) {
                if ($key == 'normal'){
                    if ($arr != null) {
                        $img = json_decode($arr, true)[0];
                        $imgEx = explode('.', $img['normal']);
                        $name = $imgEx[0];
                        $extension = $imgEx[1];
                    }else {
                        $extension = $file->getClientOriginalExtension();
                    }

                    $normal = $name . '.' . $extension;
                    $cart = $name . '_cart.' . $extension;
                    $width = Image::make($file)->width();
                    if ($width > $imageGet->width) {
                        Image::make($file)->fit($imageGet->width, $imageGet->height, function($constraint){
                            $constraint->aspectRatio();
                        })->save($this->photos_path . '/' . $normal, 100);
                    }else {
                        Image::make($file)->save($this->photos_path . '/' . $normal, 100);
                    }
                    Image::make($file)->resize($imageGet->width_thu, $imageGet->height_thu)->save($this->photos_path . '/' . $cart, 100);
                    $saveImg['normal'] = $normal;
                    $saveImg['cart'] = $cart;
                }
                if ($key == 'hover') {
                    if ($arr != null) {
                        $img = json_decode($arr, true)[0];
                        $imgEx = explode('.', $img['normal']);
                        $name = $imgEx[0];
                        $extension = $imgEx[1];
                    }else {
                        $extension = $file->getClientOriginalExtension();
                    }
                    $hover = $name . '_.' . $extension;
                    $width = Image::make($file)->width();
                    if ($width > $imageGet->width) {
                        Image::make($file)->fit($imageGet->width, $imageGet->height, function($constraint){
                            $constraint->aspectRatio();
                        })->save($this->photos_path . '/' . $hover, 100);
                    }else {
                        Image::make($file)->save($this->photos_path . '/' . $hover, 100);
                    }
                    $saveImg['hover'] = $hover;
                }
            }
            return json_encode([$saveImg]);
        }
    }

    public function productImages($images, $id)
    {
        foreach ($images as $key => $image) {
            if (File::exists($this->tmp_path . '/' . $image->image, $this->photos_path . '/' . $image->image)) {
                File::move($this->tmp_path . '/' . $image->image, $this->photos_path . '/' . $image->image);
                $productImg = new ProductImages();
                $sortImg = DB::table($productImg->getTable())->where('product_id', $id)->max('sort');
                $productImg->product_id = $id;
                $productImg->filename = $image->image;
                $productImg->sort = $sortImg + 1;
                $productImg->save();
            }
        }
    }

    public function productElement($addions , $id)
    {
        foreach ($addions as $key => $addion) {
            $productAddition = new ProductAddition();
            $productAddition->name = $key;
            $productAddition->product_id = $id;
            $productAddition->save();
            $pa = $productAddition->id;
            foreach ($addion as $ad) {
                $productAdditionElm = new ProductAddition();
                $productAdditionElm->product_id = $id;
                $productAdditionElm->parent_id = $pa;
                $productAdditionElm->name = $ad->name;
                $productAdditionElm->value = $ad->value;
                $productAdditionElm->qua = $ad->qua;
                $productAdditionElm->save();
            }
        }
    }

    public function emptyTmp()
    {
        $files = File::allFiles($this->tmp_path);
        foreach ($files as $file) {
            File::delete($file);
        }
    }


    public function visible($id)
    {
       $product = Product::findOrfail($id);

       if ($product->visible == 0){
           $product->visible = 1;
       }else{
           $product->visible = 0;
       }

        $product->update();

        return response()->json(['success' => true], 200);
    }

    public function reorderData(Request $request)
    {
        $count = 0;

        if (count($request->json()->all())) {
            $ids = $request->json()->all();
            foreach($ids as $i => $key)
            {
                $id = $key['id'];
                $sort = $key['sort'];

                $product = Product::findOrFail($id);

                $product->sort = $sort;
                if($product->update())
                {
                    $count++;
                }
            }
            return response()->json(['statut' => 'ok']);
        }
    }
}

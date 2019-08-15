<?php

namespace App\Http\Controllers;

use App\CiCategories;
use App\ImageGallery;
use App\Mail\QuestionEmail;
use App\ProductAddition;
use App\Product;
use App\Slider;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;

class PageController extends Controller
{
      //protected   $adminMail = ['info@gradskisifonjer.rs', 'tijana@gradskisifonjer.rs'];
    //protected  $adminMail = ['carevic455@gmail.com', 'slavko1985@gmail.com'];

    public function index()
    {
        $galleries = ImageGallery::where('belong', 1)->orderBy('sort', 'asc')->take(8)->get();

        return view('pages.index', compact('galleries'));
    }

    public function spm()
    {
        $galleries = ImageGallery::where('belong', 2)->orderBy('sort', 'asc')->take(8)->get();

        return view('pages.sivenje', compact('galleries'));
    }
    public function storeIndex($name = '', $id = null, Request $request)
    {
        if($request->segment(1) == 'gs-kutija'){
            $belong = 1;
            $view = 'pages.upoznaj-stilistu1';
            $sliders = Slider::where('photo_id', 1)->orderBy('order')->get();
        }
        if($request->segment(1) == 'prodavnica'){
            $belong = 2;
            $view = 'store.products1';
            $sliders = Slider::where('photo_id', 2)->orderBy('order')->get();
        }

        $categories = CiCategories::where('belong', $belong)->where('visible', 1)->orderBy('sort', 'asc')->with('products')->get();

        return view($view, compact('categories', 'sliders'));
    }

    public function store($name = '', $id = null, Request $request)
    {
        if($request->segment(1) == 'gs-kutija'){
            $belong = 1;
            $view = 'pages.upoznaj-stilistu';
        }
        if($request->segment(1) == 'prodavnica'){
            $belong = 2;
            $view = 'store.products';
        }

        $categories = CiCategories::where('belong', $belong)->where('visible', 1)->orderBy('sort', 'asc')->with('products')->get();
        $products = Product::where('category_id', $id)->where('visible', 1)->orderBy('sort')->paginate(6);

        $catIds = $categories->pluck('id')->toArray();

        if($products->count() == 0 && $id == null){
//            $products = Product::whereIn('category_id', $catIds)->latest()->paginate(6);
        }

        return view($view, compact('categories', 'products'));
    }

    public function product($name = '', $id = 0)
    {
        $product = Product::findOrFail($id);
        $previous = Product::where('id', '<', $product->id)->orderBy('id','desc')->first();
        $next = Product::where('id', '>', $product->id)->orderBy('id')->first();

        return view('store.product', compact('product', 'previous', 'next'));
    }

    public function searchByTermPaginated(Request $input, $perPage = 8)
    {
        $term     = $input->get('q');
        $products = null;
        $search_terms = explode('+', $term);

        $products = Product::where(function ($q) use ($search_terms) {
            foreach ($search_terms as $keyword) {
                if ($keyword != '') {
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                }
            }
        })->with('productAddition')->latest()
            ->paginate($perPage);

       return view('pages.search', compact('products', 'term'));

    }

    public function addCart(Request $request, $id)
    {
        $arr = array();
        foreach ($request->request as $key=>$value){
            if ($key == "_token" || $key == "qty") continue;
            $arr[$key] = $value;
        }
        $product = Product::findOrFail($id);
        $arr['images'] = $product->image;
        $arr['product_id'] = $product->id;

        Cart::add($product->id.time(), $product->name, $product->price, $request->qty, $arr);

        flash()->success('Proizvod je dodat u korpu','');

        return redirect()->back();

    }

    public function showCart()
    {
        return view('store.cart');
    }

    public function tnx()
    {
        return view('store.tnx2');
    }
    public function tnxUplatnica()
    {
        return view('store.tnx');
    }

    public function removeCart($id)
    {
        Cart::remove($id);

        flash()->info('Proizvod je obrisan iz korpe','');

        return back()->with('success','Proizvod je dodat u korpu');
    }

    public function checkout()
    {
        if(Cart::getTotal() > 0){
            return view('store.checkout');
        }
        return redirect()->to('/');
    }

    public function sendQuestion(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'lastname' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        Mail::to(config('mail.adminmail'))->send(new QuestionEmail($request));

        if(Mail::failures()) {
            // return response showing failed emails

            return redirect()->back();
        }

        flash()->success('Poruka uspešno poslata','');

        return redirect(url('hvala-na-pitanju'));
    }


}

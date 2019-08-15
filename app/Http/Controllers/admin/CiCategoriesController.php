<?php

namespace App\Http\Controllers\admin;

use App\CiCategories;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CiCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $category = new CiCategories();
        $sort = DB::table($category->getTable())->where('parent_id', $request->parent_id)->where('belong', $request->belong)->max('sort');
        $depth = ($request->parent_id == 0)? 1: 2;
        $category->belong = $request->belong;
        $category->parent_id = $request->parent_id;
        $category->depth = $depth;
        $category->sort = $sort+1;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return back()
            ->with('success','Save Category successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = CiCategories::where('belong', $id)->orderBy('sort', 'asc')->get();
        $categories = CiCategories::where('belong', $id)->where('parent_id', 0)->get();
        $data = CiCategories::buildTree($res);
        $b['belong'] = $id;

        return view('admin.categories', compact('data', 'b', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = CiCategories::findOrfail($id);
        $categories = CiCategories::where('belong', $category->belong)->where('parent_id', 0)->get();

        return view('admin.categories_edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = CiCategories::findOrfail($id);
        if (isset($request->parent_id))
            $category->parent_id = $request->parent_id;

        $category->name = $request->name;
        $category->description = $request->description;

        $category->update();

        return redirect()->to('ci-admin/categories/'.$category->belong)->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = CiCategories::findOrfail($id);

       if ($category->parent_id > 0){
           $category->delete();
           $product = Product::where('category_id', $id);
           $product->category_id = 0;
           $product->update();
       }else{
           $category->delete();
           CiCategories::where('parent_id', $id)->delete();
       }

       return back()->with('success','Category removed successfully.');
    }
    public function visible($id)
    {
       $category = CiCategories::findOrfail($id);

       if ($category->visible == 0){
           $category->visible = 1;
       }else{
           $category->visible = 0;
       }

        $category->update();

       return back()->with('success','Category set visible ');
    }

    public function sort()
    {
        $array = Input::all();
        foreach ($array['p'] as $key=>$val) {
            echo $val.' '.$key.'-';
            DB::update("UPDATE `ci_categories` SET sort = ".$key." WHERE  `id` = ".$val);
        }
        return response('{"success" : true }', 200);
    }
}

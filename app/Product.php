<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['category_id', 'name', 'que', 'note', 'price', 'old_price', 'image', 'sort'];


    public function getCategory()
    {
        return $this->hasMany('App\CiCategories');
    }

    public function category()
    {
        return $this->belongsTo('App\CiCategories');
    }


    public function productImages()
    {
        return $this->hasMany('App\ProductImages', 'product_id')->orderBy('sort', 'asc');
    }

    public function productAddition()
    {
        return $this->hasMany('App\ProductAddition', 'product_id')->where('parent_id', 0)->with('children');
    }

}

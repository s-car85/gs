<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAddition extends Model
{
    protected $table = 'product_additions';

    protected $fillable = ['product_id', 'parent_id', 'name', 'value', 'qua'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function productAddition()
    {
        return $this->belongsToMany('App\Product');
    }

    public function parent()
    {
        return $this->belongsToOne('App\ProductAddition', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\ProductAddition', 'parent_id');
    }
}

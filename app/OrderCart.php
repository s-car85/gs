<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['order_id', 'product_id', 'name', 'price', 'qty', 'addition'];
}

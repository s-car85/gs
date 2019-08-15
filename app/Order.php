<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['user_id', 'name', 'surname', 'street', 'place', 'zip', 'phone', 'amount', 'note', 'type', 'status'];

    public function cart()
    {
        return $this->hasMany('App\OrderCart', 'order_id');
    }

}

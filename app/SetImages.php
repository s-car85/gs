<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetImages extends Model
{

    protected $table = 'set_images';

    protected $fillable = ['belong', 'width', 'height', 'width_thu', 'height_thu'];
}

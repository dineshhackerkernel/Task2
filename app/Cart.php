<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table="carts";
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'product_id', 'quantity','price'
    ];
}

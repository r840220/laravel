<?php

namespace shopping_mall\Models;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'order_detail';
    public $timestamps = false;
    public $fillable = ['order_id', 'product_id', 'price', 'qty' ];

}

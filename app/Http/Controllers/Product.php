<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;

use shopping_mall\Http\Requests;

use shopping_mall\Models;

class Product extends Controller
{
    public function getIndex(){
        $product = Models\Product::all();
        return view('shop/index');

    }

}

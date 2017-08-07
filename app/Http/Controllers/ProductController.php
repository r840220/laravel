<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;
use shopping_mall\Http\Requests;
use shopping_mall\Models\Product;
use shopping_mall\Models\User;
use shopping_mall\Library\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $data = null;
    private $product_model;

    public function __construct(){
        $this->product_model = new Product();
    }

    public function getIndex(){
        $this->data['product'] =  $this->product_model->take(9)->get();
        return view('shop/index', $this->data);

    }

    public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        $oldcart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->add($product, $request->input('qty'));
        $request->session()->put('cart', $cart);
        return json_encode($cart);
    }

    public function getDeleteToCart(Request $request, $id){
        $oldcart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->delete($id);
        $request->session()->put('cart', $cart);
    }

    public function getPage(Request $request, $type){
        $this->data['product'] = $this->product_model->where('type', '=', $type)->take(9)->get();
        return view('shop/index', $this->data);
    }

    public function postSearch(Request $request){

    }

    public function test_cart_add(Request $request){
       /*$user = User::first();
       print_r($user);*/
       $request->session()->forget('cart');


    }



}

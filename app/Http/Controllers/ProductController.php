<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;
use shopping_mall\Http\Requests;
use shopping_mall\Models\Product;
use shopping_mall\Models\Product_model;
use shopping_mall\Models\User;
use shopping_mall\Library\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $data = null;
    private $product_model;

    public function __construct(){
        $this->product_model = new Product_model();
    }


    public function postCart(Request $request){
        $product = Product::find($request->input('id'));
        $oldcart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->add($product, $request->input('qty'));
        $request->session()->put('cart', $cart);
        return json_encode($cart);
    }

    public function deleteCart(Request $request){
        if($id = $request->input('id')){
            $oldcart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
            $cart = new Cart($oldcart);
            $cart->delete($id);
            $request->session()->put('cart', $cart);
        }else{
            $request->session()->forget('cart');
        }

    }

    public function putCart(Request $request){
        $id = $request->input('id');
        $number = $request->input('number');
        $cart = new Cart($oldcart);
        $cart->put($id, $number);
        $request->session()->put('cart', $cart);
        return route('sale.index');
    }

    public function getPage(Request $request){

        $count = $request->input('page') ? $request->input('page') * 9 : 0;
        $this->data['condition'] = '';
        if($type = $request->input('type')){
            $this->data['condition'] = 'type=' . $type;
        };

        if($search = $request->input('search')){
            $this->data['condition'] = $this->data['condition'] . '&search=' . $search;
        }
        $this->data['page'] = $count/9;
        $this->data['total'] = $this->product_model->getNumber($type, $search);
        $this->data['product'] = $this->product_model->getPage($type, $search, $count);
        return view('shop/index', $this->data);
    }


    public function test_cart_add(Request $request){
        $count = $request->input('page') ? $request->input('page') * 9 : 0;
        $this->data['condition'] = '';
        if($type = $request->input('type')){
            $this->data['condition'] = 'type=' . $type;
            $this->product_model = $this->product_model->where('type', '=', $type);
        };

        if($search = $request->input('search')){
            $this->product_model = $this->product_model->where('title', 'like', '%' .$search. '%');
            $this->data['condition'] = $this->data['condition'] . '&' . $search;
        }

        $product_model = new Product_model();
        echo $product_model->getNumber($type, $search, $count);


    }



}

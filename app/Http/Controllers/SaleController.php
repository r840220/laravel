<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;
use shopping_mall\Http\Requests;
use shopping_mall\Models\Sale;



class SaleController extends Controller
{
    protected $sale_model;

    public function __construct(){
        $this->sale_model = new Sale();
    }

    public function index(Request $request){
        if($request->session()->has('cart')){
            return view('sale/sale_index');
        }else{
            return redirect()->route('ProductController.index');
        }
    }

    public function create_order(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'phone' =>'required'
        ],[
            'name.required' => '姓名為必填欄位',
            'email.required' => '信箱為必填欄位',
            'email.email' => '信箱格式不符',
            'address.required' => '地址為必填欄位',
            'phone.required' => '電話為必填欄位',
        ]);

        $success = $this->sale_model->create_order([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'phone' =>$request->input('phone'),
            'address' => $request->input('address')
        ]);

        if($success){
            $this->create_pdf();
        }

    }

    protected function create_pdf(){
        echo 'pdf';
    }
}

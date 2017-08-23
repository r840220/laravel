<?php

namespace shopping_mall\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use shopping_mall\Http\Requests;
use shopping_mall\Models\Sale;
use shopping_mall\Models\Order_detail;
use DB;
use shopping_mall\Models\Sale_model;
use Vsmoraes\Pdf\Pdf;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    protected $sale_model,$order_detail;

    public function __construct(){
        $this->sale_model = new Sale_model();

    }

    public function index(Request $request){
        if($request->session()->has('cart')){
            return view('sale/sale_index');
        }else{
            return redirect()->route('ProductController.getPage');
        }
    }

    public function create_order(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'phone' =>'required'
        ]);

        $consumer = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'user_id' => Auth::user()->id
        );

        $items = $request->session()->get('cart')->items;
        $this->sale_model->create_order($consumer, $items);











        $request->session()->forget('cart');
        return redirect(route('ProductController.getPage'))->with('messages', '感謝您的購買');
    }

    public function getOrder(Request $request){
        //header("Content-Type:text/html; charset=utf-8");
        $data = $this->sale_model->getOrder(Auth::user()->id);

        return view('sale/order')->with($data);
    }

    public function postOrder(Request $request){
        $this->validate($request, [
            'type' => 'required',
            'value' => 'required'
        ]);

        $this->user_model->change('order', $request->input('type'), $request->input('value'));

        return route('user.getOrder');
    }

    public function create_pdf(Pdf $pdf){
        $body = view('pdf/sale');
        return $pdf->load($body)->show();
    }
}

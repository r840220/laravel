<?php

namespace shopping_mall\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use shopping_mall\Http\Requests;
use shopping_mall\Models\Sale;
use shopping_mall\Models\Order_detail;
use DB;
use Vsmoraes\Pdf\Pdf;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    protected $sale_model,$order_detail;

    public function __construct(){
        $this->sale_model = new Sale();
        $this->order_detail = new Order_detail();
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
        ]);
        $items = $request->session()->get('cart')->items;
        $item_list = array();
        DB::beginTransaction();
        try{
            $this->sale_model->name = $request->input('name');
            $this->sale_model->email = $request->input('email');
            $this->sale_model->phone = $request->input('phone');
            $this->sale_model->address = $request->input('address');
            $this->sale_model->user_id = Auth::user()->id;
            $this->sale_model->save();
            foreach($items as $key => $item){
                $data = array(
                    'order_id' => $this->sale_model->id,
                    'product_id' => $key,
                    'price' => $item['price'],
                    //'discount' => $item[''],
                    'qty' => $item['qty']
                );
                array_push($item_list, $data);
            }
            DB::table('order_detail')->insert($item_list);
        }catch (ValidationException $e){
            DB::rollback();
        }
        DB::commit();
        $request->session()->forget('cart');
        return redirect(route('ProductController.index'))->with('messages', '感謝您的購買');
    }

    public function create_pdf(Pdf $pdf){
        $body = view('pdf/sale');
        return $pdf->load($body)->show();
    }
}

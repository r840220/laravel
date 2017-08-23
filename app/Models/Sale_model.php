<?php
namespace shopping_mall\Models;

use shopping_mall\Models\Sale;
use shopping_mall\Models\Order_detail;
use DB;
use Dotenv\Exception\ValidationException;

class Sale_model{

    public function __construct(){
        $this->order_detail = new Order_detail();

    }

    public function create_order($consumer, $items){
        DB::beginTransaction();
        try{
            $sale = new Sale($consumer);
            $sale->save();

            foreach($items as $key => $item){
                $data = array(
                    'order_id' => $sale->id,
                    'product_id' => $key,
                    'price' => $item['price'],
                    //'discount' => $item[''],
                    'qty' => $item['qty']
                );
                new Order_detail($data);
            }
        }catch (ValidationException $e){
            DB::rollback();
        }
        DB::commit();
    }

    public function getOrder($id){
        $data['user_order'] = DB::select('select * from orders where user_id = ?', [$id]);
        $data['order_detail'] = DB::select('select * from order_detail where order_id = any (select id from orders where user_id = ?)', [$id]);
        return $data;
    }

    public function post_order(){

    }

    public function modify_state($order_id, $type, $value){

    }
}
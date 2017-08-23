<?php

namespace shopping_mall\Models;

use shopping_mall\Models\Product;

class Product_model {

    public function __construct(){
        $this->product = new Product();
    }

    public function Page($type, $search, $count = 0){
        if($type){
            $this->product = $this->product->where('type', '=', $type);
        };

        if($search){
            $this->product = $this->product->where('title', 'like', '%' .$search. '%');
        }

        $this->product = $this->product->offset($count)->limit(9);

    }

    public function getNumber($type, $search){
        $this->Page($type, $search);
        return $this->product->count();
    }

    public function getPage($type, $search, $count){
        $this->Page($type, $search, $count);
        return $this->product->get();
    }
}
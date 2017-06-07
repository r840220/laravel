<?php

namespace shopping_mall\Library;

class Cart {

    public $items = null;
    public $total_Qty = 0;
    public $total_Price = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->total_Qty = $oldCart->total_Qty;
            $this->total_Price = $oldCart->total_Price;
        }
    }

    public function add($item, $qty = 1){
        $stored_Item = ['item' => $this->toArray($item), 'qty' => 0, 'price' => $item->price];
        if($this->items){
            if(array_key_exists($item->id, $this->items)){
                $stored_Item = $this->items[$item->id];
            }
        }

        $stored_Item['qty'] += $qty;
        $this->items[$item->id] = $stored_Item;
        $this->total_Price += $stored_Item['price'] * $qty;
        $this->total_Qty += $qty;
    }

    public function delete($id){
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $this->total_Qty -= $this->items[$id]['qty'];
                $this->total_Price -= $this->items[$id]['qty'] * $this->items[$id]['price'];
                unset($this->items[$id]);
            }
        }
    }

    public function toArray($item){
        return [
           'title' => $item->title,
           'imagePath' => $item->imagePath,
           'type' => $item->type,
           'onsale' => $item->onsale,
           'unit_price' => $item->price,
           //'bargain_price' => $item->bargain_price;
        ];
    }


    public function test($item){
        echo 'cart:' . $item->id;
    }
}
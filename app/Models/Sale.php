<?php

namespace shopping_mall\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'total_qty', 'total_price'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function create_order($item){
        print_r($item);

        return true;
    }
}

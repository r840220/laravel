<?php

namespace shopping_mall\Models;

use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use shopping_mall\Models\Order_detail;



class Sale extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'orders';
    protected $fillable = ['user_id', 'name', 'email', 'phone', 'address'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }


    public function order_detail(){
        return $this->hasMany(Order_detail::class, 'order_id');
    }




}

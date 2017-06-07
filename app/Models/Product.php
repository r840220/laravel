<?php

namespace shopping_mall\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = ['imagePath', 'title', 'description', 'price'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

}

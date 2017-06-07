<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //更改商品表格
        Schema::table('products', function (Blueprint $table){
            $table->string('type');
            $table->integer('qty');
            $table->boolean('onsale');
            $table->softDeletes();
        });

        //新增訂單表格
        Schema::create('orders', function(Blueprint $table){
           $table->increments('id');
           $table->timestamps();
           $table->string('user_id');
           $table->foreign('user_id')->references('id')->on('users');
           $table->string('remarks');
           $table->softDeletes();
        });

        //新增訂單明細
        Schema::create('order_detail', function(Blueprint $table){
           $table->string('order_id');
           $table->string('product_id');
           $table->integer('price');
           $table->float('discount');
           $table->integer('qty');
        });

        //新增會員留言
        Schema::create('messages', function(Blueprint $table){
           $table->increments('id');
           $table->string('user_id');
           $table->timestamps();
           $table->text('message');
           $table->string('order');
        });

        //新增商品類型
        Schema::create('product_types', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('parent');
            $table->integer('level');
            $table->string('name');

        });

        Schema::table('orders', function(Blueprint $table){
            $table->unsignedInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('order_detail', function(Blueprint $table){
            $table->unsignedInteger('order_id')->change();
            $table->unsignedInteger('product_id')->change();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('messages', function(Blueprint $table){
            $table->unsignedInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

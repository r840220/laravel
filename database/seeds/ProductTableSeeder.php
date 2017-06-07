<?php

use Illuminate\Database\Seeder;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \shopping_mall\Models\Product([
            'imagePath' => '...',
            'title' => 'Joanda_Ma',
            'description' => '超級',
            'price' => '999'
        ]);
        $product->save();

    }
}

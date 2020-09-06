<?php

use Illuminate\Database\Seeder;

class SeederActivity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = get_object_vars(DB::table('product')->first());
        DB::table('activity')->insert([
            'product_id' => $product['id'],
            'name' => $product['name'],
            'price' => 100,
            'origin_price' => $product['price'],
            'start_time' => time(),
            'end_time' => time() + 3600 * 24,
            'amount' => 1000,
            'stock' => 1000,
            'rate' => 10,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }
}

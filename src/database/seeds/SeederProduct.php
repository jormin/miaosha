<?php

use Illuminate\Database\Seeder;

class SeederProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'price' => 9900,
            'name' => '【vivo官方原装】nex闪充充电器头快充数据线x23x27z3z5x21x20x9IQOO neo 10V-2.25A闪充头+Type-C数据线',
            'cover' => 'https://img20.360buyimg.com/mobilecms/s700x700_jfs/t1/53857/17/8744/37453/5d623c06Eeef0cbe3/ec243fd152dbf719.jpg!q70.jpg',
            'pics' => json_encode([
                'https://img20.360buyimg.com/mobilecms/s700x700_jfs/t1/53857/17/8744/37453/5d623c06Eeef0cbe3/ec243fd152dbf719.jpg!q70.jpg',
                'https://img20.360buyimg.com/mobilecms/s700x700_jfs/t1/53857/17/8744/37453/5d623c06Eeef0cbe3/ec243fd152dbf719.jpg!q70.jpg',
                'https://img20.360buyimg.com/mobilecms/s700x700_jfs/t1/53857/17/8744/37453/5d623c06Eeef0cbe3/ec243fd152dbf719.jpg!q70.jpg',
                'https://img20.360buyimg.com/mobilecms/s700x700_jfs/t1/53857/17/8744/37453/5d623c06Eeef0cbe3/ec243fd152dbf719.jpg!q70.jpg'
            ]),
            'sale' => 0,
            'stock' => 1000,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }
}

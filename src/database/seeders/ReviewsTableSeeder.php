<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id'=>1,
            'shop_id'=>1,
            'review'=>1,
            'comment'=>'店舗が汚かったです',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>1,
            'shop_id'=>5,
            'review'=>3,
            'comment'=>'おいしかったです',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>2,
            'shop_id'=>2,
            'review'=>2,
            'comment'=>'混んでたので時間がかかった',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>3,
            'shop_id'=>10,
            'review'=>5,
            'comment'=>'料理がおいしく、サービスも良かった',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>3,
            'shop_id'=>19,
            'review'=>4,
            'comment'=>'最高',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>9,
            'shop_id'=>7,
            'review'=>3,
            'comment'=>'可もなく不可もなし',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>10,
            'shop_id'=>15,
            'review'=>5,
            'comment'=>'リピートします',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>3,
            'shop_id'=>12,
            'review'=>1,
            'comment'=>'料理の提供が遅かった',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>1,
            'shop_id'=>11,
            'review'=>2,
            'comment'=>'普通',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>14,
            'shop_id'=>1,
            'review'=>2,
            'comment'=>'料理が冷めてた',
        ];
        DB::table('reviews')->insert($param);

        $param = [
            'user_id'=>7,
            'shop_id'=>7,
            'review'=>5,
            'comment'=>'価格が安く量が多かった',
        ];
        DB::table('reviews')->insert($param);

    }
}

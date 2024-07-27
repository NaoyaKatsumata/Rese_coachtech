<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthoritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'authority'=>'administrator'
        ];
        DB::table('authorities')->insert($param);

        $param = [
            'authority'=>'owner'
        ];
        DB::table('authorities')->insert($param);

        $param = [
            'authority'=>'user'
        ];
        DB::table('authorities')->insert($param);
    }
}

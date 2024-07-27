<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'name' => 'administrator',
            'email' => 'administrator@gmail.com',
            'password'=>'$2y$10$5UUw/P7yr1L9dlPm2TqgJOxKANVPcD5ETy.f3E1GM/2lFLQqCVgD2',
            'authority'=>'1',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password'=>'$2y$10$5UUw/P7yr1L9dlPm2TqgJOxKANVPcD5ETy.f3E1GM/2lFLQqCVgD2',
            'authority'=>'2',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password'=>'$2y$10$5UUw/P7yr1L9dlPm2TqgJOxKANVPcD5ETy.f3E1GM/2lFLQqCVgD2',
            'authority'=>'3',
        ]);

        $this->call(ShopsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(AuthoritiesTableSeeder::class);
    }
}

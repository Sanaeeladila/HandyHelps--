<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' =>'Jane', 'email' => 'Jane@gmail.com', 'password' => Hash::make('123'), 'type' => '3'],
            ['name' =>'Jane', 'email' => 'John@gmail.com', 'password' => Hash::make('123'), 'type' => '1'],
            ['name' =>'Jane', 'email' => 'Smith@gmail.com', 'password' => Hash::make('123'), 'type' => '1'],
            ['name' =>'Jane', 'email' => 'Erwin@gmail.com', 'password' => Hash::make('123'), 'type' => '2'],
            ['name' =>'Jane', 'email' => 'Eve@gmail.com', 'password' => Hash::make('123'), 'type' => '2'],
        ]);
    }
}

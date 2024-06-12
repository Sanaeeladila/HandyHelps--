<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['titre' => 'Pet Care', 'description' => 'Soins et gardiennage des animaux domestiques.'],
            ['titre' => 'Bricolage', 'description' => 'Petits travaux et réparations à domicile.'],
            ['titre' => 'Gardening', 'description' => 'Entretien et aménagement des jardins.']
        ]);
    }
}


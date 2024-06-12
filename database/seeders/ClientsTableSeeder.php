<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            ['nom' => 'Doe', 'prenom' => 'John', 'telephone' => '1234567890', 'adresse' => '1234 Elm Street', 'id_user' => 2],
            ['nom' => 'Smith', 'prenom' => 'Jane', 'telephone' => '0987654321', 'adresse' => '5678 Oak Street', 'id_user' => 3]
        ]);
    }
}

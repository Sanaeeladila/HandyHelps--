<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentairesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('commentaires')->insert([
            [
                'client_id' => 3, // Assurez-vous que l'ID existe dans la table `clients`
                'partenaire_id' => 2, // Assurez-vous que l'ID existe dans la table `partenaires`
                'description' => 'Excellent travail, très professionnel!',
                'note' => 5,
                'date' => now(),
                'type' => 'positive',
                'visibilite' => 'public'
            ],
            [
                'client_id' => 4,
                'partenaire_id' => 1,
                'description' => 'Service rapide, mais pourrait être plus soigné.',
                'note' => 3,
                'date' => now(),
                'type' => 'critique',
                'visibilite' => 'public'
            ]
        ]);
    }
}

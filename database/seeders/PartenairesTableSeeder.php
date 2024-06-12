<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartenairesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('partenaires')->insert([
            [
                'nom' => 'Johnson',
                'prenom' => 'Alice',
                'metier' => 'Plombier',
                'ville' => 'Springfield',
                'annees_exp' => 5,
                'disponibilite' => 1,
                'prix_intervention' => 50.0,
                'moy_evaluation' => 4,
                'num_telephone' => '0123456789',
                'adresse' => '123 Main Street',
                'profil_picture' => 'img/alice.jpg',
                'description' => 'Expert en plomberie résidentielle.',
                'cin' => 'ABC123',
                'availability_start' => '2023-09-23 10:30', // Formaté selon vos besoins
                'availability_end' => '2024-02-23 15:45',    // Formaté selon vos besoins
                'id_user' => 4
            ],
            [
                'nom' => 'Brown',
                'prenom' => 'Bob',
                'metier' => 'Jardinier',
                'ville' => 'Shelbyville',
                'annees_exp' => 3,
                'disponibilite' => 1,
                'prix_intervention' => 30.0,
                'moy_evaluation' => 5,
                'num_telephone' => '0987654321',
                'adresse' => '456 Elm Street',
                'profil_picture' => 'img/bob.jpg',
                'description' => 'Spécialiste en aménagement paysager.',
                'cin' => 'XYZ789',
                'availability_start' => '2023-10-15 09:00', // Formaté selon vos besoins
                'availability_end' => '2024-03-15 18:00',     // Formaté selon vos besoins
                'id_user' => 5

            ]
        ]);
    }
}

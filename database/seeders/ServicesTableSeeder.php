<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'client_id' => 3,  // Assurez-vous que cet ID existe dans `clients`
                'partenaire_id' => 2,  // Assurez-vous que cet ID existe dans `partenaires`
                'categorie_id' => 1,  // Correspond à 'Pet Care'
                'titre' => 'Installation de plomberie',
                'description' => 'Installation complète de plomberie dans la nouvelle maison',
                'date_demande' => now(),
                'date_debut' => now()->addDays(2),
                'duree' => '3 jours',
                'statut' => 'en cours'
            ],
            [
                'client_id' => 4,  // Assurez-vous que cet ID existe dans `clients`
                'partenaire_id' => 1,  // Assurez-vous que cet ID existe dans `partenaires`
                'categorie_id' => 2,  // Correspond à 'Bricolage'
                'titre' => 'Réparation électrique',
                'description' => 'Réparation des câbles électriques endommagés',
                'date_demande' => now(),
                'date_debut' => now()->addDays(1),
                'duree' => '5 heures',
                'statut' => 'planifié'
            ]
        ]);
    }
}


<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un utilisateur de test
        //User::factory()->create([
           // 'name' => 'Test User',
           // 'email' => 'test@example.com',
       // ]);

        // Appel aux différents seeders pour les données initiales
        $this->call([
            CategoriesTableSeeder::class,
            ClientsTableSeeder::class,
            PartenairesTableSeeder::class,
            CommentairesTableSeeder::class,
            ServicesTableSeeder::class,
            UsersSeeder::class,
        ]);
    }
}

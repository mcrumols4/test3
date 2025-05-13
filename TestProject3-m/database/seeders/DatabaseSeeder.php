<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Category;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = [
            "Vehicles",
            "Immobiliària",
            "Feina",
            "Tecnologia",
            "Moda i complements",
            "Llar i jardí",
            "Esports i oci",
            "Mascotes",
            "Serveis",
            "Altres"
        ];

        foreach ($categories as $category) {
            Category::factory()->create([
                'name' => $category
            ]);
        }

        Advertisement::factory(50)->create();
    }
}

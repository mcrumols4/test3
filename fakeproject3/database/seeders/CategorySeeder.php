<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}

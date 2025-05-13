<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
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

        $index = random_int(0, sizeof($categories)-1);

        $category = Category::where("name", $categories[$index])->first();

        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'email' => $this->faker->email(),
            'category_id' => $category->id,
            'user_id' => User::all()->first()->id,
        ];
    }
}

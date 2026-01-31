<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Favorite;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        return [
            'film_id' => $this->faker->uuid,
            'title' => $this->faker->sentence(3),
            'year' => $this->faker->numberBetween(1990, 2023),
            'rating' => $this->faker->randomElement([null, $this->faker->randomFloat(1, 1, 10)]),
            'notes' => $this->faker->optional()->paragraph,
            'poster_url' => $this->faker->optional()->imageUrl(),
            'imdb_id' => $this->faker->optional()->regexify('[a-zA-Z0-9]{9}')
        ];
    }
}
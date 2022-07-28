<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Actor;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        return [
            'fullName' => $this->faker->name,
            'image' => $this->faker->image(storage_path('images'), 100, 100, null, false),
            'description' => $this->faker->text,
            'height' => $this->faker->randomFloat(2, 1, 3),
            'dateOfBirth' => $this->faker->date,
            'children' => [$this->faker->name, $this->faker->name],
        ];
    }
}

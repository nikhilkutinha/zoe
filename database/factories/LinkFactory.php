<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ending' => str_random(8),
            'destination' => $this->faker->url,
            'description' => $this->faker->text,
            'user_id' => User::all()->random()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Visitor::unguard();

        return [
            'ip' => $this->faker->ipv4,
            'country' => $this->faker->country,
            'browser' => Arr::random([
                'Chrome', 
                'Firefox', 
                'IE', 
                'Edge', 
                'Opera'
            ]),
            'platform' => Arr::random([
                'Windows',
                'Mac',
                'Linux',
                'Android',
                'iOS'
            ]),
            'referer' => $this->faker->domainName,
            'created_at' => $this->faker->dateTimeBetween('+1 day', '+1 month')
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $num = rand(1, 1000);

        return [
            'title' => 'title number '.$num,
            'description' => 'description number '.$num
        ];
    }
}

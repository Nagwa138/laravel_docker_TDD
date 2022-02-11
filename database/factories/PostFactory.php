<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->sentence,
            'notes' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'owner_id' =>function (){
                return User::factory()->create()->id;
            }
        ];
    }
}

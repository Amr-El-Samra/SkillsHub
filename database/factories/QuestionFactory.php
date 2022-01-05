<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->sentence(),
            'option_1'=> $this->faker->sentence(5),
            'option_2'=> $this->faker->sentence(5),
            'option_3'=> $this->faker->sentence(5),
            'option_4'=> $this->faker->sentence(5),
            'right_ans'=> $this->faker->numberBetween(1, 4),
            
        ];
    }
}

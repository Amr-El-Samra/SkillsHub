<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arabicFaker = \Faker\Factory::create('ar_JO');
        return [
            'name'=>json_encode([
                'en'=> $this->faker->word(),
                'ar'=> $arabicFaker->word(),
            ]),
        ];
    }
}

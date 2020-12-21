<?php

namespace Database\Factories;

use App\Models\UserInformations;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInformationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserInformations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contact_email' => $this->faker->email,
            'biography' => $this->faker->text
        ];
    }
}

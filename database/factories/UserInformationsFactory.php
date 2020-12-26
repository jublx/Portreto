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
      do {
        $number = strval(rand(100,999)) . "-" . strval(rand(100,999)) . "-" . strval(rand(100,999));
      } while($this->friendCodeExists($number));
      
      return [
          'friend_code' => $number
      ];
    }

    public function friendCodeExists($number) {
      return UserInformations::whereFriendCode($number)->exists(); // on vérifie que le code généré n'existe pas déjà
  }
}

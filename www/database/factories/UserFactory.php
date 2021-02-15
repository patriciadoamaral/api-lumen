<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome_completo' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###########'),
            'cnpj' => $this->faker->unique()->numerify('##############'),
            'email' => $this->faker->unique()->safeEmail,
            'senha' => $this->faker->password(),
            'carteira' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enum\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create([
            'role_id' => RoleEnum::PASIEN
        ]);
        return [
            'born' => $this->faker->dateTimeThisCentury('now'),
            'weight' => $this->faker->randomFloat(1, 20, 200),
            'height' => $this->faker->randomFloat(0, 50, 300),
            'gender'=> $this->faker->boolean(),
            'user_id' => $user->id,
            'illnessHistory' => $this->faker->text(100)
        ];
    }
}

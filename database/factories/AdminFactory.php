<?php

namespace Database\Factories;

use App\Enum\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create([
            'role_id' => RoleEnum::ADMIN,
            'email' => 'admin@igoniometer.my.id'
        ]);
        return [
            'user_id' => $user->id
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Pasien;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonitoringRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'x' => $this->faker->numberBetween(0, 360),
            'y' => $this->faker->numberBetween(0, 360),
            'z' => $this->faker->numberBetween(0, 360),
            'emg' => $this->faker->randomFloat(2, 0, 3.3),
        ];

        $data = json_encode($data);

        return [
            'created_at' => $this->faker->dateTimeBetween('-2 days', 'now')->format('Y-m-d H:i:s'),
            'data' => $data
        ];
    }
}

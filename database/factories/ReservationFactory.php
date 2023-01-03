<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'facility_id' => Facility::factory(),
            'starttime' => $this->faker->dateTimeBetween('-1 hour', 'now')->format('Y-m-d H:i'),
            'endtime' => $this->faker->dateTimeBetween('now', '+1 hour')->format('Y-m-d H:i'),
            'perpose' => $this->faker->realText(50),
        ];
    }
}

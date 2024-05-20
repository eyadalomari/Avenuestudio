<?php

namespace Database\Factories;

use App\Models\Reservations;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'mobile' => $this->faker->phoneNumber,
            'type_id' => $this->faker->randomDigit,
            'location_type' => $this->faker->randomElement(['indoor', 'outdoor']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'price_remaining' => $this->faker->randomFloat(2, 0, 1000),
            'photographer' => $this->faker->randomDigit,
            'status_id' => $this->faker->randomDigit,
            'has_video' => $this->faker->boolean,
            'start_date' => $this->faker->dateTime,
            'end_date' => $this->faker->dateTime,
            'note' => $this->faker->paragraph,
            'added_by' => $this->faker->randomDigit,
            'updated_by' => $this->faker->randomDigit,
        ];
    }
}


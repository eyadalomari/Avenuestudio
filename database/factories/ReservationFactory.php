<?php

namespace Database\Factories;

use App\Models\Reservations;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $mobilePrefixes = ['079', '077', '078'];
        $mobile = $this->faker->randomElement($mobilePrefixes) . $this->faker->numerify('#######');

        $startTime = $this->faker->time('H:i');
        $endTime = Carbon::createFromFormat('H:i', $startTime)->addMinutes($this->faker->numberBetween(1, 240))->format('H:i');

        // Ensure end time is after start time
        if ($endTime <= $startTime) {
            $endTime = Carbon::createFromFormat('H:i', $startTime)->addMinutes($this->faker->numberBetween(1, 240))->format('H:i');
        }

        $date = Carbon::today()->addDays($this->faker->numberBetween(1, 365))->format('Y-m-d');

        // Ensure that foreign key values exist
        $statusIds = Status::pluck('id')->toArray();
        $typeIds = Type::pluck('id')->toArray();
        $photographerIds = User::pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'mobile' => $mobile,
            'type_id' => $this->faker->randomElement($typeIds),
            'location_type' => $this->faker->randomElement(['indoor', 'outdoor']),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'price_remaining' => $this->faker->randomFloat(2, 0, 1000),
            'photographer' => $this->faker->randomElement($photographerIds),
            'status_id' => $this->faker->randomElement($statusIds),
            'has_video' => $this->faker->boolean,
            'date' => $date,
            'start' => $startTime,
            'end' => $endTime,
            'note' => $this->faker->paragraph,
            'added_by' => $this->faker->randomDigitNotNull,
            'updated_by' => $this->faker->randomDigitNotNull,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(['1', '2', '7', '9', '11']),
            'date' => fake()->randomElement([date('Y-m-d', strtotime('2023-05-27')), now()->format('Y-m-d'), date('Y-m-d', strtotime('2023-05-26'))]),
            'status' => fake()->randomElement([Attendance::STATUS_PRESENT, Attendance::STATUS_ABSENT])
        ];
    }
}

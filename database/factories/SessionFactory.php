<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        static $number = 1;

        $startTime = strtotime(str_pad($this->faker->numberBetween(8, 21), "0", STR_PAD_LEFT) . ":00:00");

        return [
            'session_id' => "SS" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'day_of_week' => $this->faker->dayOfWeek(),
            'start_time' => date('H:i:s', $startTime),
            'end_time' => date('H:i:s', $startTime + 60 * 60 * $this->faker->numberBetween(1, 2))
        ];
    }
}

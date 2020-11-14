<?php

namespace Database\Factories;

use App\Models\Enrolment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrolmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrolment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $number = 0;

        return [
            'student_id' => "J" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'section_id' => "SC" . str_pad($number++, 8, "0", STR_PAD_LEFT)
        ];
    }
}

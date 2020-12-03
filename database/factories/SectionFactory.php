<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enum\UserType;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lecturers = Staff::where('staff_type', '!=', UserType::IO)->pluck('staff_id');

        static $number = 1;

        return [
            'section_id' => "SC" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'section_name' => strtoupper($this->faker->randomLetter() . mt_rand(1, 9)),
            'lecturer_id' => $this->faker->randomElement($lecturers),
        ];
    }
}

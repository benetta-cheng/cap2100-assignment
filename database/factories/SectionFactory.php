<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        static $number = 0;

        return [
            'section_id' => "SC" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'section_name' => strtoupper(Str::random(1) . mt_rand(1)),
            'lecturer_id' => "L" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'course_id' => strtoupper(Str::random(3) . mt_rand(4))
        ];
    }
}

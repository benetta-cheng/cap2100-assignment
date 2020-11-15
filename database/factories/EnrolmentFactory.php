<?php

namespace Database\Factories;

use App\Models\Enrolment;
use App\Models\Section;
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

        return [];
    }

    public function supplyStudentId($studentId)
    {
        $sections = Section::all()->filter(function ($section, $key) use ($studentId) {
            return Enrolment::where([['student_id', '=', $studentId], ['section_id', '=', $section->section_id]])->count() === 0;
        })->pluck('section_id');
        return $this->state(function (array $attributes) use ($studentId, $sections) {
            return [
                'student_id' => $studentId,
                'section_id' => $this->faker->randomElement($sections)
            ];
        });
    }
}

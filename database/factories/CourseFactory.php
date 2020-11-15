<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course_names = [
            'Capstone Project',
            'Introduction to Web Programming with PHP',
            'Program Logic Formulation',
            'Database Management',
            'Introduction to Cloud Computing',
            'Fundamentals of Trustworthy Computing',
            'Introduction to Data Structure',
            'Introudction to Mobile Apps Development',
            'Object-Oriented Programming',
            'Introduction to Business Analytics'
        ];

        return [
            'course_id' => strtoupper($this->faker->lexify('???') . mt_rand(1000, 9999)),
            'course_name' => $this->faker->randomElement($course_names)
        ];
    }
}

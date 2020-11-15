<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Enum\StudentType;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $programmes = Programme::all()->pluck('programme_id');

        static $number = 1;

        return [
            'student_id' => "J" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'student_type' => StudentType::LOCAL,
            'ic_num' => $this->faker->myKadNumber,
            'name' => $this->faker->name,
            'contact_num' => $this->faker->mobileNumber,
            'address' => $this->faker->address,
            'academic_session' => 'AUGUST 2020',
            'programme' => $this->faker->randomElement($programmes),
            'password' => Hash::make('test')
        ];
    }

    /**
     * Indicate that the student is a international student.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function international()
    {
        $faker = \Faker\Factory::create();
        return $this->state(function (array $attributes) use ($faker) {
            return [
                'name' => $faker->firstName() . " " . $faker->lastName(),
                'student_type' => StudentType::INTERNATIONAL,
                'ic_num' => $faker->unique()->randomNumber(9)
            ];
        });
    }
}

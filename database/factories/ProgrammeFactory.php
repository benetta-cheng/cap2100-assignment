<?php

namespace Database\Factories;

use App\Models\Programme;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enum\UserType;

class ProgrammeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Programme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $programme_names = [
            'Diploma in Information Technology',
            'Diploma in Computer Science'
        ];

        $hops = Staff::where('staff_type', '=', UserType::HOP)->pluck('staff_id');

        static $number = 1;

        return [
            'programme_id' => "P" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'programme_name' => $this->faker->randomElement($programme_names),
            'head_of_programme' => $this->faker->randomElement($hops)
        ];
    }
}

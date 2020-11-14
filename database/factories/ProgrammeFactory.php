<?php

namespace Database\Factories;

use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        static $number = 0;

        return [
            'programme_id' => "P" . str_pad($number++, 8, "0", STR_PAD_LEFT),
            'programme_name' => $this->faker->name,
            'head_of_programme' => $this->faker->name
        ];
    }
}

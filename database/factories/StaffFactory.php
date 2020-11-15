<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Enum\UserType;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $number = 1;

        return [
            'staff_id' => "S" . str_pad($number, 8, "0", STR_PAD_LEFT),
            'email_address' => "staff" . $number++ . '@newinti.edu.my',
            'name' => $this->faker->name,
            'staff_type' => UserType::LECTURER,
            'password' => Hash::make('test')
        ];
    }

    /**
     * Indicate that the staff is a HOP.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function hop()
    {
        return $this->state(function (array $attributes) {
            return [
                'staff_type' => UserType::HOP,
            ];
        });
    }

    /**
     * Indicate that the staff is from IO.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function io()
    {
        return $this->state(function (array $attributes) {
            return [
                'staff_type' => UserType::IO,
            ];
        });
    }
}

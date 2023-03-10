<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
}

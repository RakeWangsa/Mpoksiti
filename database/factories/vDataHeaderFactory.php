<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trader;
use Illuminate\Support\Carbon;
class vDataHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'no_ppk' => $this->faker->numerify('E/E/######'),
            'no_aju_ppk' => $this->faker->numerify('E/E/######'),
            'id_trader' => $this->faker->randomElement(Trader::all())['id_trader'],
            'nm_trader' => $this->faker->name,
            'al_trader' => $this->faker->address,
            'tgl_ppk' =>  $this->faker->dateTimeInInterval('-4 days', '+3 days'),
            'kd_kegiatan' => $this->faker->randomElement(['K', 'E']),
            'nm_penerima' => $this->faker->name,
            'alamat' => $this->faker->address,
            'negara_penerima' => $this->faker->country,
        ];
    }
}

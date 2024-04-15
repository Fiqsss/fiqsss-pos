<?php

namespace Database\Factories;

use App\Models\penjualan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penjualan>
 */
class PenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {

        return [
            'barang_id' => fake()->numberBetween(1, 10),
            'kategori_id' => fake()->numberBetween(1, 3),
            'jumlah' => fake()->numberBetween(1, 10),
        ];
    }
}

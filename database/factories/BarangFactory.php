<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barcode' => fake()->ean8(),
            'kategori_id' => fake()->numberBetween(1,3),
            'nama_barang' => fake()->word(),
            'merk' => fake()->word(),
            'harga_beli' => 2000,
            'harga_jual' => 3000,
            'satuan_barang' => 'pcs',
            'stock' => fake()->numberBetween(5,10),
            'tgl_input' => now(),
            'tgl_update' => now(),
        ];
    }
}

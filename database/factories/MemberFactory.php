<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->randomNumber(5, true),
            'nama_member' => fake()->name(),
            'alamat_member' => fake()->address(),
            'telepon' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'gambar' => fake()->imageUrl(640, 480, 'animals', true),
        ];
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\Kategori;
use App\Models\Penjualan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $this->call(
            [
                CartSeeder::class,
            ]
        );
        $this->call(
            [
                KategoriSeeder::class,
            ]
        );

        $this->call(
            [
                BarangSeeder::class,
            ]
        );
        $this->call(
            [
                MemberSeeder::class,
            ]
        );

        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('111'),
                'role' => 'admin'
            ]
            );


    }
}

<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create(
            [
                'kode' => 'code1',
                'nama_kategori' => 'sabun',
            ]
        );
        Kategori::create(
            [
                'kode' => 'code2',

                'nama_kategori' => 'Atk',
            ]
        );
        Kategori::create(
            [
                'kode' => 'code3',

                'nama_kategori' => 'Sembako',
            ]
        );
    }
}

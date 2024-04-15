<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\penjualan;
use Illuminate\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // function kali()
        // {
        //     $barang = Barang::sum('harga_jual');
        //     $penjualan = Penjualan::sum('jumlah');
        //     $hasil = $barang * $penjualan;
        //     return $hasil;
        // }
        Penjualan::factory()->count(5)->create();
        // Penjualan::create(
        //     [
        //         'total' => kali(),
        //     ]
        // );
    }
}

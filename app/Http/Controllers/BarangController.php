<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function store()
    {
        $jmlbarangs = Barang::count('nama_barang');
        $jmlstock = Barang::sum('stock');
        $jmlktg = Kategori::count('nama_kategori');
        // $nowterjual = Barang::sum('');
        return view('page.home',
        [
            'page' => 'dashboard',
            'jmlbarangs' => $jmlbarangs,
            'jmlstock' => $jmlstock,
            'jmlktg' => $jmlktg,
        ]);
    }

    public function viewDataBarang()
    {
        return view('page.master.barang',['page' => 'databarang']);
    }
}

<?php

namespace App\Http\Controllers;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('page.transaksi.transaksi',
            [
                'page' => 'transaksi',
            ]);
    }
    public function laporanView()
    {
        return view('page.transaksi.laporan',
            [
                'page' => 'laporan',
            ]);
    }
}

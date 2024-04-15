<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function viewkategori()
    {
        return view('page.master.kategori',['page' => 'kategori']);
    }
}

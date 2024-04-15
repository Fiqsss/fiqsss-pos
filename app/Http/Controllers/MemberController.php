<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('page.master.member',['page' => 'member']);
    }
}

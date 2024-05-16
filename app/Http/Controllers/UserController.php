<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function view()
    {
        return view('page.user.index',['page' => 'user']);
    }

    public function login(){
        return view('page.login');
    }
}

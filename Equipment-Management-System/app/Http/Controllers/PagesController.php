<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome To Laravel';
        return view('pages.home')->with('title', $title);
    }

    public function login() {
        $title = '登入';
        return view('pages.login')->with('title', $title);
    }
    public function addUser() {
        $title = '註冊';
        return view('pages.addUser')->with('title', $title);
    }






}

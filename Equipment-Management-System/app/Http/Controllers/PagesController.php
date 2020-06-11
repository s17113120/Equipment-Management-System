<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index(Request $request) {
        $title = 'Welcome To Laravel';

        if (session()->has('userdata')) {
            if (session('userdata')->user_authority == "management") {
                return view('pages.management_home');
            } else if (session('userdata')->user_authority == "admin") {
                return view('pages.admin_home');
            } else { // user
                return view('pages.user_home');;

            }
        }
        else {
            return view('pages.home')->with('title', $title);
            // return redirect('/');
        }
    }

    public function login() {
        $title = '登入';
        return view('pages.login')->with('title', $title);
    }
    public function addUser() {
        $title = '註冊';
        return view('pages.addUser')->with('title', $title);
    }


    public function logout(Request $request) {
        $title = 'Welcome To Laravel';
        session()->flush();
        return  redirect('/');

    }



}

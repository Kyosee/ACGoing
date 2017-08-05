<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * site index page
     */
     public function home(){
         return view('home.home');
     }
}

<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller{
    public function show(){
        return view('member.show');
    }
}

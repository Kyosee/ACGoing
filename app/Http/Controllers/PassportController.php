<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * user signup
     */
    public function signup(){
        return view('passport.signup');
    }

    /**
     * user login
     */
    public function login(){
        return view('passport.login');
    }

    /**
     * passport captcha
     */
    public function captcha(){
        $Kit = new KitController();
        return $Kit->captcha('passport_captcha', 165, 46);
    }
}

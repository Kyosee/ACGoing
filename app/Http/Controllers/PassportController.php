<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class PassportController extends Controller
{
    /**
     * user signup view
     */
    public function signup(){
        return view('passport.signup');
    }

    /**
     * user login view
     */
    public function login(){
        return view('passport.login');
    }

    /**
     * make passport captcha
     * @return file     captcha picture stream
     */
    public function captcha(){
        $Kit = new KitController();
        return $Kit->captcha('passport_captcha', 165, 46);
    }
}

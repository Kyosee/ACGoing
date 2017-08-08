<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Auth;

class PassportController extends Controller
{
    /**
     * user signup view
     */
    public function signup(){
        return view('passport.signup');
    }

    /**
     * user signup processing
     * @return [type] [description]
     */
    public function subReg(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
            'captcha'  => 'required|same_session:passport_captcha',
            'is_agree'  => 'accepted',
        ]);

        $UserModel = new UserModel();
        if($UserModel->createNewUser($request)){
            Auth::login($UserModel);
            return response()->json(['result' => true, 'redirect_url' => 'home']);
        }else{
            return response()->json(['result' => false]);
        }
    }

    /**
     * user login view
     */
    public function login(){
        return view('passport.login');
    }

    /**
     * userlogin
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function subLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        // user login and remember me
        if(Auth::attempt($credentials, $request->has('remember'))){
            return response()->json(['result' => true, 'redirect_url' => 'home']);
        }else{
            return response()->json(['result' => false]);
        }
    }

    /**
     * make passport captcha
     * @return file     captcha picture stream
     */
    public function captcha(){
        $Kit = new KitController();
        return $Kit->captcha('passport_captcha', 165, 46);
    }

    /**
     * user logout
     * @return [type] [description]
     */
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}

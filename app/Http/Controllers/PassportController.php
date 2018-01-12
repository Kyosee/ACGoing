<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class PassportController extends Controller
{
    /**
     * user register view
     */
    public function register(){
        return view('passport.register');
    }

    /**
     * user register processing
     * @return [type] [description]
     */
    public function subReg(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
            'captcha'  => 'required|same_session:passport_captcha',
            'is_agree'  => 'accepted',
        ]);

        $User = new User();
        if($User->createNewUser($request)){
            Auth::login($User);
            return response()->json(['result' => true, 'redirect_url' => route('home')]);
        }else{
            return response()->json(['result' => false, 'msg' => '注册失败请稍后重试..']);
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
            return response()->json(['result' => true, 'redirect_url' => route('home')]);
        }else{
            return response()->json(['result' => false, 'msg' => '用户不存在或用户名密码有误']);
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

<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\User as User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * site users default controller
 * do show/edit/other
 */
class HomeController extends Controller{

    /**
     * show the user info
     */
    public function show(User $user){
        return view('users.show', compact('user'));
    }

    /**
     * edit user info
     */
    public function edit(User $user){
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
}

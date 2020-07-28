<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    // public function login(){
    //     $credentials = $this->validate(request(),[
    //             'email'=> 'email|required|string',
    //             'password'=>'required|string'
    //         ]);
    //         return view('Client');

    //         // return back()
    //         //            ->withErrors(['email' => trans('auth.failed')])
    //         //            ->withInput(request(['email']));
    // }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        $credentials = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);
        $email = $credentials['email'];

        if (Auth::user()->email == $email && Auth::user()->profile == "Administrador") {
            return '/Admin/Merkado/Croqueta';

        } else if (Auth::user()->email == $email && Auth::user()->profile == "Ventas Linea") {
            return '/customer/service';

        } else if (Auth::user()->email == $email && Auth::user()->profile == "Ventas Cdmx") {
            return  'shop/cdmx';

        } else if (Auth::user()->email == $email && Auth::user()->profile == "Ventas Acapulco") {
            return  'shop/acapulco';

        } else if (Auth::user()->email == $email && Auth::user()->profile == "Contabilidad") {
            return '/Accounting';

        } else {
            return '/fail';
        }
    }
}

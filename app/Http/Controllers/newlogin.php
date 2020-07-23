<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class newlogin extends Controller
{
    public function Login (){
        return view('Client');
    }



    public function ConsultData(Request $request){
        
        $request->flash();
            $token = $request->get('_token');
            $query = DB::select('select id,name,email,password FROM users');
            return view('Consult_products',compact('query'));
    }

}

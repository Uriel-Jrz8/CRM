<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


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
            //return $request;
    }

    public function exportDocument()
    {
        return Excel::download(new UsersExport, 'datos.xlsx');
    }

    public function prueba(Request $request)
    {
        $request->flash();
        $query = DB::select('select id,name,email,password FROM users');
        return ($request);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\ServiceProvider;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PDFController extends Controller
{
    public function downloadPDF (){

        //$query = DB::select('select id,name,email,password FROM users');
        //$pdf = \PDF::loadView('Consult_products',compact('query'));
        $pdf = \PDF::loadView('Consult_products');
        return $pdf->download('Datos.pdf');
    }
}

<?php

namespace App\Http\Controllers;
use App\line;
use App\Acapulco;
use App\Cdmx;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewData extends Controller
{

    //Consultar Datos


    public function ConsultData(Request $request){
        $request->flash();
        $token = $request->get('_token');
        $query = DB::select('select folio, Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Numero_Guia,Total from orders_linea');
        return view('Consult_products',compact('query'));
    }

    public function ConsultCDMX(Request $request){
        
        $request->flash();
        $token = $request->get('_token');
        //Consulta para ver los pedidos que se han realizado en la cdmx
        $query = DB::select('select * from orders_cdmx');
        return view('DateCdmx',compact('query'));
    }

    public function ConsultAcapulco(Request $request){

        $request->flash();
        $token = $request->get('_token');
        //Consulta para ver los pedidos que se han hecho en acapulco
        $query = DB::select('select * from orders_Acapulco');
        return view('DateAcapulco',compact('query'));
    }

    // Metodos para ver el Stock de las tiendas
    public function stockcdmx(Request $request){
        $request->flash();
        $token = $request->get('_token');
        // Consulta para ver el stock de Cdmx
        //select stock de cdmx
        $query = DB::select('select * from users');
        return view('DateCDMX',compact('query'));
    }

    public function stockacapulco(Request $request){
        $request->flash();
        $token = $request->get('_token');
        //Consulta para ver el stock de acapulco
        //select stock de acapulco
        $query = DB::select('select * from password_resets');
        return view('DateAcapulco',compact('query'));
    }

    // public function Accounting(Request $request){
    //     $request->flash();
    //     $token = $request->get('_token');
    //     $query = DB::select('select FROM PedidosSucursales');
    //     $queryCdmx = DB::select('select Campos Sucursal que quieres ver FROM PedidosSucursales where = "Sucursal"');
    //     //$queryAcapulco = DB::select('select Campos Sucursal que quieres ver FROM PedidosSucursales where = "Sucursal"');
    //      return view('ProductsCDMX',compact('query'));
    //     }

}

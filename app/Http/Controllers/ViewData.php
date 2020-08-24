<?php

namespace App\Http\Controllers;
use App\line;
use App\Acapulco;
use App\Cdmx;
use App\OrdersLine;
use App\Venta;
use Auth;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewData extends Controller
{

    //Consultar Datos

    public function ConsultData(Request $request){
        $request->flash();
        $token = $request->get('_token');
        $query2 = DB::select('select folio From orders_linea group by folio');
        $query = DB::select('select created_at, sum(Total), folio from orders_linea group by folio,created_at');
        return view('Consult_products',compact('query','query2'));
    }

    public function DetalleLinea()
    {
        $data = request();
        $queryDetalle = DB::select("select Nombre_Producto,Codigo_Sku,Marca,Precio,Cantidad,Total from orders_linea where folio = '$data->folioVenta' ");
        $queryTotal =DB::select(" select folio,Total from ventas where folio = '$data->folioVenta' group by folio,total");
        return view('VentaDetalle/DetalleLinea',compact('queryDetalle','queryTotal'));
    }

    public function ConsultCDMX(Request $request){
        
        $request->flash();
        $token = $request->get('_token');
        $query2 = DB::select('select folio From orders_cdmx group by folio');
        $query = DB::select('select created_at, sum(Total), folio from orders_cdmx group by folio,created_at');
        return view('DateCdmx',compact('query','query2'));
    }

    public function DetalleCdmx()
    {
        $data = request();
        $queryDetalle = DB::select("select Nombre_Producto,Codigo_Sku,Marca,Precio,Cantidad,Total from orders_cdmx where folio = '$data->folioVenta' ");
        $queryTotal =DB::select(" select folio,Total from ventas_cdmx where folio = '$data->folioVenta' group by folio,total");
        return view('VentaDetalle/DetalleCdmx',compact('queryDetalle','queryTotal'));
    }

    public function ConsultAcapulco(Request $request){  
        $request->flash();
        $token = $request->get('_token');
        $query2 = DB::select('select folio From orders_acapulco group by folio');
        $query = DB::select('select created_at, sum(Total), folio from orders_acapulco group by folio,created_at');
        return view('DateAcapulco',compact('query','query2'));
    }

    public function DetalleAcapulco()
    {
        $data = request();
        $queryDetalle = DB::select("select Nombre_Producto,Codigo_Sku,Marca,Precio,Cantidad,Total from orders_acapulco where folio = '$data->folioVenta' ");
        $queryTotal =DB::select(" select folio,Total from ventas_acapulco where folio = '$data->folioVenta' group by folio,total");
        return view('VentaDetalle/DetalleAcapulco',compact('queryDetalle','queryTotal'));
    }

    public function stockcdmx(Request $request){
        $request->flash();
        $token = $request->get('_token');
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

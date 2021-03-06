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
        $query = DB::select('select created_at, sum(Total), Plataforma, folio from orders_linea group by folio,created_at,Plataforma');
        return view('ViewLinea.Consult_products',compact('query','query2'));
    }

    public function DetalleLinea()
    {
        $data = request();
        $queryDetalle = DB::SELECT("select Descripcion,Codigo_SKU,Marca,Precio_Venta,Subtotal,Descuento,Cantidad,Total,Porcentaje from orders_linea where folio = '$data->folioVenta' ");
        $queryTotal =DB::SELECT(" select folio,Total from ventas_linea where folio = '$data->folioVenta' group by folio,total");
        return view('VentaDetalle/DetalleLinea',compact('queryDetalle','queryTotal'));
    }

    public function ConsultCDMX(Request $request){
        
        $request->flash();
        $token = $request->get('_token');
        $query2 = DB::select('select folio From orders_cdmx group by folio');
        $query = DB::select('select created_at, sum(Total), Plataforma, folio from orders_cdmx group by folio,created_at');
        return view('ViewCdmx.DateCdmx',compact('query','query2'));
    }

    public function DetalleCdmx()
    {
        $data = request();
        $queryDetalle = DB::select("select Descripcion,Codigo_SKU,Marca,Precio_Venta,Subtotal,Descuento,Cantidad,Total,Porcentaje from orders_cdmx where folio = '$data->folioVenta' ");
        $queryTotal =DB::select(" select folio,Total from ventas_cdmx where folio = '$data->folioVenta' group by folio,total");
        return view('VentaDetalle/DetalleCdmx',compact('queryDetalle','queryTotal'));
    }

    public function ConsultAcapulco(Request $request){  
        $request->flash();
        $token = $request->get('_token');
        $query2 = DB::select('select folio From orders_acapulco group by folio');
        $query = DB::select('select created_at, sum(Total), Plataforma, folio from orders_acapulco group by folio,created_at');
        return view('ViewAcapulco.DateAcapulco',compact('query','query2'));
    }

    public function DetalleAcapulco()
    {
        $data = request();
        $queryDetalle = DB::select("select Descripcion,Codigo_SKU,Marca,Precio_Venta,Subtotal,Descuento,Cantidad,Total,Porcentaje from orders_acapulco where folio = '$data->folioVenta' ");
        $queryTotal =DB::select(" select folio,Total from ventas_acapulco where folio = '$data->folioVenta' group by folio,total");
        return view('VentaDetalle/DetalleAcapulco',compact('queryDetalle','queryTotal'));
    }


    // Metodos para vizualisar los datos del stock

    public function stocklinea(Request $request){
        $request->flash();
        $token = $request->get('_token');
        $query = DB::select('select Id,Codigo_SKU,Descripcion,Categoria,Tipo_Alimento,Animal,Marca,Peso,Precio_Venta,Cantidad_Existente,Descuento,Porcentaje from stock_linea');
        return view('Store.DateStockLinea',compact('query'));
    }

    
    public function stockcdmx(Request $request){
        $request->flash();
        $token = $request->get('_token');
        $query = DB::select('select Id,Codigo_SKU,Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria,Cantidad_Existente,Precio_Venta,Descuento,Porcentaje from stock_cdmx');
        $query2 = "select Id,Nombre_Producto, Marca, Animal, Tipo_Alimento, Peso, Categoria, Codigo_SKU,Cantidad,Precio,Descuento from stock_cdmx";
        return view('Store.DateStock',compact('query','query2'));
    }


    
    public function stockacapulco(Request $request){
        $request->flash();
        $token = $request->get('_token');
        $query = DB::select('select Id,Codigo_SKU,Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria,Cantidad_Existente,Precio_Venta,Descuento,Porcentaje from stock_acapulco');
        return view('Store.DateStockAcapulco',compact('query'));
    }

    public function storehouse(Request $request){
        $request->flash();
        $token = $request->get('_token');
        $query = DB::select('select Id,Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Precio_Compra,Precio_Venta,Entradas,
                             Salidas,Cantidad_Existente,Valor_Compra,Valor_Venta from storehouse');
        return view('Store.StoreDetalle',compact('query'));
    }

    public function entradas(Request $request){ 
    $request->flash();
    $token = $request->get('_token');
    $query = DB::select('SELECT Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Cantidad,Sucursal,created_at FROM entradas');
    return view('Store.Inputs',compact('query'));
    }

    public function salidas(Request $request){ 
    $request->flash();
    $token = $request->get('_token');
    $query = DB::select('SELECT Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Cantidad,Sucursal,created_at FROM salidas');
    return view('Store.Outputs',compact('query'));
    }

    public function filtroEntradas(Request $request){
        $data = request();
        $query = DB::select("SELECT Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Cantidad,Sucursal,created_at FROM entradas
         WHERE created_at BETWEEN '$data->date1 00:00:00' AND '$data->date2 23:59:59'");
        return view('Store.Inputs',compact('query'));
    }

    public function filtroSalidas(Request $request){
        $data = request();
        $query = DB::select("SELECT Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Cantidad,Sucursal,created_at FROM salidas
         WHERE created_at BETWEEN '$data->date1 00:00:00' AND '$data->date2 23:59:59';");
        return view('Store.Outputs',compact('query'));
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

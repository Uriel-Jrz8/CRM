<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class newlogin extends Controller
{

            //Metodos para visualizar los Pedidos
    public function ConsultData(Request $request){
        
            $request->flash();
            $token = $request->get('_token');
            $query = DB::select('select *from pedidos');
            return view('Consult_products',compact('query'));
    }
    public function ConsultCDMX(Request $request){
        
            $request->flash();
            $token = $request->get('_token');
            //Consulta para ver los pedidos que se han realizado en la cdmx
            $query = DB::select('select *from pedidos');
            return view('DateCdmx',compact('query'));
    }
    public function ConsultAcapulco(Request $request){

        $request->flash();
        $token = $request->get('_token');
        //Consulta para ver los pedidos que se han hecho en acapulco
        $query = DB::select('select *from pedidos');
        return view('DateAcapulco',compact('query'));
    }

    public function Accounting(Request $request){
            $request->flash();
            $token = $request->get('_token');
            $query = DB::select('select FROM PedidosSucursales');
            $queryCdmx = DB::select('select Campos Sucursal que quieres ver FROM PedidosSucursales where = "Sucursal"');
            //$queryAcapulco = DB::select('select Campos Sucursal que quieres ver FROM PedidosSucursales where = "Sucursal"');
             return view('ProductsCDMX',compact('query'));
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

    // Metodo para insertar los pedidos a la base de datos
    public function add(){
        $data = request();
        $pedido = $data->pedido;
        $nombre = $data->nombre;
        $marca=$data->marca;
        $peso=$data->unidad;
        $precio = $data->precio;
        $sku = $data->sku;
        $guia = $data->guia;
        $cantidad = $data->cantidad;
        $total = $data->total;
        $sucursal = $data->sucursal;
        $status = $data->estatus;
        $query = DB::select("insert into pedidos (Numero_Pedido,Nombre_Producto,Marca,Peso,Precio_Unitario,Codigo_SKU,Numero_Guia,Cantidad,Sucursal,Total,Satatus_Pedido)
        VALUES ('$pedido','$nombre','$marca','$peso','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");   
        return view('Client');
        
    }

    public function addShops(){
        $data = request();
        $pedido = $data->pedido;
        $nombre = $data->nombre;
        $marca=$data->marca;
        $peso=$data->unidad;
        $precio = $data->precio;
        $sku = $data->sku;
        $guia = $data->guia;
        $cantidad = $data->cantidad;
        $total = $data->total;
        $sucursal = $data->sucursal;
        $status = $data->estatus;
        $query = DB::select("insert into pedidos (Numero_Pedido,Nombre_Producto,Marca,Peso,Precio_Unitario,Codigo_SKU,Numero_Guia,Cantidad,Sucursal,Total,Satatus_Pedido)
        VALUES ('$pedido','$nombre','$marca','$peso','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");
        return view('Shops');
        
    }
        //Metodo para Crear el archivo en Ecxel
    public function exportDocument()
    {
        return Excel::download(new UsersExport, 'datos.xlsx');
    }
    public function ViewStock()
    {
        return view('AddStock');
    }

        //Metodos de rutas
    public function profiles()
    {
        return view('profiles');
    }
    
    public function RouteClient()
    {
        return view('Client');
    }

    public function RouteShop()
    {
        return view('shops');
    }
    public function RouteShopAcapulco()
    {
        return view('ShopsAcapulco');
    }

    public function RouteAccounting()
    {
        return view('Accounting');
    }

    public function RouteAdmin()
    {
        return view('Admin');
    }
}

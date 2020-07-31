<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\stock;
use Auth;
class newlogin extends Controller
{
    public function import(Request $request){

        $file = $request->file('file');
        Excel::import(new UsersImport, $file);

        return back()->with('message','Importacion de datos correcta');

    }




    public function fail()
    {
        return view('home');
    }

            //Metodos para visualizar los Pedidos
    public function ConsultData(Request $request){
        
            $request->flash();
            $token = $request->get('_token');
            $query = DB::select('select *from users');
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

    // Metodo para insertar los pedidos a la base de datos y restar lo que tienen en stock.
    public function add(){
        $data = request();
        $id = $data->id;
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
        $nuevo = Auth::stock()->Cantidad;
        // $query = DB::select("insert into pedidos (Numero_Pedido,Nombre_Producto,Marca,Peso,Precio_Unitario,Codigo_SKU,Numero_Guia,Cantidad,Sucursal,Total,Satatus_Pedido)
        // VALUES ('$pedido','$nombre','$marca','$peso','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");   
        //$query = DB::select("update products_stock set Cantidad = ('$nuevo' + '$cantidad') where Nombre_Producto = 'lata' ");
        $query = DB::select('select * from products_stock');
        return $query;
        
    }
//Actualiza los productos de la base de datos que ya se importo con el excel Suma el valor del nuevo producto
    public function addstock(){
     $data = request();
     $id = $data->id;
     $nombre = $data->nombre;
     $marca = $data->marca;
     $animal = $data->animal;
     $peso = $data->unidad;
     $categoria = $data->categoria;
     $precio = $data->precio;
     $sku = $data->sku;
     $cantidad = $data->cantidad;
     $sucursal = $data->sucursal;
     $info = stock::find($data->id);
     $add = $info->Cantidad;
     
    //  $query = DB::select("insert into products_stock (Nombre_Producto,Marca,Animal,Unidad_Medida,Categoria,Precio_Unitario,Codigo_SKU,Cantidad,Tienda)
    //  VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal')");
    $query = DB::select("update products_stock set Cantidad = ('$add'+ '$cantidad') where Nombre_Producto = '$nombre' ");
     return view('AddStock');
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

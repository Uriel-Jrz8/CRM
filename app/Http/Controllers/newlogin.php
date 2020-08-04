<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LineImport;
use App\Imports\AcaImport;
use App\Imports\CdmxImport;
use App\line;
use App\Acapulco;
use App\Cdmx;
use Auth;

class newlogin extends Controller
{
    //Funcion para Importar productos al stock masivos
    public function import(Request $request){
        $sucursal = $request->sucursal;
        $file = $request->file('file');

        if($sucursal == "En Linea"){
            Excel::import(new LineImport, $file);
            return back()->with('message','Importacion de datos correcta');

            }else if($sucursal == "Acapulco"){
                    Excel::import(new AcaImport,$file);
                    return back()->with('message','Importacion de datos correcta');

                 }else if ($sucursal == "Ciudad de Mexico"){
                            Excel::import(new CdmxImport,$file);
                            return back()->with('message','Importacion de datos correcta');
                    }else {
                            return view('error');
                    }
    }


    public function fail()
    {
        return view('home');
    }

            //Metodos para visualizar los Pedidos
    public function ConsultData(Request $request){
            $request->flash();
            $token = $request->get('_token');
            $query = DB::select('select folio, Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Numero_Guia,Total from orders_linea');
            return view('Consult_products',compact('query'));
    }

    //Funcion Pendiente se pueden manipular datos.
    public function update(){
        //$data = request();
        // $folio = $data->folio;
        // $status = $data->estatus;
        // $query = DB::select("update orders_linea set Estatus = '$status' where folio ='$folio'");
        //return $data;
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
    public function addOders(){
        $data = request();
        $id = $data->id;
        $folio = $data->folio;
        $nombre = $data->nombre;
        $marca = $data->marca;
        $animal = $data->animal;
        $peso = $data->unidad;
        $categoria = $data->categoria;
        $precio = $data->precio;
        $sku = $data->sku;
        $guia = $data->guia;
        $cantidad = $data->cantidad;
        $total = $data->total;
        $sucursal = $data->sucursal;
        $status = $data->estatus;
    
        if($sucursal === 'En Linea'){
         $query = DB::select("insert into orders_linea (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Numero_Guia,Cantidad,Sucursal,Total,Estatus)
                  VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");   
        }else{
                return view('error');
            }
    }

    public function addShops(){
        $data = request();
        $id = $data->id;
        $folio = $data->folio;
        $nombre = $data->nombre;
        $marca = $data->marca;
        $animal = $data->animal;
        $peso = $data->unidad;
        $categoria = $data->categoria;
        $precio = $data->precio;
        $sku = $data->sku;
        $cantidad = $data->cantidad;
        $sucursal = $data->sucursal;
        $total = $data->total;

        if($sucursal == "Ciudad de Mexico"){
            
                 $query = DB::select("insert into orders_cdmx (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                 VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");  
                 return view('Shops');

                } else if($sucursal == "Acapulco"){

                    $query2 = DB::select("insert into orders_Acapulco (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                         VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");  
                         return view('ShopsAcapulco');
                }else{
                    return view('error');
                }
        
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

     $line = line::find($data->id);
     $Acapulco = Acapulco::find($data->id);
     $Cdmx = Cdmx::find($data->id);
     
     if($sucursal == "En Linea"){
        $query = DB::select("update stock_linea set Cantidad = ('$line->Cantidad'+ '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
        return view('AddStock');
        
        }else if($sucursal == "Acapulco"){
            $query = DB::select("update stock_Acapulco set Cantidad = ('$Acapulco->Cantidad'+ '$cantidad') where Nombre_Producto = '$nombre' ");
            return view('AddStock');

            }else if($sucursal == "Ciudad de Mexico"){
                $query = DB::select("update stock_cdmx set Cantidad = ('$Cdmx->Cantidad'+ '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
                return view('AddStock');
            } else{
                return view('error');
            }
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

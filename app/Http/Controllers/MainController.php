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

class MainController extends Controller
{

    public function index()
    {
        return view("Client", ["productos" => line::all()]);
    }


    // Metodo para insertar los pedidos a la base de datos y restar lo que tienen en stock. de atencion a clientes
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
        $line = line::find($data->id);

        if($line->Cantidad == 0){
            return view('error');
        
        }else if($sucursal === 'En Linea'){
         $query = DB::select("insert into orders_linea (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Numero_Guia,Cantidad,Sucursal,Total,Estatus)
                  VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");   
                 
                  $query2 = DB::select("update stock_linea set Cantidad = ('$line->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
                  return view('Client');                

        }else{
                return view('error');
            }
    }


//agrega el pedido a la tabla de cdmx o acapulco
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
        $tienda = line::find($data->id);

        if($sucursal == "Ciudad de Mexico" && $tienda->Cantidad > 0){
            
                 $query = DB::select("insert into orders_cdmx (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                 VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");  
                 $query2 = DB::select("update stock_cdmx set Cantidad = ('$tienda->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");

                 return view('Shops');

                } else if($sucursal == "Acapulco" && $tienda->Cantidad > 0){

                    $query2 = DB::select("insert into orders_Acapulco (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                         VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");  
                         $query2 = DB::select("update stock_acapulco set Cantidad = ('$tienda->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");

                         return view('ShopsAcapulco');
                }else{
                    return view('error');
                }
        
    }



//Actualiza los productos de la base de datos que ya se importo con el excel Suma el valor del nuevo producto
    public function UpdateStock(){
     $mytime = date('Y-m-d H:i:s');
     $data = request();
     $id = $data->id;
     $nombre = $data->nombre;
     $precio = $data->precio;
     $sku = $data->sku;
     $cantidad = $data->cantidad;
     $sucursal = $data->sucursal;

     $line = line::find($data->id);
     $Acapulco = Acapulco::find($data->id);
     $Cdmx = Cdmx::find($data->id);
     
     if($sucursal == "En Linea"){
        $query = DB::select("update stock_linea set Cantidad = ('$line->Cantidad'+ '$cantidad'), Precio = ('$precio'), updated_at = '$mytime' where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
        return view('AddStock');
        
        }else if($sucursal == "Acapulco"){
            $query = DB::select("update stock_Acapulco set Cantidad = ('$Acapulco->Cantidad'+ '$cantidad'), Precio = ('$precio'), updated_at = '$mytime' where Nombre_Producto = '$nombre'");
            return view('AddStock');

            }else if($sucursal == "Ciudad de Mexico"){
                $query = DB::select("update stock_cdmx set Cantidad = ('$Cdmx->Cantidad'+ '$cantidad'), Precio = ('$precio'), updated_at = '$mytime' where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
                return view('AddStock');
            } else{
                return view('error');
            }


    }



//Agrega nuevos productos a la bd del stock
    public function NewAddstock(){
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
           $query = DB::select("insert into stock_linea (Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad)
                    VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad')");
           return view('AddStock');
            
              } else if ($sucursal == "Acapulco"){
                 $query = DB::select("insert into stock_Acapulco (Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad)
                 VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad')");
                    return view('AddStock');
            
                 }else if($sucursal == "Ciudad de Mexico"){
                    $query = DB::select("insert into stock_cdmx (Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad)
                     VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad')");
                 }else{
                    return view('AddStock');
               }
               return view('error');
       }



    //Metodo para Crear y Exportar el archivo en Ecxel
    public function exportDocument(){
        return Excel::download(new UsersExport, 'datos.xlsx');
    }

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

    public function Discount(){
        $data = request();
        if($data->sucursal == "En Linea"){
           $query = DB::select("UPDATE stock_linea SET Descuento = (Precio * '$data->des' / 100) WHERE Marca = '$data->desmarca' OR Codigo_Sku = '$data->desmarca' ") ;
                    return redirect()->route('AdminStock')
                    ->with([
                        "mensaje" => "Descuento Aplicado Correctamente.",
                        "tipo" => "success"
                    ]);
           //return view('AddStock'); 
       
        }else if ($data->sucursal == "Ciudad de Mexico"){
            $query = DB::select("UPDATE stock_cdmx SET Descuento = (Precio * '$data->des' / 100) WHERE Marca = '$data->desmarca' OR Codigo_Sku = '$data->desmarca' ") ;
                     return redirect()->route('AdminStock')
                     ->with([
                         "mensaje" => "Descuento Aplicado Correctamente.",
                         "tipo" => "success"
                     ]);
            // return view('AddStock');
        
        }else if($data->sucursal == "Acapulco"){
                $query = DB::select("UPDATE stock_acapulco SET Descuento = (Precio * '$data->des' / 100) WHERE Marca = '$data->desmarca' OR Codigo_Sku = '$data->desmarca' ") ;
                        return redirect()->route('AdminStock')
                        ->with([
                            "mensaje" => "Descuento Aplicado Correctamente.",
                            "tipo" => "success"
                        ]);
                //return view('AddStock');
        }
        
        
    }

    // Funcion Pendiente se pueden manipular datos.
    // public function update(){
    //     $data = request();
    //     $folio = $data->folio;
    //     $status = $data->estatus;
    //     $query = DB::select("update orders_linea set Estatus = '$status' where folio ='$folio'");
    //     return $data;
   // }
    
}

<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StoreHouseImport;
use App\Imports\LineImport;
use App\Imports\AcaImport;
use App\Imports\CdmxImport;
use App\StoreHouse;
use App\line;
use App\Acapulco;
use App\Cdmx;
use Auth;
use Facade\Ignition\QueryRecorder\Query;

class MainController extends Controller
{

    public function index()
    {
        return view("ViewLinea.Client", ["productos" => line::all()]);
    }


    public function search()
    {
        $data = request();
        $query = DB::select("SELECT Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Precio_Compra,Precio_Venta,Existencias_Iniciales,Entradas,
                             Salidas,Cantidad_Existente,Valor_Compra,Valor_Venta FROM storehouse WHERE Descripcion LIKE '%$data->search%' OR Descripcion LIKE '%$data->search%'");

        return view('Store.StoreDetalle', compact('query'));
    }



    // Metodo para insertar los pedidos a la base de datos y restar lo que tienen en stock. de atencion a clientes
    public function addOders()
    {
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

        if ($line->Cantidad == 0) {
            return view('error');
        } else if ($sucursal === 'En Linea') {
            $query = DB::select("insert into orders_linea (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Numero_Guia,Cantidad,Sucursal,Total,Estatus)
                  VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");

            $query2 = DB::select("update stock_linea set Cantidad = ('$line->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
            return view('ViewLinea.Client');
        } else {
            return view('error');
        }
    }


    //agrega el pedido a la tabla de cdmx o acapulco
    public function addShops()
    {
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

        if ($sucursal == "Ciudad de Mexico" && $tienda->Cantidad > 0) {

            $query = DB::select("insert into orders_cdmx (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                 VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");
            $query2 = DB::select("update stock_cdmx set Cantidad = ('$tienda->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");

            return view('ViewCdmx.Shops');
        } else if ($sucursal == "Acapulco" && $tienda->Cantidad > 0) {

            $query2 = DB::select("insert into orders_Acapulco (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                         VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");
            $query2 = DB::select("update stock_acapulco set Cantidad = ('$tienda->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");

            return view('ViewAcapulco.ShopsAcapulco');
        } else {
            return view('error');
        }
    }


    //Actualiza los productos de la base de datos que ya se importo con el excel Suma el valor del nuevo producto
    public function UpdateStock()
    {
        $mytime = date('Y-m-d H:i:s');
        $data = request();
        $nombre = $data->nombre;
        $precio = $data->precio;
        $sku = $data->sku;
        $cantidad = $data->cantidad;
        $sucursal = $data->sucursal;

        $line = line::find($data->id);
        $Acapulco = Acapulco::find($data->id);
        $Cdmx = Cdmx::find($data->id);
        $almacen = StoreHouse::find($data->id);

        if ($sucursal == "En Linea" && $data->sku == $line->Codigo_Sku) {
            $query = DB::select("UPDATE stock_linea SET Cantidad = ('$line->Cantidad'+ '$cantidad'), updated_at = ('$mytime') WHERE Codigo_Sku = '$sku' ");
            $query2 = DB::select("UPDATE StoreHouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
            $salidas = DB::select("INSERT INTO Salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$sucursal','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Acapulco") {
            $query = DB::select("UPDATE stock_Acapulco SET Cantidad = ('$Acapulco->Cantidad'+ '$cantidad'), updated_at = '$mytime' WHERE Nombre_Producto = '$nombre'");
            $query2 = DB::select("UPDATE StoreHouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
            $salidas = DB::select("INSERT INTO Salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Ciudad de Mexico") {
            $query = DB::select("UPDATE stock_cdmx SET Cantidad = ('$Cdmx->Cantidad'+ '$cantidad'), updated_at = '$mytime' WHERE Codigo_Sku = '$sku' ");
            $query2 = DB::select("UPDATE StoreHouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
            $salidas = DB::select("INSERT INTO Salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Almacen General") {
            $query = DB::select(" UPDATE StoreHouse SET Entradas = ('$almacen->Entradas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' + '$cantidad') WHERE Codigo_Sku = '$sku' ");
            $entradas = DB::select("INSERT INTO Entradas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else {
            // return redirect()->route('AdminStock')
            // ->with([
            //     "message2" => "Código SKU Incorrecto ó Sucursal no Seleccionada.",
            //     "tipo" => "danger"
            // ]);
            return request();
        }
    }

    public function UpdatePrecio()
    {
        $mytime = date('Y-m-d H:i:s');
        $data = request();
        $nombre = $data->nombre;
        $precio = $data->precio;
        $sku = $data->sku;
        $cantidad = $data->cantidad;
        $sucursal = $data->sucursal;

        $line = line::find($data->id);
        $Acapulco = Acapulco::find($data->id);
        $Cdmx = Cdmx::find($data->id);
        $almacen = StoreHouse::find($data->id);

        if ($sucursal == "En Linea") {
            $query = DB::select("UPDATE stock_linea SET Precio = ('$precio'), updated_at = ('$mytime') WHERE Codigo_Sku = '$sku' ");


            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);


        } else if ($sucursal == "Acapulco") {
            $query = DB::select("UPDATE stock_Acapulco SET Precio = ('$precio'), updated_at = '$mytime' WHERE Nombre_Producto = '$nombre'");

            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);


        } else if ($sucursal == "Ciudad de Mexico") {
            $query = DB::select("UPDATE stock_cdmx SET Precio = ('$precio'), updated_at = '$mytime' WHERE Codigo_Sku = '$sku' ");

            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);


        } else if ($sucursal == "Almacen General" && $sku == $almacen->Codigo_SKU) {

            if ($data->opc == "Precio Compra") {
                $query = DB::select("UPDATE storehouse SET Precio_Compra = ('$precio'), updated_at = '$mytime' WHERE Codigo_Sku = '$sku' ");
                $this->totales();
                return redirect()->route('AdminStock')
                    ->with([
                        "message" => "Precio Modificado Correctamente.",
                        "tipo" => "success"
                    ]);


            } else if ($data->opc == "Precio Venta") {
                $query = DB::select("UPDATE storehouse SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_Sku = '$sku' ");
                $this->totales();
                return redirect()->route('AdminStock')
                    ->with([
                        "message" => "Precio Modificado Correctamente.",
                        "tipo" => "success"
                    ]);
            } else {
                return redirect()->route('AdminStock')
                    ->with([
                        "message2" => "Selecciona una Opción, Precio Compra ó Precio Venta.",
                        "tipo" => "danger"
                    ]);
            }
        } else {
            //return view('error');
            return redirect()->route('AdminStock')
                ->with([
                    "message2" => "Código SKU Incorrecto ó Selecciona una Sucursal.",
                    "tipo" => "danger"
                ]);
        }
    }


    public function totales()
    {
        $data = request();
        $sku = $data->sku;
        $sucursal = $data->sucursal;
        $almacen = StoreHouse::find($data->id);
        if ($sucursal == "En Linea") {
            $precios = DB::select("UPDATE StoreHouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
         where Codigo_SKU = '$sku' ");
        } else if ($sucursal == "Acapulco") {
            $precios = DB::select("UPDATE StoreHouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
             where Codigo_SKU = '$sku' ");
        } else if ($sucursal == "Ciudad de Mexico") {
            $precios = DB::select("UPDATE StoreHouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
             where Codigo_SKU = '$sku' ");
        } else if ($sucursal == "Almacen General") {
            $precios = DB::select("UPDATE StoreHouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
             where Codigo_SKU = '$sku' ");
            //$precios = DB::select("UPDATE StoreHouse SET '$data->opc' = ('$almacen->Precio_Compra' '$almacen->Cantidad_Existente')
            //where Codigo_SKU = '$sku' ");

        } else {
            return view('error');
        }
    }


    //Agrega nuevos productos a la bd del stock
    public function NewAddstock()
    {
        $data = request();
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

        if ($sucursal == "En Linea") {
            $query = DB::select("insert into stock_linea (Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad)
                    VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad')");
            return view('AddStock');
        } else if ($sucursal == "Acapulco") {
            $query = DB::select("insert into stock_Acapulco (Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad)
                 VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad')");
            return view('AddStock');
        } else if ($sucursal == "Ciudad de Mexico") {
            $query = DB::select("insert into stock_cdmx (Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad)
                     VALUES ('$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad')");
        } else {
            return view('AddStock');
        }
        return view('error');
    }


    public function Discount()
    {
        $data = request();
        if ($data->sucursal == "En Linea") {
            $query = DB::select("UPDATE stock_linea SET Descuento = (Precio * '$data->des' / 100) WHERE Marca = '$data->desmarca' OR Codigo_Sku = '$data->desmarca' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            //return view('AddStock'); 

        } else if ($data->sucursal == "Ciudad de Mexico") {
            $query = DB::select("UPDATE stock_cdmx SET Descuento = (Precio * '$data->des' / 100) WHERE Marca = '$data->desmarca' OR Codigo_Sku = '$data->desmarca' ");
            return redirect()->route('AdminStock')
                ->with([
                    "mensaje" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            // return view('AddStock');

        } else if ($data->sucursal == "Acapulco") {
            $query = DB::select("UPDATE stock_acapulco SET Descuento = (Precio * '$data->des' / 100) WHERE Marca = '$data->desmarca' OR Codigo_Sku = '$data->desmarca' ");
            return redirect()->route('AdminStock')
                ->with([
                    "mensaje" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            //return view('AddStock');
        }
    }


    //Funcion para Importar productos al stock masivos
    public function import(Request $request)
    {

        $sucursal = $request->sucursal;
        $file = $request->file('file');

        if ($sucursal == "Almacen General") {

            Excel::import(new StoreHouseImport, $file);
            return back()->with('message', 'Importacion de datos correcta');
        } else if ($sucursal == "En Linea") {

            Excel::import(new LineImport, $file);
            return back()->with('message', 'Importacion de datos correcta');
        } else if ($sucursal == "Acapulco") {

            Excel::import(new AcaImport, $file);
            return back()->with('message', 'Importacion de datos correcta');
        } else if ($sucursal == "Ciudad de Mexico") {

            Excel::import(new CdmxImport, $file);
            return back()->with('message', 'Importacion de datos correcta');
        } else {
            return view('error');
        }
    }
    //Metodo para Crear y Exportar el archivo en Ecxel
    public function exportDocument()
    {
        return Excel::download(new UsersExport, 'datos.xlsx');
    }
}

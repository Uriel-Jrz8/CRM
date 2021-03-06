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
        $query = DB::select("SELECT Id,Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Precio_Compra,Precio_Venta,Entradas,
                             Salidas,Cantidad_Existente,Valor_Compra,Valor_Venta FROM storehouse WHERE Descripcion LIKE '%$data->search%' OR Marca LIKE '%$data->search%'");
        return view('Store.StoreDetalle', compact('query'));
    }

    public function searchstorehouse()
    {
        $data = request();
        $query = DB::select("SELECT Id,Codigo_SKU, Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria, Precio_Compra,Precio_Venta,Entradas,
                             Salidas,Cantidad_Existente,Valor_Compra,Valor_Venta FROM storehouse WHERE Cantidad_Existente > 0 ");
        return view('Store.StoreDetalle', compact('query'));
    }

    public function searchCDMX()
    {
        $data = request();
        $query = DB::select("SELECT Id,Codigo_SKU,Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria,Cantidad_Existente,Precio_Venta,Descuento,Porcentaje
                             FROM stock_cdmx WHERE Descripcion LIKE '%$data->search%' OR Marca LIKE '%$data->search%'");
        return view('Store.DateStock', compact('query'));
    }

    public function filtrocdmx()
    {
        $data = request();
        $query = DB::select("SELECT Id,Codigo_SKU,Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria,Cantidad_Existente,Precio_Venta,Descuento,Porcentaje
                             FROM stock_cdmx WHERE Cantidad_Existente > 0");
        return view('Store.DateStockLinea', compact('query'));
    }

    public function searchLINEA()
    {
        $data = request();
        $query = DB::select("SELECT Id,Codigo_SKU,Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria,Cantidad_Existente,Precio_Venta,Descuento,Porcentaje
                             FROM stock_linea WHERE Descripcion LIKE '%$data->search%' OR Marca LIKE '%$data->search%'");
        return view('Store.DateStockLinea', compact('query'));
    }

    public function filtroline()
    {
        $data = request();
        $query = DB::select("SELECT Id,Codigo_SKU,Descripcion, Marca, Animal, Tipo_Alimento, Peso, Categoria,Cantidad_Existente,Precio_Venta,Descuento,Porcentaje
                             FROM stock_linea WHERE Cantidad_Existente > 0");
        return view('Store.DateStockLinea', compact('query'));
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
            $query = DB::insert("INSERT INTO orders_linea (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Numero_Guia,Cantidad,Sucursal,Total,Estatus)
                  VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$guia','$cantidad','$sucursal','$total','$status')");

            $query2 = DB::update("UPDATE stock_linea set Cantidad = ('$line->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");
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

            $query = DB::insert("INSERT INTO orders_cdmx (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                 VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");
            $query2 = DB::update("UPDATE stock_cdmx set Cantidad = ('$tienda->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");

            return view('ViewCdmx.Shops');
        } else if ($sucursal == "Acapulco" && $tienda->Cantidad > 0) {

            $query2 = DB::insert("INSERT INTO orders_acapulco (folio,Nombre_Producto,Marca,Animal,Peso,Categoria,Precio,Codigo_Sku,Cantidad,Sucursal,Total)
                         VALUES ('$folio','$nombre','$marca','$animal','$peso','$categoria','$precio','$sku','$cantidad','$sucursal','$total')");
            $query2 = DB::update("UPDATE stock_acapulco set Cantidad = ('$tienda->Cantidad' - '$cantidad') where Nombre_Producto = '$nombre' AND Codigo_Sku = '$sku' ");

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

        if ($sucursal == "En Linea" and $data->sku == $line->Codigo_SKU) {
            $query = DB::update("UPDATE stock_linea SET Cantidad_Existente = ('$line->Cantidad_Existente'+ '$cantidad'), updated_at = ('$mytime') WHERE Codigo_SKU = '$sku' ");
            $query2 = DB::update("UPDATE storehouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
            $salidas = DB::insert("INSERT INTO salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$sucursal','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Acapulco" and $data->sku == $Acapulco->Codigo_SKU) {
            $query = DB::update("UPDATE stock_acapulco SET Cantidad_Existente = ('$Acapulco->Cantidad_Existente'+ '$cantidad'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku'");
            $query2 = DB::update("UPDATE storehouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_SKU = '$sku' ");
            $salidas = DB::insert("INSERT INTO salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$sucursal','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Ciudad de Mexico" and $data->sku == $Cdmx->Codigo_SKU) {
            $query = DB::update("UPDATE stock_cdmx SET Cantidad_Existente = ('$Cdmx->Cantidad_Existente'+ '$cantidad'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
            $query2 = DB::update("UPDATE storehouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_SKU = '$sku' ");
            $salidas = DB::insert("INSERT INTO salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$sucursal','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Almacen General" and $data->sku == $almacen->Codigo_SKU) {
            $query = DB::update(" UPDATE storehouse SET Entradas = ('$almacen->Entradas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' + '$cantidad') WHERE Codigo_SKU = '$sku' ");
            $entradas = DB::insert("INSERT INTO entradas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$almacen->Codigo_SKU','$almacen->Descripcion','$almacen->Marca','$almacen->Animal','$almacen->Tipo_Alimento','$almacen->Peso','$almacen->Categoria','$cantidad','$sucursal','$mytime') ");
            $this->totales();
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Cantidad Agregada Correctamente.",
                    "tipo" => "success"
                ]);
        } else {
            // return redirect()->route('AdminStock')
            // ->with([
            //     "message2" => "C??digo SKU Incorrecto ?? Sucursal no Seleccionada.",
            //     "tipo" => "danger"
            // ]);
            return request();
        }
    }

    // Modificacion de precio de los productos
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

        if ($sucursal == "En Linea" and $sku == $line->Codigo_SKU) {
            $query = DB::update("UPDATE stock_linea SET Precio_Venta = ('$precio'), updated_at = ('$mytime') WHERE Codigo_SKU = '$sku' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Acapulco" and $sku == $Acapulco->Codigo_SKU) {
            $query = DB::update("UPDATE stock_Acapulco SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku'");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Ciudad de Mexico" and $sku == $Cdmx->Codigo_SKU) {
            $query = DB::update("UPDATE stock_cdmx SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Almacen General" and $sku == $almacen->Codigo_SKU) {
            if ($data->opc == "Precio Compra") {
                $query = DB::update("UPDATE storehouse SET Precio_Compra = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
                $this->totales();
                return redirect()->route('AdminStock')
                    ->with([
                        "message" => "Precio Modificado Correctamente.",
                        "tipo" => "success"
                    ]);
            } else if ($data->opc == "Precio Venta") {
                $query = DB::update("UPDATE storehouse SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
                $this->totales();
                return redirect()->route('AdminStock')
                    ->with([
                        "message" => "Precio Modificado Correctamente.",
                        "tipo" => "success"
                    ]);
            } else {
                return redirect()->route('AdminStock')
                    ->with([
                        "message2" => "Selecciona una Opci??n, Precio Compra ?? Precio Venta.",
                        "tipo" => "danger"
                    ]);
            }
        } else {
            //return view('error');
            return redirect()->route('AdminStock')
                ->with([
                    "message2" => "C??digo SKU Incorrecto ?? Selecciona una Sucursal.",
                    "tipo" => "danger"
                ]);
        }
    }


    public function UpdatePrecio2()
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

        if ($sucursal == "En Linea" and $sku == $line->Codigo_SKU) {
            $query = DB::update("UPDATE stock_linea SET Precio_Venta = ('$precio'), updated_at = ('$mytime') WHERE Codigo_SKU = '$sku' ");
            return redirect()->route('Updateprecio')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Acapulco" and $sku == $Acapulco->Codigo_SKU) {
            $query = DB::update("UPDATE stock_Acapulco SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku'");
            return redirect()->route('Updateprecio')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Ciudad de Mexico" and $sku == $Cdmx->Codigo_SKU) {
            $query = DB::update("UPDATE stock_cdmx SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
            return redirect()->route('Updateprecio')
                ->with([
                    "message" => "Precio Modificado Correctamente.",
                    "tipo" => "success"
                ]);
        } else if ($sucursal == "Almacen General" and $sku == $almacen->Codigo_SKU) {
            if ($data->opc == "Precio Compra") {
                $query = DB::update("UPDATE storehouse SET Precio_Compra = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
                $this->totales();
                return redirect()->route('Updateprecio')
                    ->with([
                        "message" => "Precio Modificado Correctamente.",
                        "tipo" => "success"
                    ]);
            } else if ($data->opc == "Precio Venta") {
                $query = DB::update("UPDATE storehouse SET Precio_Venta = ('$precio'), updated_at = '$mytime' WHERE Codigo_SKU = '$sku' ");
                $this->totales();
                return redirect()->route('Updateprecio')
                    ->with([
                        "message" => "Precio Modificado Correctamente.",
                        "tipo" => "success"
                    ]);
            } else {
                return redirect()->route('Updateprecio')
                    ->with([
                        "message2" => "Selecciona una Opci??n, Precio Compra ?? Precio Venta.",
                        "tipo" => "danger"
                    ]);
            }
        } else {
            //return view('error');
            return redirect()->route('Updateprecio')
                ->with([
                    "message2" => "C??digo SKU Incorrecto ?? Selecciona una Sucursal.",
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
            $precios = DB::update("UPDATE storehouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
         where Codigo_SKU = '$sku' ");
        } else if ($sucursal == "Acapulco") {
            $precios = DB::update("UPDATE storehouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
             where Codigo_SKU = '$sku' ");
        } else if ($sucursal == "Ciudad de Mexico") {
            $precios = DB::update("UPDATE storehouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
             where Codigo_SKU = '$sku' ");
        } else if ($sucursal == "Almacen General") {
            $precios = DB::update("UPDATE storehouse SET Valor_Compra = ('$almacen->Precio_Compra' * '$almacen->Cantidad_Existente'), Valor_Venta = ('$almacen->Precio_Venta' * '$almacen->Cantidad_Existente')
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
        $mytime = date('Y-m-d H:i:s');
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
        $almacen = StoreHouse::find($data->id);


        if ($sucursal == "Almacen General") {
            $query = DB::insert("INSERT INTO storehouse (Codigo_SKU,Descripcion,Marca,Animal,Tipo_alimento,Peso,Categoria,Precio_Compra,Precio_Venta,Entradas,Salidas,Cantidad_Existente,Valor_Compra,Valor_Venta,created_at,updated_at)
             VALUES ('$sku','$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$data->precioC','$data->precioV','$cantidad',0,'$cantidad','$data->precioC' * '$cantidad','$data->precioV '* '$cantidad','$mytime','$mytime')");
            $entradas = DB::insert("INSERT INTO entradas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$sku','$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$cantidad','$sucursal','$mytime') ");

            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Producto Nuevo Agregado Correctamennte.",
                    "tipo" => "success"
                ]);
                
        } else if ($sucursal == "En Linea") {
            $query = DB::insert("INSERT INTO stock_linea (Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Precio_Venta,Codigo_SKU,Cantidad_Existente,Descuento,Porcentaje,created_at,updated_at)
                    VALUES ('$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$data->precioV','$sku','$cantidad',0,0,'$mytime','$mytime')");
                    $query2 = DB::update("UPDATE storehouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
                    $salidas = DB::insert("INSERT INTO salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$sku','$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$cantidad','$sucursal','$mytime') ");
                    $this->totales();
            return redirect()->route('AdminStock')
            ->with([
                "message" => "Producto Nuevo Agregado Correctamennte.",
                "tipo" => "success"
            ]);

        } else if ($sucursal == "Acapulco") {
            $query = DB::insert("INSERT INTO stock_acapulco (Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Precio_Venta,Codigo_SKU,Cantidad_Existente,Descuento,Porcentaje,created_at,updated_at)
                    VALUES ('$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$data->precioV','$sku','$cantidad',0,0,'$mytime','$mytime')");
                    $query2 = DB::update("UPDATE storehouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
                    $salidas = DB::insert("INSERT INTO salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$sku','$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$cantidad','$sucursal','$mytime') ");
                    $this->totales();
            return redirect()->route('AdminStock')
            ->with([
                "message" => "Producto Nuevo Agregado Correctamennte.",
                "tipo" => "success"
            ]);

        } else if ($sucursal == "Ciudad de Mexico") {
            $query = DB::insert("INSERT INTO stock_cdmx (Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Precio_Venta,Codigo_SKU,Cantidad_Existente,Descuento,Porcentaje,created_at,updated_at)
                    VALUES ('$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$data->precioV','$sku','$cantidad',0,0,'$mytime','$mytime')");
                    $query2 = DB::update("UPDATE storehouse SET Salidas = ('$almacen->Salidas' + '$cantidad'), Cantidad_Existente = ('$almacen->Cantidad_Existente' - '$cantidad') WHERE Codigo_Sku = '$sku' ");
                    $salidas = DB::insert("INSERT INTO salidas (Codigo_SKU,Descripcion,Marca,Animal,Tipo_Alimento,Peso,Categoria,Cantidad,Sucursal,created_at) VALUES ('$sku','$nombre','$marca','$animal','$data->alimento','$peso','$categoria','$cantidad','$sucursal','$mytime') ");
                    $this->totales();

            return redirect()->route('AdminStock')
            ->with([
                "message" => "Producto Nuevo Agregado Correctamennte.",
                "tipo" => "success"
            ]);

        } else {
            return view('error');
        }
    }


    public function Discount()
    {
        $data = request();
        if ($data->sucursal == "En Linea") {
            $query = DB::update("UPDATE stock_linea SET Descuento = (Precio_Venta * '$data->des' / 100), Porcentaje = '$data->des' WHERE Marca = '$data->desmarca' OR Codigo_SKU = '$data->desmarca' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            //return view('AddStock'); 

        } else if ($data->sucursal == "Ciudad de Mexico") {
            $query = DB::update("UPDATE stock_cdmx SET Descuento = (Precio_Venta * '$data->des' / 100), Porcentaje = '$data->des' WHERE Marca = '$data->desmarca' OR Codigo_SKU = '$data->desmarca' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            // return view('AddStock');

        } else if ($data->sucursal == "Acapulco") {
            $query = DB::update("UPDATE stock_acapulco SET Descuento = (Precio_Venta * '$data->des' / 100), Porcentaje = '$data->des' WHERE Marca = '$data->desmarca' OR Codigo_SKU = '$data->desmarca' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            //return view('AddStock');
        }
    }

    public function Discount2()
    {
        $data = request();
        if ($data->sucursal == "En Linea") {
            $query = DB::update("UPDATE stock_linea SET Descuento = (Precio_Venta * '$data->des' / 100), Porcentaje = '$data->des' WHERE Marca = '$data->desmarca' OR Codigo_SKU = '$data->desmarca' ");
            return redirect()->route('Updateprecio')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            //return view('AddStock'); 

        } else if ($data->sucursal == "Ciudad de Mexico") {
            $query = DB::update("UPDATE stock_cdmx SET Descuento = (Precio_Venta * '$data->des' / 100), Porcentaje = '$data->des' WHERE Marca = '$data->desmarca' OR Codigo_SKU = '$data->desmarca' ");
            return redirect()->route('Updateprecio')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            // return view('AddStock');

        } else if ($data->sucursal == "Acapulco") {
            $query = DB::update("UPDATE stock_acapulco SET Descuento = (Precio_Venta * '$data->des' / 100), Porcentaje = '$data->des' WHERE Marca = '$data->desmarca' OR Codigo_SKU = '$data->desmarca' ");
            return redirect()->route('Updateprecio')
                ->with([
                    "message" => "Descuento Aplicado Correctamente.",
                    "tipo" => "success"
                ]);
            //return view('AddStock');
        }
    }

    // Eliminar Producto

    public function Delete(Request $request)
    {
        $data = request();

        if ($data->sucursal == "Almacen General") {
            $query = DB::delete(" DELETE FROM storehouse WHERE Codigo_SKU = '$data->codigo' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Producto Eliminado.",
                    "tipo" => "success"
                ]);
        } else if ($data->sucursal == "En Linea") {
            $query = DB::delete(" DELETE FROM stock_linea WHERE Codigo_Sku = '$data->codigo' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Producto Eliminado.",
                    "tipo" => "success"
                ]);
        } else if ($data->sucursal == "Ciudad de Mexico") {
            $query = DB::delete(" DELETE FROM stock_cdmx WHERE Codigo_Sku = '$data->codigo' ");
            return redirect()->route('AdminStock')
                ->with([
                    "message" => "Producto Eliminado.",
                    "tipo" => "success"
                ]);
        } else if ($data->sucursal == "Acapulco") {
            $query = DB::delete(" DELETE FROM stock_acapulco WHERE Codigo_Sku = '$data->codigo' ");
        } else {
            return redirect()->route('AdminStock')
                ->with([
                    "message2" => "Error al Eliminar Producto.",
                    "tipo" => "danger"
                ]);
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
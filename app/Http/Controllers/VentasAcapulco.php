<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Acapulco;
use App\OrdersAcapulco;
use App\VentaAcapulco;
use App\user;

class VentasAcapulco extends Controller
{
    private function vaciarProductos()
    {
        $this->guardarProductos(null);
    }

    public function terminarOCancelarVenta(Request $request)
    {
        if ($request->input("accion") == "terminar") {
            return $this->terminarVenta($request);
        } else {
            return $this->cancelarVenta();
        }
    }

    public function terminarVenta(Request $request)
    {
        $data = request();
        $finTotal = 0;
        foreach ($this->obtenerProductos() as $producto) {
            $finTotal += $producto->cantidad * $producto->Precio_Venta - ($producto->Descuento * $producto->cantidad);
        }

        $productos = $this->obtenerProductos();
        // Recorrer carrito de compras
        foreach ($productos as $producto) {
            // El producto que se vende...
            $productoActualizado = Acapulco::find($producto->Id);
            $productoVendido = new OrdersAcapulco();
            $total1 = $producto->Precio_Venta * $producto->cantidad - ($producto->Descuento * $producto->cantidad);
            
            $productoVendido->folio = $data->folio;
            $productoVendido->Descripcion = $producto->Descripcion;
            $productoVendido->Marca = $producto->Marca;
            $productoVendido->Animal = $producto->Animal;
            $productoVendido->Tipo_Alimento = $producto->Tipo_Alimento;
            $productoVendido->Peso = $producto->Peso;
            $productoVendido->Categoria = $producto->Categoria;
            $productoVendido->Precio_Venta = $producto->Precio_Venta;
            $productoVendido->Codigo_SKU = $producto->Codigo_SKU;
            $productoVendido->Cantidad = $producto->cantidad;
            $productoVendido->Subtotal = ($producto->Cantidad_Existente * $producto->Precio_Venta);
            $productoVendido->Descuento = $producto->Descuento * $producto->cantidad;
            $productoVendido->Porcentaje = $producto->Porcentaje;
            $productoVendido->Total = $total1;
            // Lo guardamos
            $productoVendido->saveOrFail();
            // Y restamos la existencia del original
            $productoActualizado = Acapulco::find($producto->Id);
            $productoActualizado->Cantidad_Existente -= $productoVendido->cantidad;
            $productoActualizado->saveOrFail();
        }
// Agregar ventas a la tabla ventas 
        $TotalVenta = new VentaAcapulco();
        $TotalVenta->folio = $data->folio;
        $TotalVenta->Total = $finTotal;
        $TotalVenta->Metodo_Pago = "Transferencia";
        $TotalVenta->Tarjeta = "xxx xxx xxx xxx";
        $TotalVenta->saveOrFail();
        $query1 = DB::select("update stock_acapulco set Cantidad_Existente = ('$productoActualizado->Cantidad_Existente' - '$producto->cantidad')
                             where Descripcion = '$producto->Descripcion' AND Codigo_SKU = '$producto->Codigo_SKU' ");

        $this->vaciarProductos();
        return redirect()
            ->route("Acapulco")
            ->with([
                "message" => "Venta Realizada Correctamente",
                "tipo" => "success"
            ]);
    }


    public function quitarProductoDeVenta(Request $request)
    {
        $indice = $request->post("indice");
        $productos = $this->obtenerProductos();
        array_splice($productos, $indice, 1);
        $this->guardarProductos($productos);
        return redirect()
            ->route("Acapulco");
    }

    private function guardarProductos($productos)
    {
        session(["productos" => $productos,]);
    }


    private function buscarIndiceDeProducto(string $codigo, array &$productos)
    {
        foreach ($productos as $indice => $producto) {
            if ($producto->Codigo_SKU === $codigo) {
                return $indice;
            }
        }
        return -1;
    }

    private function obtenerProductos()
    {
        $productos = session("productos");
        if (!$productos) {
            $productos = [];
        }
        return $productos;
    }

    public function agregarProductoVenta(Request $request)
    {
        $codigo = $request->post("codigo");
        $producto = Acapulco::where("Codigo_SKU", "=", $codigo)->first();
        if (!$producto) {
            return redirect()
                ->route("Acapulco")
                ->with([
                    "mensaje" => "Producto no encontrado",
                    "tipo" => "danger"
                ]);
        }
        $this->agregarProductoACarrito($producto);
        return redirect()
            ->route("Acapulco");
    }

    private function agregarProductoACarrito($producto)
    {

        if ($producto->Cantidad_Existente <= 0) {
            
            return redirect()->route("Acapulco")
                ->with([
                    "mensaje" => "No hay existencias del producto",
                    "tipo" => "danger"
                ]);
        }

        $productos = $this->obtenerProductos();
        $posibleIndice = $this->buscarIndiceDeProducto($producto->Codigo_SKU, $productos);
        // Es decir, producto no fue encontrado
        if ($posibleIndice === -1) {
            $producto->cantidad = 1;
            array_push($productos, $producto);
        } else {
            if ($productos[$posibleIndice]->cantidad + 1 > $producto->Cantidad_Existente) {
                return redirect()->route("Acapulco")
                    ->with([
                        "mensaje" => "No se puede agregar mas producto, Por favor pide producto a tu provedor",
                        "tipo" => "danger"
                    ]);
           
                    }
                   
                    $productos[$posibleIndice]->cantidad++;
        }
        $this->guardarProductos($productos);        
    }
    
    public function RouteShopAcapulco()
    {
        $total = 0;
        foreach ($this->obtenerProductos() as $producto) {
            $total += $producto->cantidad * $producto->Precio_Venta - ($producto->Descuento * $producto->cantidad);
        }
        return view(
            "ViewAcapulco.ShopsAcapulco",
            [
                "total" => $total,
                "clientes" => User::all(),
            ]
        );
    }
}

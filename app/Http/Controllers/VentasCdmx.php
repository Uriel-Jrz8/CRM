<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Cdmx;
use App\VentaCdmx;
use App\OrdersCdmx;

class VentasCdmx extends Controller
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
            $finTotal += $producto->cantidad * $producto->Precio - ($producto->Descuento * $producto->cantidad);
        }

        $productos = $this->obtenerProductos();
        // Recorrer carrito de compras
        foreach ($productos as $producto) {
            // El producto que se vende...
            $productoActualizado = Cdmx::find($producto->id);
            $productoVendido = new OrdersCdmx();
            $total1 = $producto->Precio * $producto->cantidad - ($producto->Descuento * $producto->cantidad);
            $productoVendido->folio = $data->folio;
            $productoVendido->Nombre_Producto = $producto->Nombre_Producto;
            $productoVendido->Marca = $producto->Marca;
            $productoVendido->Animal = $producto->Animal;
            $productoVendido->Peso = $producto->Peso;
            $productoVendido->Categoria = $producto->Categoria;
            $productoVendido->Precio = $producto->Precio;
            $productoVendido->Codigo_Sku = $producto->Codigo_Sku;
            $productoVendido->Cantidad = $producto->cantidad;
            $productoVendido->Subtotal = ($producto->cantidad * $producto->Precio);
            $productoVendido->Descuento = $producto->Descuento * $producto->cantidad;
            $productoVendido->Total = $total1;
            // Lo guardamos
            $productoVendido->saveOrFail();
            // Y restamos la existencia del original
            $productoActualizado = Cdmx::find($producto->id);
            $productoActualizado->Cantidad -= $productoVendido->cantidad;
            $productoActualizado->saveOrFail();
        }

        $TotalVenta = new VentaCdmx();
        $TotalVenta->folio = $data->folio;
        $TotalVenta->Total = $finTotal;
        $TotalVenta->saveOrFail();
        $query1 = DB::select("update stock_cdmx set Cantidad = ('$productoActualizado->Cantidad' - '$producto->cantidad')
                             where Nombre_Producto = '$producto->Nombre_Producto' AND Codigo_Sku = '$producto->Codigo_Sku' ");

        $this->vaciarProductos();
        return redirect()
            ->route("cdmx")
            ->with([
                "mensaje" => "Venta Realizada Correctamente",
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
            ->route("cdmx");
    }

    private function guardarProductos($productos)
    {
        session(["productos" => $productos,]);
    }


    private function buscarIndiceDeProducto(string $codigo, array &$productos)
    {
        foreach ($productos as $indice => $producto) {
            if ($producto->Codigo_Sku === $codigo) {
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
        $producto = Cdmx::where("Codigo_Sku", "=", $codigo)->first();
        if (!$producto) {
            return redirect()
                ->route("cdmx")
                ->with([
                    "mensaje" => "Producto no encontrado",
                    "tipo" => "danger"
                ]);
        }
        $this->agregarProductoACarrito($producto);
        return redirect()
            ->route("cdmx");
    }

    private function agregarProductoACarrito($producto)
    {

        if ($producto->Cantidad <= 0) {
            return redirect()->route("cdmx")
                ->with([
                    "mensaje" => "No hay existencias del producto",
                    "tipo" => "danger"
                ]);
        }
        $productos = $this->obtenerProductos();
        $posibleIndice = $this->buscarIndiceDeProducto($producto->Codigo_Sku, $productos);
        // Es decir, producto no fue encontrado
        if ($posibleIndice === -1) {
            $producto->cantidad = 1;
            array_push($productos, $producto);
        } else {
            if ($productos[$posibleIndice]->cantidad + 1 > $producto->Cantidad) {
                return redirect()->route("cdmx")
                    ->with([
                        "mensaje" => "No se pueden agregar más productos de este tipo, se quedarían sin existencia",
                        "tipo" => "danger"
                    ]);
            }
            $productos[$posibleIndice]->cantidad++;
        }
        $this->guardarProductos($productos);
    }
    
    public function RouteShop()
    {
        $total = 0;
        foreach ($this->obtenerProductos() as $producto) {
            $total += $producto->cantidad * $producto->Precio - ($producto->Descuento * $producto->cantidad);
        }
        return view(
            "ViewCdmx.shops",
            [
                "total" => $total,
                "clientes" => User::all(),
            ]
        );
    }
}

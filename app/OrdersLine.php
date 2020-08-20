<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersLine extends Model
{
    protected $table = "orders_linea";
    protected $fillable = ["id","folio","Nombre_Producto","Marca","Animal","Peso","Categoria","Precio","Codigo_Sku",
                           "Numero_Guia","Cantidad","Sucursal","total","Estatus"];
}

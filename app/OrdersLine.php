<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersLine extends Model
{
    protected $table = "orders_linea";
    protected $fillable = ["id","folio","Descripcion","Marca","Animal","Tipo_Alimento","Peso","Categoria","Precio_Venta","Codigo_SKU",
                           "Cantidad","Subtotal","Descuento","Porcentaje","Total","Plataforma"];
}

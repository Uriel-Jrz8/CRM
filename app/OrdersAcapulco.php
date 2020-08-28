<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersAcapulco extends Model
{
    protected $table = "orders_Acapulco";
    protected $fillable = ["id","folio","Nombre_Producto","Marca","Animal","Tipo_Alimento","Peso","Categoria","Precio","Codigo_Sku",
                          "Cantidad","Subtotal","Descuento","Sucursal","Total"];
}

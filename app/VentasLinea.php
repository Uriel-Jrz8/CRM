<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasLinea extends Model
{
    protected $table = "ventas_linea";
    protected $fillable = ["id","folio","Total","Metodo_Pago","Tarjeta","Created_at","Updated_at"];
}

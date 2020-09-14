<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCdmx extends Model
{
    protected $table = "ventas_cdmx";
    protected $fillable = ["id","folio","Total","Metodo_Pago","Tarjeta","Created_at","Updated_at"];
}

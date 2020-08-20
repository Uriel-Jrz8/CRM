<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasLinea extends Model
{
    protected $table = "ventas";
    protected $fillable = ["id","folio","Total"];
}

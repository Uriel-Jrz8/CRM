<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaAcapulco extends Model
{
    protected $table = "ventas_acapulco";
    protected $fillable = ["id","folio","Total"];
}

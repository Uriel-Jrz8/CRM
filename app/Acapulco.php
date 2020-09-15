<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acapulco extends Model
{
    protected $table = 'stock_Acapulco';

    protected $primaryKey = 'id';
    
    public function getRouteKeyName(){
        return 'id'; 
    }
    // protected $casts = [
    //     'finalized' => 'boolean',
    // ];

    protected $fillable = [
        'Id','Descripcion','Marca','Animal','Tipo_Alimento','Peso','Categoria','Precio_Venta','Descuento','Codigo_SKU','Cantidad_Existente','Porcentaje','created_at','updated_at'
    ];

    // protected $hidden = [
    //     'idchange_history','created_at','updated_at','is_app'
    // ];

}

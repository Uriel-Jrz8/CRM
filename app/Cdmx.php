<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cdmx extends Model
{
    protected $table = 'stock_cdmx';

    protected $primaryKey = 'id';
    
    public function getRouteKeyName(){
        return 'id'; 
    }
    // protected $casts = [
    //     'finalized' => 'boolean',
    // ];

    protected $fillable = [
        'id','Descripcion','Marca','Animal','Tipo_Alimento','Peso','Categoria','Precio','Descuento','Codigo_SKU','Cantidad','Porcentaje','created_at','updated_at'
    ];

    // protected $hidden = [
    //     'idchange_history','created_at','updated_at','is_app'
    // ];

}

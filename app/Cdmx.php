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
        'id','Nombre_Producto','Marca','Animal','Peso','Categoria','Precio','Codigo_Sku','Cantidad'
    ];

    // protected $hidden = [
    //     'idchange_history','created_at','updated_at','is_app'
    // ];

}

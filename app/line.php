<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class line extends Model
{
    protected $table = 'stock_linea';

    protected $primaryKey = 'Id';
    
    public function getRouteKeyName(){
        return 'Id'; 
    }
    // protected $casts = [
    //     'finalized' => 'boolean',
    // ];

    protected $fillable = [
        'Id','Codigo_SKU','Descripcion','Categoria','Tipo_Alimento','Animal','Marca','Peso','Precio_Venta','Cantidad_Existente','Descuento','Porcentaje','created_at','updated_at'
    ];

    // protected $hidden = [
    //     'idchange_history','created_at','updated_at','is_app'
    // ];

}

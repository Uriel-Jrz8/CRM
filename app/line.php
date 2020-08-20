<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class line extends Model
{
    protected $table = 'stock_linea';

    protected $primaryKey = 'id';
    
    public function getRouteKeyName(){
        return 'id'; 
    }
    // protected $casts = [
    //     'finalized' => 'boolean',
    // ];

    protected $fillable = [
        'id','Nombre_Producto','Marca','Animal','Peso','Categoria','Precio','Codigo_Sku','Cantidad','created_at','updated_at'
    ];

    // protected $hidden = [
    //     'idchange_history','created_at','updated_at','is_app'
    // ];

}

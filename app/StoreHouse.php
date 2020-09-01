<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreHouse extends Model
{
    protected $table = 'StoreHouse';

    protected $primaryKey = 'id';
    
    public function getRouteKeyName(){
        return 'id'; 
    }
    // protected $casts = [
    //     'finalized' => 'boolean',
    // ];

    protected $fillable = [
        'id','Codigo_SKU','Descripcion','Marca','Animal','Tipo_Alimento','Peso','Categoria','Precio_Compra',
        'Precio_Venta','Existencias_Iniciales','Entradas','Salidas','Cantidad_Existente','Valor_Compra','Valor_Venta','created_at','updated_at'
    ];

    // protected $hidden = [
    //     'idchange_history','created_at','updated_at','is_app'
    // ];

}

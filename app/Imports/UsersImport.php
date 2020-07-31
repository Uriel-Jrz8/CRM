<?php

namespace App\Imports;

use App\stock;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new stock([
            'id'=>$row[0],
            'Nombre_Producto'=> $row[1],
            'Marca'=> $row[2],
            'Animal'=> $row[3],
            'Unidad_Medida'=> $row[4],
            'Categoria'=> $row[5],
            'Precio_Unitario'=> $row[6],
            'Codigo_SKU'=> $row[7],
            'Cantidad'=> $row[8],
            'Tienda'=> $row[9],
        ]);
    }
}

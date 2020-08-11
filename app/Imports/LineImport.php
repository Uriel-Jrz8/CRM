<?php

namespace App\Imports;

use App\line;
use Maatwebsite\Excel\Concerns\ToModel;

class LineImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new line([
            'id'=>$row[0],
            'Nombre_Producto'=> $row[1],
            'Marca'=> $row[2],
            'Animal'=> $row[3],
            'Peso'=> $row[4],
            'Categoria'=> $row[5],
            'Precio'=> $row[6],
            'Codigo_Sku'=> $row[7],
            'Cantidad'=> $row[8],
            //'Tienda'=> $row[9],
        ]);
    }
}
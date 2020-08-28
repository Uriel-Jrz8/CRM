<?php

namespace App\Imports;

use App\Cdmx;
use Maatwebsite\Excel\Concerns\ToModel;

class CdmxImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     // modificar al hacer la bd Final
    public function model(array $row)
    {
        return new Cdmx([
            'id'=>$row[0],
            'Nombre_Producto'=> $row[1],
            'Marca'=> $row[2],
            'Animal'=> $row[3],
            'Tipo_Alimento'=> $row[4],
            'Peso'=> $row[5],
            'Categoria'=> $row[6],
            'Precio'=> $row[7],
            'Descuento'=>$row[8],
            'Codigo_Sku'=> $row[9],
            'Cantidad'=> $row[10],
            //'Tienda'=> $row[9],
        ]);
    }
}

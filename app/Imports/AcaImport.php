<?php

namespace App\Imports;

use App\Acapulco;
use Maatwebsite\Excel\Concerns\ToModel;

class AcaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // modificar al hacer la bd Final
    public function model(array $row)
    {
        return new Acapulco([
            // 'id'=>$row[0],
            // 'Nombre_Producto'=> $row[1],
            // 'Marca'=> $row[2],
            // 'Animal'=> $row[3],
            // 'Tipo_Alimento'=> $row[4],
            // 'Peso'=> $row[5],
            // 'Categoria'=> $row[6],
            // 'Precio'=> $row[7],
            // 'Descuento'=>$row[8],
            // 'Codigo_SKU'=> $row[9],
            // 'Cantidad'=> $row[10],
            'id'=>$row[0],
            'Codigo_SKU'=> $row[1],
            'Descripcion'=> $row[2],
            'Categoria'=> $row[3],
            'Tipo_Alimento'=> $row[4],
            'Animal'=> $row[5],
            'Marca'=> $row[6],
            'Peso'=> $row[7],
            'Precio_Venta'=> $row[8],
            'Cantidad_Existente'=> $row[9],
            'Descuento'=>$row[10],
            'Porcentaje'=>$row[11],
            ]);
    }
}

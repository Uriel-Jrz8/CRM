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
     // modificar al hacer la bd Final
    public function model(array $row)
    {
        $mytime = date('Y-m-d H:i:s');
        return new line([
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
            // 'created_at'=>$row[$mytime],
            // 'updated_at'=>$row[$mytime],
            //'Tienda'=> $row[9],
        ]);
    }
}

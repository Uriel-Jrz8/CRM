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
        $mytime = date('Y-m-d H:i:s');
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
            // 'created_at'=>$row[$mytime],
            // 'updated_at'=>$row[$mytime],
            //'Tienda'=> $row[9],
        ]);
    }
}

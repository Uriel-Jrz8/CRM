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
            'Codigo_SKU'=> $row[1],
            'Descripcion'=> $row[2],
            'Categoria'=> $row[3],
            'Tipo_Alimento'=> $row[4],
            'Animal'=> $row[5],
            'Marca'=> $row[6],
            'Peso'=> $row[7],
            'Precio_Venta'=> $row[8],
            'Cantidad_Existente'=> $row[9],
            'Descuento'=> $row[10],
            'Porcentaje'=> $row[11],
            
            // 'created_at'=>$row[$mytime],
            // 'updated_at'=>$row[$mytime],
            //'Tienda'=> $row[9],
        ]);
    }
}

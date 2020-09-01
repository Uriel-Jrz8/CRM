<?php

namespace App\Imports;

use App\StoreHouse;
use Maatwebsite\Excel\Concerns\ToModel;

class StoreHouseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     // modificar al hacer la bd Final
    public function model(array $row)
    {
        return new StoreHouse([
            'id'=>$row[0],
            'Codigo_SKU'=> $row[1],
            'Descripcion'=> $row[2],
            'Marca'=> $row[3],
            'Animal'=> $row[4],
            'Tipo_Alimento'=> $row[5],
            'Peso'=> $row[6],
            'Categoria'=> $row[7],
            'Precio_Compra'=> $row[8],
            'Precio_Venta'=> $row[9],
            'Existencias_Iniciales'=> $row[10],
            'Entradas'=>$row[11],
            'Salidas'=>$row[12],
            'Cantidad_Existente'=> $row[13],
            'Valor_Compra'=> $row[14],
            'Valor_Venta'=> $row[15],
            //'Tienda'=> $row[9],
        ]);
    }
}

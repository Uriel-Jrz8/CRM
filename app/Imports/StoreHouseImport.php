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
            'Entradas'=>$row[10],
            'Salidas'=>$row[11],
            'Cantidad_Existente'=> $row[12],
            'Valor_Compra'=> $row[13],
            'Valor_Venta'=> $row[14],
            //'Tienda'=> $row[9],
        ]);
    }
}

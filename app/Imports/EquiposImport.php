<?php

namespace App\Imports;

use App\Models\Equipos;
use Maatwebsite\Excel\Concerns\ToModel;

class EquiposImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Equipos([
            //
            'nombre'     => $row[0],
            'serial'    => $row[1],
            'modelo' => $row[2],
            'color' => $row[3],
            'salas_id' => $row[4],
            'categorias_id' => $row[5],
        ]);
    }
}

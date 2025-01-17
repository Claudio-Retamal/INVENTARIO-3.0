<?php

namespace App\Imports;
use App\Models\Categorias;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Categorias([
           'nombre'     => $row[0],
           'descripcion'    => $row[1],    
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Personal;
use Maatwebsite\Excel\Concerns\ToModel;

class PersonalImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Personal([
            //
            'nombres'     => $row[0],
            'apellidos'    => $row[1],
            'cargo' => $row[2]

        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personal extends Model
{

    protected $table = "personals";
    protected $fillable = ['nombres', 'apellidos', 'cargos_id', 'estado'];
    protected $hidden = ['id'];

//Muchos personales tienen un cargo
    public function Cargo() : HasMany
    {
     return $this->hasMany(Personal::class);
    }
}

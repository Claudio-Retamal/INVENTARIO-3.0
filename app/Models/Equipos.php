<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipos extends Model
{
    //
    protected $table = "equipos";
    protected $fillable = ['nombre', 'serial', 'modelo', 'color', 'salas_id', 'categorias_id', 'estado'];
    protected $hidden = ['id'];


    public function Categorias(): HasMany
    {
        return $this->hasMany(Categorias::class);
    }

    public function Sala(): HasMany
    {
        return $this->hasMany(Salas::class);
    }

}

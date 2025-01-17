<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categorias extends Model
{
    protected $table = "categorias";
    protected $fillable = ['nombre', 'descripcion','estado'];
    protected $hidden = ['id'];

    public function Equipo() : BelongsTo
    {
        return $this->belongsTo(Equipos::class);
    }
}

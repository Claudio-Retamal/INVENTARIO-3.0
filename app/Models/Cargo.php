<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    protected $table = "cargos";
    protected $fillable = ['nombre', 'estado'];
    protected $hidden = ['id'];

    //Minimo un cargo le pertenece a un personal
    public function Personal() : BelongsTo
    {
        return $this->belongsTo(Personal::class);
        
    }
}

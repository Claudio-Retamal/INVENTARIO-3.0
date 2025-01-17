<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salas extends Model
{
    protected $table = "salas";
    protected $fillable = ['nombre', 'tipo_sala','personals_id','estado'];
    protected $hidden = ['id'];

    public function Personal() : BelongsTo
    {
        return $this->belongsTo(Personal::class);
    }
}

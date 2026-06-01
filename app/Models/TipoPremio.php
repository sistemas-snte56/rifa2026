<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPremio extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'orden_bloque'];

    public function premios(): HasMany
    {
        return $this->hasMany(Premio::class)->orderBy('numero_item');
    }
}

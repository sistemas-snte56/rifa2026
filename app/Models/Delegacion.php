<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegacion extends Model
{
    protected $table = 'delegaciones';
    protected $fillable = [
        'region_id',
        'delegacion',
        'sede',
        'nivel_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->delegacion} - {$this->nivel->nombre} - {$this->sede}";
    }
}

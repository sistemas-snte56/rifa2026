<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Participante extends Model
{
    protected $table = 'participantes';
    protected $fillable = [
        'folio',
        'padron_base_id',
        'delegacion_id',
        'email',
        'telefono',
        'genero',
    ];


    protected static function booted()
    {
        static::creating(function ($participante) {
            $folioUnico = false;

            while (!$folioUnico) {
                // 1. Generamos 3 letras aleatorias en mayúsculas
                $letras = strtoupper(Str::random(3));
                
                // 2. Obtenemos el consecutivo
                $proximoId = (static::max('id') ?? 0) + 1;
                $numero = str_pad($proximoId, 6, '0', STR_PAD_LEFT);

                // 3. Armamos el folio: RIFA2026-LRK-000001
                $nuevoFolio = "RIFA2026-{$letras}-{$numero}";

                // 4. Verificamos disponibilidad en la BD
                if (!static::where('folio', $nuevoFolio)->exists()) {
                    $participante->folio = $nuevoFolio;
                    $folioUnico = true;
                }
            }
        });
    }

    public function padronBase()
    {
        return $this->belongsTo(PadronBase::class);
    }

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class);
    }

    public function premios()
    {
        return $this->hasMany(Premio::class);
    }   
}

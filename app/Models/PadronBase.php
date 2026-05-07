<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PadronBase extends Model
{
    protected $table = 'padron_bases';
    protected $fillable = [
        'nombre_completo',
        'rfc',
        'numero_personal',
    ];

}

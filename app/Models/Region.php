<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regiones';
    protected $fillable = [
        'region',
    ];

    public function delegaciones()
    {
        return $this->hasMany(Delegacion::class);
    }
}

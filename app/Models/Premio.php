<?php

namespace App\Models;

use App\Models\TipoPremio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Participante;

class Premio extends Model
{
    protected $fillable = ['tipo_premio_id', 'numero_item', 'participante_id'];

    public function tipoPremio(): BelongsTo
    {
        return $this->belongsTo(TipoPremio::class);
    }

    public function participante(): BelongsTo
    {
        return $this->belongsTo(Participante::class);
    }
}

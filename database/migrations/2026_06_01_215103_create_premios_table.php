<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_premio_id')->constrained('tipo_premios')->cascadeOnDelete();
            $table->integer('numero_item'); // Para identificar si es la iPad #1, #2, etc.
            // El ganador es nullable porque al inicio del sorteo nadie ha ganado
            $table->foreignId('participante_id')->nullable()->constrained('participantes')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premios');
    }
};

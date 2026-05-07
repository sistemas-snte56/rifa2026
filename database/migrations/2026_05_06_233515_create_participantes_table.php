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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('folio', 30)->unique(); // Numero para el boleto
            $table->foreignId('padron_base_id')->unique()->constrained('padron_bases')->onDelete('cascade');
            $table->foreignId('delegacion_id')->constrained('delegaciones')->onDelete('cascade');
            $table->string('email');
            $table->string('telefono');
            $table->enum('genero', ['H', 'M', 'O'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};

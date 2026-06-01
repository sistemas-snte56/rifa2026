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
        Schema::create('tipo_premios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: iPad, Pantalla, Laptop, Auto
            $table->string('descripcion')->nullable(); // Descripción del premio
            $table->integer('orden_bloque')->default(1); // Para controlar el orden de los paquetes (1, 2, 3...)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_premios');
    }
};

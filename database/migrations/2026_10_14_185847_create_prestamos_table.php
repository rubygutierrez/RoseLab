<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('equipo_id')
                  ->constrained('equipos')
                  ->restrictOnDelete();

            $table->foreignId('estudiante_id')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->foreignId('encargado_id')
                  ->constrained('users')
                  ->restrictOnDelete();

            $table->dateTime('fecha_prestamo');
            $table->dateTime('fecha_devolucion')->nullable();
            $table->enum('estado', ['Activo', 'Devuelto'])
                  ->default('Activo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
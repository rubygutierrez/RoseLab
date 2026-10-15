<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->date('fecha_limite_devolucion')
                  ->nullable()
                  ->after('fecha_prestamo');
        });
    }

    public function down(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn('fecha_limite_devolucion');
        });
    }
};
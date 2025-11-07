<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historial_valoraciones', function (Blueprint $table) {
            // Solo agrega las columnas si no existen (por seguridad)
            if (!Schema::hasColumn('historial_valoraciones', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('fecha_historial');
            }
            if (!Schema::hasColumn('historial_valoraciones', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('historial_valoraciones', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};

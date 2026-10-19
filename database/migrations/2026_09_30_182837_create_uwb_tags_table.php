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
        Schema::create('uwb_tags', function (Blueprint $table) {
            $table->id();

            // Trabajador al que pertenece el Tag UWB
            $table->foreignId('worker_id')
                ->unique()
                ->constrained('workers')
                ->cascadeOnDelete();

            // Identificador físico del dispositivo UWB
            $table->string('device_id')->unique();

            // Nombre visible del Tag dentro de MINERSCAN
            $table->string('name');

            // Estado del dispositivo
            $table->enum('status', ['active', 'inactive', 'maintenance'])
                ->default('active');

            // Nivel de batería del Tag, expresado en porcentaje
            $table->unsignedTinyInteger('battery_level')
                ->nullable();

            // Último momento en que el Gateway recibió información del Tag
            $table->timestamp('last_seen_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uwb_tags');
    }
};
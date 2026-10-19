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
        Schema::create('uwb_positions', function (Blueprint $table) {
            $table->id();

            // Trabajador al que corresponde la posición
            $table->foreignId('worker_id')
                ->constrained('workers')
                ->cascadeOnDelete();

            // Tag UWB que generó la medición
            $table->foreignId('uwb_tag_id')
                ->constrained('uwb_tags')
                ->cascadeOnDelete();

            // Zona en la que se encuentra el trabajador
            $table->foreignId('zone_id')
                ->nullable()
                ->constrained('zones')
                ->nullOnDelete();

            // Posición local calculada por el sistema UWB
            $table->decimal('position_x', 10, 3);
            $table->decimal('position_y', 10, 3);
            $table->decimal('position_z', 10, 3);

            // Precisión estimada de la posición, en metros
            $table->decimal('accuracy', 8, 3)->nullable();

            // Método utilizado para obtener/calcular la posición
            $table->string('position_method')
                ->default('uwb');

            // Momento en que se registró la posición
            $table->timestamp('recorded_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uwb_positions');
    }
};
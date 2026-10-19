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
        Schema::create('uwb_anchors', function (Blueprint $table) {
            $table->id();

            // Zona de la mina donde está instalado el Anchor
            $table->foreignId('zone_id')
                ->nullable()
                ->constrained('zones')
                ->nullOnDelete();

            // Identificador físico del Anchor UWB
            $table->string('device_id')->unique();

            // Nombre visible dentro de MINERSCAN
            $table->string('name');

            // Coordenadas locales del Anchor dentro de la mina
            $table->decimal('position_x', 10, 3)->nullable();
            $table->decimal('position_y', 10, 3)->nullable();
            $table->decimal('position_z', 10, 3)->nullable();

            // Estado del dispositivo
            $table->enum('status', ['active', 'inactive', 'maintenance'])
                ->default('active');

            // Última comunicación recibida
            $table->timestamp('last_seen_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uwb_anchors');
    }
};
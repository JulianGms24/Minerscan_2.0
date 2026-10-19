<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega coordenadas locales UWB a las zonas de la mina.
     */
    public function up(): void
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->decimal('position_x', 10, 3)
                ->nullable()
                ->after('longitude');

            $table->decimal('position_y', 10, 3)
                ->nullable()
                ->after('position_x');

            $table->decimal('position_z', 10, 3)
                ->nullable()
                ->after('position_y');
        });
    }

    /**
     * Revierte las coordenadas UWB agregadas.
     */
    public function down(): void
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->dropColumn([
                'position_x',
                'position_y',
                'position_z',
            ]);
        });
    }
};
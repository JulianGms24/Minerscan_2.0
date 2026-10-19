<?php

namespace Database\Seeders;

use App\Models\Worker;
use App\Models\Zone;
use App\Models\UwbTag;
use App\Models\UwbAnchor;
use App\Models\UwbPosition;
use Illuminate\Database\Seeder;

class UwbTestSeeder extends Seeder
{
    /**
     * Crea datos de prueba para validar la arquitectura UWB.
     */
    public function run(): void
    {
        // Trabajador de prueba
        $worker = Worker::create([
            'first_name' => 'Trabajador',
            'last_name' => 'Prueba UWB',
            'document_number' => 'TEST-UWB-001',
            'phone' => '3000000000',
            'is_active' => true,
        ]);

        // Zona de prueba
        $zone = Zone::create([
            'name' => 'Zona de Prueba UWB',
            'position_x' => 0.000,
            'position_y' => 0.000,
            'position_z' => 0.000,
            'radius_meters' => 20,
        ]);

        // Tag UWB asignado al trabajador
        $tag = UwbTag::create([
            'worker_id' => $worker->id,
            'device_id' => 'TAG-TEST-001',
            'name' => 'Tag UWB Trabajador Prueba',
            'status' => 'active',
            'battery_level' => 95,
            'last_seen_at' => now(),
        ]);

        // Anchor UWB 1
        UwbAnchor::create([
            'zone_id' => $zone->id,
            'device_id' => 'ANCHOR-TEST-001',
            'name' => 'Anchor UWB Prueba 1',
            'position_x' => 0.000,
            'position_y' => 0.000,
            'position_z' => 2.500,
            'status' => 'active',
            'last_seen_at' => now(),
        ]);

        // Anchor UWB 2
        UwbAnchor::create([
            'zone_id' => $zone->id,
            'device_id' => 'ANCHOR-TEST-002',
            'name' => 'Anchor UWB Prueba 2',
            'position_x' => 10.000,
            'position_y' => 0.000,
            'position_z' => 2.500,
            'status' => 'active',
            'last_seen_at' => now(),
        ]);

        // Posición UWB calculada de prueba
        UwbPosition::create([
            'worker_id' => $worker->id,
            'uwb_tag_id' => $tag->id,
            'zone_id' => $zone->id,
            'position_x' => 4.500,
            'position_y' => 2.000,
            'position_z' => 1.500,
            'accuracy' => 0.300,
            'position_method' => 'uwb',
            'recorded_at' => now(),
        ]);
    }
}
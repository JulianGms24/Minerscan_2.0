<?php

namespace Tests\Feature;

use App\Models\UwbAnchor;
use App\Models\UwbPosition;
use App\Models\UwbTag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UwbModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_uwb_tables_exist(): void
    {
        $this->assertDatabaseCount('uwb_tags', 0);
        $this->assertDatabaseCount('uwb_anchors', 0);
        $this->assertDatabaseCount('uwb_positions', 0);
    }

    public function test_uwb_models_can_be_instantiated(): void
    {
        $tag = new UwbTag();
        $anchor = new UwbAnchor();
        $position = new UwbPosition();

        $this->assertInstanceOf(UwbTag::class, $tag);
        $this->assertInstanceOf(UwbAnchor::class, $anchor);
        $this->assertInstanceOf(UwbPosition::class, $position);
    }
}
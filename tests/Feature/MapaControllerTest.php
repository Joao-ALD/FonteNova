<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * A basic test to check if the map page returns a successful response.
     *
     * @return void
     */
    public function test_map_page_is_accessible()
    {
        $response = $this->get('/mapa');

        $response->assertStatus(200);
    }

    /**
     * A basic test to check if the state info endpoint returns a successful response and valid JSON.
     *
     * @return void
     */
    public function test_get_estado_info_returns_valid_json()
    {
        $response = $this->get('/mapa/info/SP');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'nome',
                     'iniciativas'
                 ]);
    }
}

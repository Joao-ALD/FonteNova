<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Estado;
use App\Models\Iniciativa;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function it_can_list_all_estados()
    {
        $response = $this->getJson('/api/estados');

        $response->assertStatus(200)
                 ->assertJsonCount(27, 'data');
    }

    /** @test */
    public function it_can_get_a_specific_estado()
    {
        $response = $this->getJson('/api/estados/SP');

        $response->assertStatus(200)
                 ->assertJsonFragment(['sigla' => 'SP']);
    }

    /** @test */
    public function it_can_list_iniciativas_for_a_specific_estado()
    {
        $estado = Estado::where('sigla', 'SP')->first();
        $expectedCount = Iniciativa::where('estado_id', $estado->id)->count();

        $response = $this->getJson('/api/estados/SP/iniciativas');

        $response->assertStatus(200)
                 ->assertJsonCount($expectedCount, 'data');
    }

    /** @test */
    public function it_can_filter_iniciativas_by_tipo_for_a_specific_estado()
    {
        $estado = Estado::where('sigla', 'SP')->first();
        Iniciativa::factory()->create(['estado_id' => $estado->id, 'tipo' => 'água']);

        $response = $this->getJson('/api/estados/SP/iniciativas?tipo=água');

        $response->assertStatus(200)
                 ->assertJsonFragment(['tipo' => 'água']);
    }

    /** @test */
    public function it_can_get_statistics()
    {
        $response = $this->getJson('/api/estatisticas');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'total_iniciativas',
                     'investimento_total',
                     'por_regiao',
                     'por_tipo',
                     'por_status',
                 ]);
    }
}

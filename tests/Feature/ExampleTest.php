<?php

namespace Tests\Feature;

// 1. Linha 5 "descomentada"
use Illuminate\Foundation\Testing\RefreshDatabase; 
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // 2. Linha 9 adicionada
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizzTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_quizz_page_is_accessible()
    {
        $response = $this->get('/quizz');

        $response->assertStatus(200);
    }
}

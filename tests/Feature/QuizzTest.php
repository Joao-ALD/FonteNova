<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class QuizzTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that quizz page requires authentication.
     *
     * @return void
     */
    public function test_quizz_page_requires_authentication()
    {
        $response = $this->get('/quizz');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated user can access quizz page.
     *
     * @return void
     */
    public function test_authenticated_user_can_access_quizz()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/quizz');

        $response->assertStatus(200);
    }
}

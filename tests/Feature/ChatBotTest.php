<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Topico;

class ChatBotTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se o chatbot responde corretamente a uma palavra-chave no plural.
     *
     * @return void
     */
    public function test_chatbot_responds_to_plural_keyword()
    {
        // Cria um tópico com uma palavra-chave no singular
        Topico::create([
            'titulo' => 'Reutilização da Água da Chuva',
            'palavras_chave' => 'chuva,agua da chuva,reutilizar,cisterna,captacao,armazenar',
            'resumo' => 'Aprenda como coletar, armazenar e reutilizar água da chuva para fins domésticos.',
            'link_site' => '/reutilizacao-agua-chuva',
            'link_premium' => '/premium/reutilizacao-agua'
        ]);

        // Envia uma mensagem com a palavra-chave no plural
        $response = $this->postJson('/chatbot/responder', ['mensagem' => 'Como posso reutilizar a água das chuvas?']);

        // Verifica se a resposta foi bem-sucedida e contém o título do tópico esperado
        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         'titulo' => 'Reutilização da Água da Chuva'
                     ]
                 ]);
    }
}

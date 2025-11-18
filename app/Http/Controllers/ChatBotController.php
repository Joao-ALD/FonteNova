<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topico;

/**
 * ChatBotController
 *
 * Controlador responsável por exibir a interface do ChatBot e processar
 * requisições de resposta (POST). A lógica aqui faz uma busca simples por
 * palavras-chave nos tópicos cadastrados e devolve uma resposta JSON com
 * campos padronizados para o front-end consumir.
 *
 * Observações importantes:
 * - Este projeto é colaborativo: links retornados (link_site, link_premium)
 *   podem apontar para rotas que não estão totalmente implementadas por
 *   outros membros. O front-end trata esses valores como opcionais.
 * - A normalização de texto tenta remover acentuação e caracteres especiais
 *   para melhorar o matching por palavras-chave.
 */
class ChatBotController extends Controller
{
    /**
     * Exibe a view do ChatBot.
     *
     * Retorna a página onde o usuário pode digitar uma pergunta ou escolher
     * sugestões pré-definidas. A view realiza requisições AJAX para o método
     * responder() para obter a resposta.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('chatbot');
    }

    /**
     * Processa a requisição AJAX de resposta ao usuário.
     *
     * Valida a entrada, normaliza a mensagem e executa uma busca simples por
     * palavras-chave nos tópicos. Retorna JSON com os campos:
     * - success (bool)
     * - status  (int HTTP)
     * - data    (array) -> título, resumo, link_site, link_premium
     * - message (string) em caso de erro
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function responder(Request $request)
    {
        // Validação via $request->validate para aproveitar mensagens padrão e segurança
        $data = $request->validate([
            'mensagem' => 'required|string|max:500'
        ]);

        try {
            // Normaliza a mensagem (remove acentos e deixa em minúsculas)
            $mensagem = self::normalizarTexto($data['mensagem']);

            // Recupera todos os tópicos do banco (poderíamos paginar/filtrar em cenários maiores)
            $topicos = Topico::all();

            $topicoMaisRelevante = null;
            $maiorPontuacao = 0;

            foreach ($topicos as $topico) {
                $pontuacao = 0;

                // Normaliza as palavras-chave e divide por vírgula
                $keywords = array_filter(array_map('trim', explode(',', self::normalizarTexto($topico->palavras_chave))));

                foreach ($keywords as $kw) {
                    // Busca pela palavra exata ou sua forma plural (adicionando 's')
                    if ($kw !== '') {
                        // Expressão regular para encontrar a palavra exata ou com 's' no final
                        $pattern = '/\b' . preg_quote($kw, '/') . '(s)?\b/i';
                        if (preg_match($pattern, $mensagem)) {
                            $pontuacao++;
                        }
                    }
                }

                if ($pontuacao > $maiorPontuacao) {
                    $maiorPontuacao = $pontuacao;
                    $topicoMaisRelevante = $topico;
                }
            }

            if ($topicoMaisRelevante) {
                // Retorna dados padronizados para o front-end
                return response()->json([
                    'success' => true,
                    'status' => 200,
                    'data' => [
                        'titulo' => $topicoMaisRelevante->titulo,
                        'resumo' => $topicoMaisRelevante->resumo,
                        'link_site' => $topicoMaisRelevante->link_site,
                        'link_premium' => $topicoMaisRelevante->link_premium,
                    ]
                ], 200);
            }

            // Resposta padrão quando nada for encontrado
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => [
                    'titulo' => 'Tópico não encontrado',
                    'resumo' => "Não encontrei nada sobre isso ainda. Que tal explorar nossa galeria ou conhecer mais sobre água?",
                    'link_site' => '/infoAgua#collapseClima',
                    'link_premium' => '/galeria',
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retorna mensagem de validação padronizada
            return response()->json([
                'success' => false,
                'status' => 422,
                'message' => 'Entrada inválida.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log da exceção pode ser adicionado se desejado (ex: Log::error($e))
            return response()->json([
                'success' => false,
                'status' => 500,
                'message' => 'Erro interno. Tente novamente mais tarde.'
            ], 500);
        }
    }

    /**
     * Normaliza texto para comparação:
     * - Converte para minúsculas
     * - Remove acentuação (usa iconv quando disponível)
     * - Remove caracteres repetidos e espaços extras
     *
     * @param string $texto
     * @return string
     */
    private static function normalizarTexto($texto)
    {
        if (!is_string($texto)) {
            return '';
        }

        // Converte para minúsculas
        $texto = mb_strtolower($texto, 'UTF-8');

        // Tenta remover acentos com iconv quando disponível
        if (function_exists('iconv')) {
            $removido = @iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
            if ($removido !== false) {
                $texto = $removido;
            }
        }

        // Substituições manuais como fallback
        $texto = preg_replace('/[áàãâäÁÀÃÂÄ]/u','a',$texto);
        $texto = preg_replace('/[éèêëÉÈÊË]/u','e',$texto);
        $texto = preg_replace('/[íìîïÍÌÎÏ]/u','i',$texto);
        $texto = preg_replace('/[óòõôöÓÒÕÔÖ]/u','o',$texto);
        $texto = preg_replace('/[úùûüÚÙÛÜ]/u','u',$texto);
        $texto = preg_replace('/[çÇ]/u','c',$texto);

        // Remove tudo que não seja letra/número/espaco/virgula para simplificar busca
        $texto = preg_replace('/[^a-z0-9\s,]/i', ' ', $texto);

        // Normaliza espaços múltiplos
        $texto = preg_replace('/\s+/', ' ', $texto);

        return trim($texto);
    }
}
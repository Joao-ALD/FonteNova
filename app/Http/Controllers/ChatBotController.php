<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topico;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

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
                    // Busca por palavra inteira na mensagem normalizada
                    if ($kw !== '' && preg_match('/\b' . preg_quote($kw, '/') . '\b/i', $mensagem)) {
                        $pontuacao++;
                    }
                }

                if ($pontuacao > $maiorPontuacao) {
                    $maiorPontuacao = $pontuacao;
                    $topicoMaisRelevante = $topico;
                }
            }

            if ($topicoMaisRelevante) {
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
                    'resumo' => "Não encontrei nada sobre isso ainda. Que tal explorar nossa galeria?",
                    'link_site' => '/infoAgua',
                    'link_premium' => null,
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
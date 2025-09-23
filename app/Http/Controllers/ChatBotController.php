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
        // Validação manual com resposta JSON personalizada
        $validated = validator($request->all(), [
            'mensagem' => 'required|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'resumo' => 'Mensagem inválida. Por favor, digite algo válido.',
                'link_site' => '/infoAgua',
                'link_premium' => null,
                'titulo' => 'Erro de Validação'
            ], 422);
        }

        // Normaliza a mensagem (remove acentos e deixa em minúsculas)
        $mensagem = $this->normalizarTexto($request->input('mensagem'));

        // Recupera todos os tópicos do banco
        $topicos = Topico::all();

        $topicoMaisRelevante = null;
        $maiorPontuacao = 0;

        foreach ($topicos as $topico) {
            $pontuacao = 0;

            // Normaliza as palavras-chave
            $keywords = array_map('trim', explode(',', $this->normalizarTexto($topico->palavras_chave)));

            foreach ($keywords as $kw) {
                // Busca por palavra inteira
                if (preg_match('/\b' . preg_quote($kw, '/') . '\b/i', $mensagem)) {
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
                'resumo' => $topicoMaisRelevante->resumo,
                'link_site' => $topicoMaisRelevante->link_site,
                'link_premium' => $topicoMaisRelevante->link_premium,
                'titulo' => $topicoMaisRelevante->titulo
            ]);
        }

        // Resposta padrão
        return response()->json([
            'resumo' => "Não encontrei nada sobre isso ainda. Que tal explorar nossa galeria?",
            'link_site' => '/infoAgua',
            'link_premium' => null,
            'titulo' => 'Tópico não encontrado'
        ]);
    }

    /**
     * Função utilitária para normalizar texto: remove acentos e converte para minúsculas
     */
    private function normalizarTexto($texto)
    {
        $texto = strtolower($texto);
        $texto = preg_replace('/[áàãâä]/u','a',$texto);
        $texto = preg_replace('/[éèêë]/u','e',$texto);
        $texto = preg_replace('/[íìîï]/u','i',$texto);
        $texto = preg_replace('/[óòõôö]/u','o',$texto);
        $texto = preg_replace('/[úùûü]/u','u',$texto);
        $texto = preg_replace('/[ç]/u','c',$texto);
        return $texto;
    }
}
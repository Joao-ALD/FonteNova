<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topico;
use Illuminate\Support\Str;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function responder(Request $request)
    {
        // Validação simples da entrada
        $request->validate([
            'mensagem' => 'required|string|max:255'
        ]);

        // Normaliza a mensagem (remove acentos e deixa em minúsculas)
        $mensagem = $this->normalizarTexto($request->input('mensagem'));

        // Recupera todos os tópicos do banco
        $topicos = Topico::all();

        $topicoMaisRelevante = null;
        $maiorPontuacao = 0;

        foreach ($topicos as $topico) {
            $pontuacao = 0;

            // Normaliza as palavras-chave também
            $keywords = explode(',', $this->normalizarTexto($topico->palavras_chave));

            foreach ($keywords as $kw) {
                $kw = trim($kw);
                
                // Verifica se a palavra-chave está presente na mensagem (busca por palavra inteira)
                if (preg_match('/\b' . preg_quote($kw, '/') . '\b/i', $mensagem)) {
                    $pontuacao++;
                }
            }

            // Guarda o tópico com maior número de palavras-chave encontradas
            if ($pontuacao > $maiorPontuacao) {
                $maiorPontuacao = $pontuacao;
                $topicoMaisRelevante = $topico;
            }
        }

        // Se encontrou algum tópico relevante
        if ($topicoMaisRelevante) {
            return response()->json([
                'resumo' => $topicoMaisRelevante->resumo,
                'link_site' => $topicoMaisRelevante->link_site,
                'link_premium' => $topicoMaisRelevante->link_premium,
                'titulo' => $topicoMaisRelevante->titulo // opcional, pode ser útil no frontend
            ]);
        }

        // Resposta padrão se nada foi encontrado
        return response()->json([
            'resumo' => "Não encontrei nada sobre isso ainda. Que tal explorar nossa galeria?",
            'link_site' => '/infoAgua',
            'link_premium' => null
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

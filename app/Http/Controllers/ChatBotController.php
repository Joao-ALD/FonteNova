<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topico;

class ChatBotController extends Controller
{
    public function index(){
        return view('chatbot');
    }
    
    public function responder(Request $request)
    {
        $mensagem = strtolower($request->input('mensagem'));

         //Buscar todos tópicos
        $topicos = Topico::all();

        foreach ($topicos as $topico) {
            $keywords = explode(',', strtolower($topico->palavras_chave));

            foreach ($keywords as $kw) {
                if (strpos($mensagem, trim($kw)) !== false) {
                    return response()->json([
                        'resumo' => $topico->resumo,
                        'link_site' => $topico->link_site,
                        'link_premium' => $topico->link_premium
                    ]);
                }
            }
        }

        return response()->json([
            'resumo' => "Não encontrei nada sobre isso ainda. Que tal explorar nossa galeria?",
            'link_site' => '/infoAgua',
            'link_premium' => null
        ]);
    }
}
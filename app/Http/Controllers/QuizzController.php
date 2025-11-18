<?php

namespace App\Http\Controllers;
use App\Models\PerguntaQuiz;
use Illuminate\Http\Request;

/**
 * Controller for handling the quiz page.
 */
class QuizzController extends Controller
{
    /**
     * Display the quiz page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Busca todas as perguntas, ordenadas pela coluna 'ordem'
        $perguntas = PerguntaQuiz::orderBy('ordem', 'asc')->get();

        // 2. Passa as perguntas para a View
        return view('quizz', ['perguntas' => $perguntas]);
    }

    public function create()
    {
        return view('admin.quizz.create');
    }

    // 5. Salva a nova pergunta no banco de dados (Store Logic)
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'pergunta' => 'required|string|max:500',
            'opcao_a' => 'required|string|max:255',
            'opcao_b' => 'required|string|max:255',
            'opcao_c' => 'required|string|max:255',
            'resposta_correta' => 'required|in:a,b,c',
            'litros_economizados' => 'required|integer|min:0',
            'ordem' => 'required|integer|min:1|unique:pergunta_quiz,ordem', // Adicionando unique para a ordem
        ], [
            'ordem.unique' => 'O número de ordem já está em uso. Escolha um número que ainda não exista.'
        ]);

        // Cria a nova pergunta no banco de dados
        PerguntaQuiz::create($request->all());

        // Redireciona para a lista com mensagem de sucesso
        return redirect()->route('admin.quizz.index')->with('success', 'Nova pergunta do Quizz criada com sucesso!');
    }
}

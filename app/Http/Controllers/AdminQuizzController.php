<?php

namespace App\Http\Controllers;

use App\Models\PerguntaQuiz;
use Illuminate\Http\Request;

class AdminQuizzController extends Controller
{


    // Garante que só admins acessem se você não usou middleware na rota
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $perguntas = PerguntaQuiz::orderBy('ordem', 'asc')->get();
        return view('admin.quizz.index', compact('perguntas'));
    }

    public function create()
    {
        return view('admin.quizz.create');
    }

    public function edit(PerguntaQuiz $pergunta)
    {
        return view('admin.quizz.edit', compact('pergunta'));
    }

    public function update(Request $request, PerguntaQuiz $pergunta)
    {
        $request->validate([
            'pergunta' => 'required|string|max:500',
            'opcao_a' => 'required|string|max:255',
            'opcao_b' => 'required|string|max:255',
            'opcao_c' => 'required|string|max:255',
            'resposta_correta' => 'required|in:a,b,c',
            'litros_economizados' => 'required|integer|min:0',
            'ordem' => 'required|integer|min:1',
        ]);

        $pergunta->update($request->all());

        return redirect()->route('admin.quizz.index')->with('success', 'Pergunta atualizada com sucesso!');
    }

    public function destroy(PerguntaQuiz $pergunta)
    {

        $pergunta->delete();

        return redirect()->route('admin.quizz.index')->with('success', 'Pergunta excluída com sucesso.');
    }



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
            // Garante que o número de ordem seja único
            'ordem' => 'required|integer|min:1|unique:pergunta_quiz,ordem',
        ], [
            'ordem.unique' => 'O número de ordem já está em uso. Escolha um número que ainda não exista.'
        ]);

        
        PerguntaQuiz::create($request->all());

        // Redireciona para a lista com mensagem de sucesso
        return redirect()->route('admin.quizz.index')->with('success', 'Nova pergunta do Quizz criada com sucesso!');
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Aula; // <-- Importe o Model
use Illuminate\Http\Request;

/**
 * Controller for handling the display of the course page.
 */
class CursoController extends Controller
{
    /**
     * Display the course page.
     *
     * @return \Illuminate\View\View
     */


    public function index()
    {
        // 1. Busca todas as aulas, ordenadas
        $aulas = Aula::orderBy('ordem', 'asc')->get();

        // 2. Retorna uma NOVA view (que vamos criar)
        return view('cursos.index', ['aulas' => $aulas]);
    }

    // O Laravel vai injetar a $aula automaticamente por causa do {aula} na rota
    public function mostrarAula(Aula $aula)
    {
        // 1. Pega todas as aulas, ordenadas (pela coluna 'ordem' que criamos)
        $aulas = Aula::orderBy('ordem', 'asc')->get();

        // 2. A $aula ativa já é injetada pelo Laravel ($aula)

        // 3. Lógica para achar anterior/próxima
        // Procuramos o "índice" da aula atual na coleção ordenada
        $currentIndex = $aulas->search(fn($item) => $item->id == $aula->id);

        // Pegamos o índice - 1 (anterior) e + 1 (próximo)
        $aulaAnterior = $aulas->get($currentIndex - 1);
        $proximaAula = $aulas->get($currentIndex + 1);

        // 4. Retorna a view com os dados
        return view('cursos.aula', [
            'aulas' => $aulas,
            'aulaAtiva' => $aula,
            'aulaAnterior' => $aulaAnterior,
            'proximaAula' => $proximaAula
        ]);
    }

    public function adminIndex()
    {
        $aulas = Aula::orderBy('ordem', 'asc')->get();
        return view('admin.cursos.index', ['aulas' => $aulas]);
    }

    // 2. Mostra o formulário com os dados da aula preenchidos
    public function edit($id)
    {
        $aula = Aula::findOrFail($id); // Busca a aula ou dá erro 404
        return view('admin.cursos.edit', ['aula' => $aula]);
    }

    // 3. Recebe os dados do formulário e atualiza no banco
    public function update(Request $request, $id)
    {
        // Validação simples para garantir que não venha vazio
        $request->validate([
            'titulo' => 'required|string|max:255',
            'video_embed_url' => 'required|string',
            'ordem' => 'required|integer',
            'descricao_html' => 'required', // Aceita texto longo
        ]);

        $aula = Aula::findOrFail($id);

        // Atualiza os dados usando o $fillable que você já configurou no Model
        $aula->update($request->all());

        // Redireciona de volta para a lista com uma mensagem de sucesso
        return redirect()->route('admin.cursos.index')->with('success', 'Aula atualizada com sucesso!');
    }
}
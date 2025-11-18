<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Exibe a biblioteca (Grid de Ebooks).
     */
    public function index()
    {
        // Busca todos os ebooks ordenados pelos mais recentes
        $ebooks = Ebook::orderBy('created_at', 'desc')->get();

        return view('ebooks.index', compact('ebooks'));
    }

    /**
     * Carrega o leitor do Ebook.
     */
    public function reader($id)
    {
        // Busca o ebook pelo ID.
        // O método 'with(\'pages\')' já traz as páginas junto (Eager Loading) para otimizar.
        // O 'findOrFail' mostra erro 404 automaticamente se o ID não existir.
        $ebook = Ebook::with('pages')->findOrFail($id);

        return view('ebooks.reader', compact('ebook'));
    }
}
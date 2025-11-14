<?php


namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    // lista todos os ebooks
    public function index()
    {
        $ebooks = Ebook::withCount('pages')->get();
        return view('ebooks.index', compact('ebooks'));
    }

    // mostra o leitor do ebook (primeira página por padrão)
    public function show($slug, Request $request)
    {
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        // pega a página solicitada (por query ?page=2) ou a 1
        $pageNumber = (int) $request->query('page', 1);
        $page = $ebook->pages()->where('page_number', $pageNumber)->firstOrFail();

        // se auth, pega progresso e se comprou
        $progress = null;
        if ($request->user()) {
            $progress = $request->user()->ebookProgress()->where('ebook_id', $ebook->id)->first();
        }
        return view('ebooks.show', compact('ebook','page','pageNumber','progress'));
    }
}


<?php

// app/Http/Controllers/EbookProgressController.php
namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\EbookProgress;
use Illuminate\Http\Request;

class EbookProgressController extends Controller
{
    // atualiza páginas lidas (via AJAX)
    public function update(Request $request, Ebook $ebook)
    {
        $user = $request->user();
        $page = (int)$request->input('page');

        $progress = EbookProgress::firstOrCreate(
            ['user_id' => $user->id, 'ebook_id' => $ebook->id],
            ['pages_read' => 0, 'purchased' => false]
        );

        // registra a maior página lida
        if ($page > $progress->pages_read) {
            $progress->pages_read = $page;
            $progress->save();
        }

        return response()->json(['ok' => true, 'pages_read' => $progress->pages_read]);
    }

    // rota simulada de compra — em produção, integrar gateway
    public function purchase(Request $request, Ebook $ebook)
    {
        $user = $request->user();
        $progress = EbookProgress::firstOrCreate(
            ['user_id' => $user->id, 'ebook_id' => $ebook->id]
        );

        // marca comprado
        $progress->purchased = true;
        $progress->save();

        // aqui você poderia criar order, gravar transação, gerar nota, etc.
        return response()->json(['ok' => true, 'message' => 'Compra simulada efetuada', 'purchased' => true]);
    }
}


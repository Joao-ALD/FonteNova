<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $ebook = \App\Models\Ebook::create([
        'title' => 'Como Construir um Coletor Avançado com Recicláveis',
        'slug' => 'coletor-reciclaveis',
        'summary' => 'Passo a passo para construir um coletor de água usando materiais recicláveis.',
        'is_paid' => true,
        'free_preview_pages' => 2,
    ]);

    $pages = [
        'Conteúdo da página 1 — introdução (livre).',
        'Conteúdo da página 2 — ferramentas necessárias (livre).',
        'Conteúdo da página 3 — montagem do reservatório (pago).',
        'Conteúdo da página 4 — filtragem e acabamento (pago).',
    ];

    foreach ($pages as $i => $text) {
        \App\Models\EbookPage::create([
            'ebook_id' => $ebook->id,
            'page_number' => $i+1,
            'content' => "<p>$text</p>"
        ]);
    }
}

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EbookSeeder extends Seeder
{
    public function run()
    {
        /**
         * EBOOK 1 — VOCÊ JÁ TINHA
         */
        $ebook1 = \App\Models\Ebook::create([
            'title' => 'Como Construir um Coletor Avançado com Recicláveis',
            'slug' => 'coletor-reciclaveis',
            'summary' => 'Passo a passo para construir um coletor de água usando materiais recicláveis.',
            'is_paid' => true,
            'free_preview_pages' => 2,
        ]);

        $pages1 = [
            'Conteúdo da página 1 — introdução (livre).',
            'Conteúdo da página 2 — ferramentas necessárias (livre).',
            'Conteúdo da página 3 — montagem do reservatório (pago).',
            'Conteúdo da página 4 — filtragem e acabamento (pago).',
        ];

        foreach ($pages1 as $i => $text) {
            \App\Models\EbookPage::create([
                'ebook_id' => $ebook1->id,
                'page_number' => $i + 1,
                'content' => "<p>$text</p>",
            ]);
        }




        /**
         * EBOOK 2
         */
        $ebook2 = \App\Models\Ebook::create([
            'title' => 'Guia Completo de Reutilização da Água da Chuva',
            'slug'  => 'reutilizacao-agua-chuva',
            'summary' => 'Aprenda como coletar, armazenar e usar água da chuva de forma segura.',
            'is_paid' => true,
            'free_preview_pages' => 2,
        ]);

        $pages2 = [
            'Página 1 — O que é reaproveitamento de água da chuva? (livre)',
            'Página 2 — Equipamentos básicos necessários (livre)',
            'Página 3 — Instalação correta de calhas e filtros (pago)',
            'Página 4 — Como manter o reservatório limpo (pago)',
        ];

        foreach ($pages2 as $i => $text) {
            \App\Models\EbookPage::create([
                'ebook_id' => $ebook2->id,
                'page_number' => $i + 1,
                'content' => "<p>$text</p>",
            ]);
        }




        /**
         * EBOOK 3
         */
        $ebook3 = \App\Models\Ebook::create([
            'title' => 'Dicas Práticas para Economizar Água em Casa',
            'slug'  => 'economizar-agua-casa',
            'summary' => 'Pequenas atitudes que reduzem o consumo e preservam o meio ambiente.',
            'is_paid' => true,
            'free_preview_pages' => 2,
        ]);

        $pages3 = [
            'Página 1 — Introdução: por que economizar água? (livre)',
            'Página 2 — Reduza desperdícios no banheiro e cozinha (livre)',
            'Página 3 — Instale dispositivos economizadores (pago)',
            'Página 4 — Reuso de água em tarefas domésticas (pago)',
        ];

        foreach ($pages3 as $i => $text) {
            \App\Models\EbookPage::create([
                'ebook_id' => $ebook3->id,
                'page_number' => $i + 1,
                'content' => "<p>$text</p>",
            ]);
        }




        /**
         * EBOOK 4
         */
        $ebook4 = \App\Models\Ebook::create([
            'title' => 'Sistemas de Irrigação Sustentável',
            'slug'  => 'irrigacao-sustentavel',
            'summary' => 'Como irrigar plantações e jardins usando menos água.',
            'is_paid' => true,
            'free_preview_pages' => 2,
        ]);

        $pages4 = [
            'Página 1 — O que é irrigação sustentável? (livre)',
            'Página 2 — Tipos de sistemas de baixo consumo (livre)',
            'Página 3 — Instalação do gotejamento inteligente (pago)',
            'Página 4 — Automação e sensores de umidade (pago)',
        ];

        foreach ($pages4 as $i => $text) {
            \App\Models\EbookPage::create([
                'ebook_id' => $ebook4->id,
                'page_number' => $i + 1,
                'content' => "<p>$text</p>",
            ]);
        }




        /**
         * EBOOK 5
         */
        $ebook5 = \App\Models\Ebook::create([
            'title' => 'Como Montar um Filtro Caseiro de Água',
            'slug'  => 'filtro-caseiro',
            'summary' => 'Aprenda passo a passo a montar um filtro prático usando materiais simples.',
            'is_paid' => true,
            'free_preview_pages' => 2,
        ]);

        $pages5 = [
            'Página 1 — Materiais básicos para o filtro (livre)',
            'Página 2 — Preparação do recipiente e camadas (livre)',
            'Página 3 — Testes de filtragem e correções (pago)',
            'Página 4 — Manutenção e limpeza do sistema (pago)',
        ];

        foreach ($pages5 as $i => $text) {
            \App\Models\EbookPage::create([
                'ebook_id' => $ebook5->id,
                'page_number' => $i + 1,
                'content' => "<p>$text</p>",
            ]);
        }




        /**
         * EBOOK 6
         */
        $ebook6 = \App\Models\Ebook::create([
            'title' => 'Manual do Uso Consciente da Água',
            'slug'  => 'uso-consciente-agua',
            'summary' => 'Guia educativo para escolas, comunidades e famílias.',
            'is_paid' => true,
            'free_preview_pages' => 2,
        ]);

        $pages6 = [
            'Página 1 — Entenda o ciclo da água (livre)',
            'Página 2 — De onde vem a água que consumimos? (livre)',
            'Página 3 — Impactos do desperdício no planeta (pago)',
            'Página 4 — Boas práticas para o dia a dia (pago)',
        ];

        foreach ($pages6 as $i => $text) {
            \App\Models\EbookPage::create([
                'ebook_id' => $ebook6->id,
                'page_number' => $i + 1,
                'content' => "<p>$text</p>",
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    /**
     * Gera uma capa SVG dinâmica e bonita para um ebook
     * 
     * @param int $id ID do ebook
     * @return \Illuminate\Http\Response SVG como imagem
     */
    public function generateCover($id)
    {
        $ebook = Ebook::findOrFail($id);

      // --- NOVO BLOCO: Tenta servir arquivo local primeiro ---
        // (Adicionei uma verificação se a propriedade existe para ajudar o editor)
        $coverPath = $ebook->cover_path ?? null;

        // Verifica se existe algo escrito no banco E se o arquivo físico existe na pasta 'public'
        if (!empty($coverPath) && file_exists(public_path($coverPath))) {
            // Se existir, entrega o arquivo da imagem e ENCERRA a função aqui.
            // (Removi os 'file:', 'path:' e 'headers:' para ficar no formato clássico)
            return response()->file(public_path($coverPath), [
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }
        // --- FIM DO NOVO BLOCO ---
        // --- FIM DO NOVO BLOCO ---                                                                   // FIM DO BLOCO ADICIONADO

        // Array de temas com gradientes bonitos
        $themes = [
            [
                'gradient1' => '#4a90e2',
                'gradient2' => '#357abd',
                'accent' => '#86c8f5',
                'icon' => '💧'
            ],
            [
                'gradient1' => '#2ecc71',
                'gradient2' => '#27ae60',
                'accent' => '#82e0aa',
                'icon' => '🌍'
            ],
            [
                'gradient1' => '#3498db',
                'gradient2' => '#2980b9',
                'accent' => '#5dade2',
                'icon' => '💚'
            ],
            [
                'gradient1' => '#1abc9c',
                'gradient2' => '#16a085',
                'accent' => '#48c9b0',
                'icon' => '🌱'
            ],
            [
                'gradient1' => '#9b59b6',
                'gradient2' => '#8e44ad',
                'accent' => '#bb8fce',
                'icon' => '🔮'
            ],
            [
                'gradient1' => '#e74c3c',
                'gradient2' => '#c0392b',
                'accent' => '#f1948a',
                'icon' => '🌊'
            ],
        ];

        // Seleciona um tema baseado no ID do ebook
        $theme = $themes[$id % count($themes)];

        // Trunca título para SVG
        $title = substr($ebook->title, 0, 35);
        $lines = str_split($title, 20);

        // Calcula posição Y para título (centralizado)
        $titleY = count($lines) === 1 ? 180 : 160;

        // SVG com design profissional
        $svg = <<<SVG
<?xml version="1.0" encoding="UTF-8"?>
<svg width="300" height="400" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:{$theme['gradient1']};stop-opacity:1" />
            <stop offset="100%" style="stop-color:{$theme['gradient2']};stop-opacity:1" />
        </linearGradient>
        <linearGradient id="grad2" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:{$theme['accent']};stop-opacity:0.3" />
            <stop offset="100%" style="stop-color:{$theme['accent']};stop-opacity:0" />
        </linearGradient>
        <filter id="shadow">
            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-opacity="0.3"/>
        </filter>
    </defs>
    
    <!-- Fundo com gradiente -->
    <rect width="300" height="400" fill="url(#grad1)"/>
    
    <!-- Padrão decorativo (ondas/linhas) -->
    <rect width="300" height="400" fill="url(#grad2)"/>
    
    <!-- Círculos decorativos -->
    <circle cx="250" cy="80" r="60" fill="{$theme['accent']}" opacity="0.2"/>
    <circle cx="50" cy="320" r="80" fill="{$theme['accent']}" opacity="0.15"/>
    
    <!-- Ícone emoji grande -->
    <text x="150" y="140" font-size="70" text-anchor="middle" fill="white" opacity="0.95" font-family="Arial, sans-serif">
        {$theme['icon']}
    </text>
    
    <!-- Título -->
    <text x="150" y="{$titleY}" font-size="18" font-weight="bold" text-anchor="middle" fill="white" font-family="Arial, sans-serif" style="word-wrap: break-word;">
SVG;

        // Adiciona linhas do título
        foreach ($lines as $index => $line) {
            $y = $titleY + ($index * 25);
            $svg .= "\n        <tspan x=\"150\" dy=\"" . ($index === 0 ? "0" : "1.2em") . "\">$line</tspan>";
        }

        $svg .= <<<SVG
    </text>
    
    <!-- Footer: "FonteNova" -->
    <text x="150" y="370" font-size="12" text-anchor="middle" fill="white" opacity="0.8" font-family="Arial, sans-serif">
        FonteNova - Educação Ambiental
    </text>
    
    <!-- Borda decorativa -->
    <rect x="0" y="0" width="300" height="400" fill="none" stroke="white" stroke-width="3" opacity="0.1"/>
</svg>
SVG;

        return response($svg)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
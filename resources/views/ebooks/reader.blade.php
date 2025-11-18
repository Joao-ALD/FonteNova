@extends('layouts.app')

@section('title', 'Leitor: ' . $ebook->title)

@section('content')

{{-- Links de CSS --}}
<link rel="stylesheet" href="{{ asset('css/ebooks.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

{{-- 
    Container principal que define o layout de tela cheia para leitura.
    O Ebook tem $ebook->pages, que é uma coleção ordenada (1 a 6).
--}}
<div class="reader-container">
    
    <!-- Cabeçalho Fixo do Leitor -->
    <header class="reader-header shadow-sm bg-light">
        <div class="container-fluid d-flex justify-content-between align-items-center py-3">
            <a href="{{ route('ebooks.index') }}" class="btn btn-outline-secondary btn-sm me-3" title="Voltar para a biblioteca">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
            <h1 class="h5 m-0 text-truncate text-center flex-grow-1" title="{{ $ebook->title }}">
                {{ $ebook->title }}
            </h1>
            <span class="page-indicator text-muted ms-3 small">Página <span id="current-page-num">1</span> de {{ $ebook->pages->count() }}</span>
        </div>
    </header>

    <!-- Área de Conteúdo do Livro -->
    <main class="reader-content-area py-5">
        <div class="container reader-page-content shadow-lg rounded p-4 p-md-5">
            
            {{-- Loop para renderizar todas as páginas (ocultas por padrão) --}}
            @foreach ($ebook->pages as $page)
                {{-- O atributo data-page-number é crucial para o JS --}}
                <div class="ebook-page" 
                     id="page-{{ $page->page_number }}" 
                     data-page-number="{{ $page->page_number }}"
                     style="display: none;">
                    
                    <h2 class="text-center text-primary mb-4 fw-bold">Página {{ $page->page_number }}</h2>
                    
                    {{-- Conteúdo (Renderiza HTML/Markdown, se for o caso) --}}
                    <div class="page-content-body">
                        {!! $page->content !!} {{-- Use {!! !!} para renderizar HTML/Markdown --}}
                    </div>
                </div>
            @endforeach
            
        </div>
    </main>

    <!-- Controles de Navegação (Rodapé Fixo) -->
    <footer class="reader-footer bg-white border-top shadow-sm py-2">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            
            <!-- Botão Anterior -->
            <button id="prev-btn" class="btn btn-custom mx-2" disabled>
                <i class="fas fa-chevron-left"></i> Anterior
            </button>

            <!-- Links Numerados (Paginação) -->
            <nav aria-label="Navegação de Página">
                <ul class="pagination pagination-sm m-0 d-none d-md-flex">
                    @for ($i = 1; $i <= $ebook->pages->count(); $i++)
                        <li class="page-item" id="nav-item-{{ $i }}">
                            <a class="page-link page-link-num" href="#" data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                </ul>
                <p class="d-md-none m-0 text-muted small">Use os botões ou as setas do teclado.</p>
            </nav>

            <!-- Botão Próxima -->
            <button id="next-btn" class="btn btn-custom mx-2">
                Próxima <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </footer>

</div>

{{-- Incluindo o JavaScript de Navegação --}}
<script>
    // Armazena todas as 6 páginas como objetos JS para o script.
    const EbookPages = @json($ebook->pages->pluck('page_number'));
    const TotalPages = EbookPages.length;
</script>
<script src="{{ asset('js/reader.js') }}"></script>
@endsection
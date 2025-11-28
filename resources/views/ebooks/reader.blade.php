@extends('layouts.main')

@section('title', 'Leitor: ' . $ebook->title)

@section('content')

    {{-- Links de CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/ebooks.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Container principal do leitor --}}
    <div class="reader-container" id="reader-container">

        <header class="reader-header">
            <div class="reader-header-content">
                <div class="reader-header-left">
                    <a href="{{ route('ebooks.index') }}" class="btn-header-back" title="Voltar para a biblioteca">
                        <span class="btn-text">Voltar</span>
                    </a>
                </div>

                <div class="reader-header-center">
                    <h1 class="reader-title">{{ $ebook->title }}</h1>
                </div>

                <div class="reader-header-right">
                    </div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </header>

        <main class="reader-main">
            <div class="reader-page-wrapper">

                {{-- Loop para renderizar todas as páginas --}}
                @foreach ($ebook->pages as $page)

                    <div class="ebook-page" id="page-{{ $page->page_number }}" data-page-number="{{ $page->page_number }}"
                        style="display: none;">

                        <div class="page-number-badge">
                            Página {{ $page->page_number }} / {{ $ebook->pages->count() }}
                        </div>

                        <article class="page-content">
                            <div class="page-content-body">
                                {!! $page->content !!}
                            </div>
                        </article>
                    </div>
                @endforeach

            </div>
        </main>

        <footer class="reader-footer">
            <div class="footer-content">
                <button id="prev-btn" class="btn-nav btn-nav-prev" disabled title="Página anterior (Seta esquerda)">
                    <i class="fas fa-chevron-left"></i>
                    <span class="btn-label">Anterior</span>
                </button>

                <div class="page-indicator">
                    <span style="margin-right: -19px;">Pág</span>
                    <span id="current-page-num" class="page-num">1</span>
                    <span class="page-divider">/</span>
                    <span class="page-total">{{ $ebook->pages->count() }}</span>
                </div>

                <div class="pagination-dots" id="pagination-dots">
                    @for ($i = 1; $i <= $ebook->pages->count(); $i++)
                        <button class="dot" data-page="{{ $i }}" title="Ir para página {{ $i }}" @if($i === 1) aria-current="page"
                        @endif>
                            {{ $i }}
                        </button>
                    @endfor
                </div>

                <button id="next-btn" class="btn-nav btn-nav-next" title="Próxima página (Seta direita)">
                    <span class="btn-label">Próxima</span>
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="footer-hint">
                Use as setas do teclado ou botões para navegar
            </div>
        </footer>

    </div>

    {{-- Scripts --}}
    <script>
        const TotalPages = Number("{{ $ebook->pages->count() }}") || 6;
    </script>
    <script src="{{ asset('js/ebook.js') }}"></script>
@endsection
@extends('layouts.main')

@section('content')

    {{-- Link para o CSS específico desta página --}}
    <link rel="stylesheet" href="{{ asset('assets/css/ebooks.css') }}">

    <section class="page-header text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">📚 Biblioteca de E-Books</h1>
            <p class="lead mb-0">Conhecimento sobre as águas e sustentabilidade ao seu alcance</p>
        </div>
    </section>

    <div class="container mb-5 mt-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

            @forelse($ebooks as $ebook)
                <div class="col">
                    {{-- position-relative é importante para o link esticado funcionar --}}
                    <div class="card ebook-card h-100 shadow-sm position-relative">
                        
                        {{-- Link da Imagem com stretched-link (faz o card todo ser clicável) --}}
                        <a href="{{ route('ebooks.reader', $ebook->id) }}" class="ebook-cover-link stretched-link">

                            {{-- LÓGICA SIMPLIFICADA E DIRETA --}}
                            @if($ebook->cover_path)
                                {{-- Opção 1: Tenta carregar a imagem direto do caminho do banco --}}
                                <img src="{{ asset($ebook->cover_path) }}" 
                                     class="card-img-top ebook-cover"
                                     alt="{{ $ebook->title }}" 
                                     loading="lazy">
                            @else
                                {{-- Opção 2: Se não tiver nada no banco, usa o SVG automático --}}
                                <img src="{{ route('ebooks.cover', $ebook->id) }}" 
                                     class="card-img-top ebook-cover"
                                     alt="{{ $ebook->title }}" 
                                     loading="lazy">
                            @endif

                            {{-- Overlay "Ler" (Aparece ao passar o mouse) --}}
                            <div class="cover-overlay">
                                <span class="overlay-text">Ler</span>
                            </div>
                        </a>

                        {{-- PARTE DO TEXTO (Título, Descrição e Botão) --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark fw-bold">
                                {{ $ebook->title }}
                            </h5>
                            
                            <p class="card-text small text-muted flex-grow-1">
                                {{ Str::limit($ebook->short_description, 80) }}
                            </p>

                            <div class="mt-auto">
                                {{-- z-2 e position-relative garantem que o botão fique clicável acima do stretched-link --}}
                                <a href="{{ route('ebooks.reader', $ebook->id) }}" 
                                   class="btn btn-custom w-100 shadow-sm position-relative z-2">
                                    <i class="fas fa-book-open" aria-hidden="true"></i> Ler E-book
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light shadow-sm" role="alert">
                        <h4 class="alert-heading text-muted">📖 Biblioteca Vazia</h4>
                        <p>Novos conteúdos sobre educação ambiental serão adicionados em breve.</p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>

@endsection
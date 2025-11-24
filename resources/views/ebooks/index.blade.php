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
                <div class="card ebook-card h-100 shadow-sm">
                    <a href="{{ route('ebooks.reader', $ebook->id) }}" class="ebook-cover-link">
                        <img src="{{ route('ebooks.cover', $ebook->id) }}" 
                             class="card-img-top ebook-cover" 
                             alt="{{ $ebook->title }}"
                             loading="lazy">
                        <div class="cover-overlay">
                            <span class="overlay-text">Ler</span>
                        </div>
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark fw-bold" style="font-size: 1rem;">
                            {{ $ebook->title }}
                        </h5>
                        
                        <p class="card-text small text-muted flex-grow-1">
                            {{ Str::limit($ebook->short_description, 80) }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('ebooks.reader', $ebook->id) }}" 
                               class="btn btn-custom w-100 shadow-sm">
                                <i class="fas fa-book-open"></i> Ler E-book
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
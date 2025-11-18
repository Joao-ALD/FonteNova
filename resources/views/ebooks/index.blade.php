@extends('layouts.app')

@section('content')

{{-- Link para o CSS específico desta página --}}
<link rel="stylesheet" href="{{ asset('css/ebooks.css') }}">

<section class="page-header text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Biblioteca de E-Books</h1>
        <p class="lead mb-0">Conhecimento sobre as águas e sustentabilidade.</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        
        @forelse($ebooks as $ebook)
            <div class="col">
                <div class="card ebook-card h-100">
                    <a href="{{ route('ebooks.reader', $ebook->id) }}">
                        <img src="{{ $ebook->cover_path ?? 'https://placehold.co/300x400?text=Capa' }}" 
                             class="card-img-top ebook-cover" 
                             alt="{{ $ebook->title }}">
                    </a>

                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title text-dark fw-bold" style="font-size: 1.1rem;">
                            {{ $ebook->title }}
                        </h5>
                        
                        <p class="card-text small text-muted flex-grow-1">
                            {{ Str::limit($ebook->short_description, 50) }}
                        </p>

                        <a href="{{ route('ebooks.reader', $ebook->id) }}" 
                           class="btn btn-custom w-100 mt-2 shadow-sm">
                            Ler E-book
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-light shadow-sm" role="alert">
                    <h4 class="alert-heading text-muted">Biblioteca Vazia</h4>
                    <p>Novos conteúdos sobre educação ambiental serão adicionados em breve.</p>
                </div>
            </div>
        @endforelse

    </div>
</div>

@endsection
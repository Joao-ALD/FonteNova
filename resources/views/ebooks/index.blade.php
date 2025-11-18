@extends('layouts.main')

@section('title', 'Biblioteca de E-Books')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Biblioteca de E-Books</h1>
        <p class="text-muted">Explore nossa coleção e comece a ler agora.</p>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
        
        @forelse($ebooks as $ebook)
            <div class="col">
                <div class="card ebook-card h-100 shadow-sm">
                    <a href="{{ route('ebooks.reader', $ebook->id) }}">
                        <img src="{{ $ebook->cover_path ?? 'https://placehold.co/300x400?text=Capa' }}" 
                             class="card-img-top ebook-cover" 
                             alt="{{ $ebook->title }}">
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $ebook->title }}">
                            {{ $ebook->title }}
                        </h5>
                        
                        <p class="card-text small text-muted flex-grow-1">
                            {{ Str::limit($ebook->short_description, 60) }}
                        </p>

                        <a href="{{ route('ebooks.reader', $ebook->id) }}" 
                           class="btn btn-primary w-100 mt-3">
                            Ler agora
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Nenhum e-book disponível no momento.</p>
            </div>
        @endforelse

    </div>
</div>
@endsection
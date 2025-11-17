@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Título e resumo -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold">{{ $ebook->title }}</h1>
            <p class="text-muted">{{ $ebook->summary }}</p>
        </div>

        <div class="col-md-4 text-end">
            @if(!$isUnlocked)
                <form method="POST" action="{{ route('ebooks.purchase', $ebook->id) }}">
                    @csrf
                    <button class="btn btn-primary btn-lg shadow-sm">
                        🔓 Desbloquear eBook Completo
                    </button>
                </form>
            @else
                <span class="badge bg-success p-2">✔️ eBook desbloqueado</span>
            @endif
        </div>
    </div>

    <div class="row">

        <!-- Sidebar com lista de páginas -->
        <div class="col-md-3">
            <div class="list-group shadow-sm rounded-3">

                @foreach ($ebook->pages as $page)
                    @php
                        $locked = !$isUnlocked && $page->page_number > $ebook->free_preview_pages;
                    @endphp

                    <a href="{{ !$locked ? route('ebooks.show', [$ebook->slug, 'page' => $page->page_number]) : '#' }}"
                       class="list-group-item list-group-item-action d-flex justify-content-between 
                       {{ request('page', 1) == $page->page_number ? 'active' : '' }}
                       {{ $locked ? 'disabled' : '' }}">

                        Página {{ $page->page_number }}

                        @if($locked)
                            <span>🔒</span>
                        @endif
                    </a>
                @endforeach

            </div>
        </div>

        <!-- Área de leitura -->
        <div class="col-md-9">
            <div class="card shadow-lg border-0 reader-area">
                <div class="card-body p-4" style="min-height: 500px; font-size: 1.1rem; line-height: 1.8;">
                    
                    @if($lockedPage ?? false)
                        <div class="text-center py-5">
                            <h2 class="fw-bold mb-3">Página Bloqueada 🔒</h2>
                            <p class="text-muted mb-4">Desbloqueie para continuar a leitura completa.</p>

                            <form method="POST" action="{{ route('ebooks.purchase', $ebook->id) }}">
                                @csrf
                                <button class="btn btn-primary btn-lg shadow-sm">
                                    🔓 Desbloquear Agora
                                </button>
                            </form>
                        </div>
                    @else
                        {!! $currentPage->content !!}
                    @endif

                </div>
            </div>

            <!-- Navegação inferior -->
            <div class="d-flex justify-content-between mt-3">
                @if($prevPage)
                    <a class="btn btn-outline-primary" 
                       href="{{ route('ebooks.show', [$ebook->slug, 'page' => $prevPage]) }}">
                        ⬅️ Página Anterior
                    </a>
                @else
                    <span></span>
                @endif

                @if($nextPage && !($lockedNext ?? false))
                    <a class="btn btn-outline-primary"
                       href="{{ route('ebooks.show', [$ebook->slug, 'page' => $nextPage]) }}">
                        Próxima Página ➡️
                    </a>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

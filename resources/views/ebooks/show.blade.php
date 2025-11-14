@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Coluna da lista de páginas -->
        <div class="col-md-3">
            <h4>{{ $ebook->title }}</h4>
            <ul class="list-group">
                @foreach($ebook->pages as $p)
                    <li class="list-group-item {{ $p->page_number == $pageNumber ? 'active' : '' }}">
                        <a href="{{ route('ebooks.show', $ebook->slug) }}?page={{ $p->page_number }}"
                           class="{{ $p->page_number == $pageNumber ? 'text-white' : '' }}">
                           Página {{ $p->page_number }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Coluna do conteúdo -->
        <div class="col-md-9">
            <h2>Página {{ $page->page_number }}</h2>

            <div id="ebook-content" class="card p-4 mb-3">
                {!! $page->content !!} {{-- conteúdo em HTML --}}
            </div>

            <div class="d-flex justify-content-between">
                <!-- Próxima / anterior -->
                <div>
                    @if($pageNumber > 1)
                        <a href="{{ route('ebooks.show', $ebook->slug) }}?page={{ $pageNumber-1 }}" class="btn btn-outline-secondary">Anterior</a>
                    @endif
                </div>

                <div>
                    @php
                        // verifica se usuário tem acesso total
                        $hasAccess = false;
                        if(auth()->check()){
                            $progress = auth()->user()->ebookProgress()->where('ebook_id',$ebook->id)->first();
                            $hasAccess = $progress && ($progress->purchased || $progress->pages_read >= $ebook->pages()->count());
                        }
                    @endphp

                    {{-- Se é ebook pago e usuário não comprou e página > free_preview, bloqueia --}}
                    @if($ebook->is_paid && auth()->check() && !$hasAccess && $pageNumber > $ebook->free_preview_pages)
                        <button id="buyBtn" class="btn btn-primary">Comprar E-book (desbloquear)</button>
                    @else
                        @if($pageNumber < $ebook->pages()->count())
                            <a href="{{ route('ebooks.show', $ebook->slug) }}?page={{ $pageNumber+1 }}" class="btn btn-primary">Próxima Página →</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS para atualizar progresso via AJAX quando página carregada --}}
@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    // manda requisição para atualizar progresso com a página atual
    fetch("{{ route('ebooks.progress.update', $ebook->id) }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ page: {{ $pageNumber }} })
    }).then(res => res.json()).then(data => {
        console.log('Progresso atualizado', data);
    });

    // trata clique em comprar (simulação)
    const buyBtn = document.getElementById('buyBtn');
    if (buyBtn) {
        buyBtn.addEventListener('click', function() {
            buyBtn.disabled = true;
            buyBtn.innerText = 'Processando...';

            fetch("{{ route('ebooks.purchase', $ebook->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({})
            }).then(r => r.json()).then(resp => {
                if (resp.ok) {
                    location.reload(); // recarrega e libera acesso
                } else {
                    alert('Erro ao comprar');
                    buyBtn.disabled = false;
                    buyBtn.innerText = 'Comprar E-book (desbloquear)';
                }
            });
        });
    }
});
</script>
@endauth
@endsection

@extends('layouts.main') {{-- Ou o seu layout principal --}}

@section('content')

<div class="container mt-5 mb-5">
    <div class="row">

        <div class="col-md-4">
            <h3 class="mb-3">Módulos do Curso</h3>
            <div class="list-group" id="aulas-list">
                
                {{-- Loop para listar TODAS as aulas --}}
                @foreach($aulas as $aula)
                    <a href="{{ route('curso.aula', $aula->id) }}" 
                       class="list-group-item list-group-item-action 
                              {{-- Adiciona a classe 'active' se o ID for o mesmo da aula ativa --}}
                              @if($aula->id == $aulaAtiva->id) active @endif" 
                       aria-current="{{ $aula->id == $aulaAtiva->id ? 'true' : 'false' }}">
                        
                        {{ $aula->titulo }} {{-- Mostra o título da aula --}}
                    </a>
                @endforeach
                
            </div>
        </div>

        <div class="col-md-8">
            
            <h2 class="mb-3">{{ $aulaAtiva->titulo }}</h2>

            <div class="ratio ratio-16x9 mb-4">
                <iframe 
                    src="{{ $aulaAtiva->video_embed_url }}" {{-- URL do embed vindo do DB --}}
                    title="{{ $aulaAtiva->titulo }}" 
                    allowfullscreen>
                </iframe>
            </div>

            <h4>Sobre esta aula</h4>
            
            {{-- 
              Usamos {!! !!} para renderizar HTML salvo no banco de dados 
              (por exemplo, de um editor de texto rico como CKEditor ou TinyMCE).
              CUIDADO: Use isso apenas se confiar na fonte do HTML (para evitar XSS).
            --}}
            <div class="aula-descricao">
                {!! $aulaAtiva->descricao_html !!} 
            </div>

            <hr class="my-4">
            <div class="d-flex justify-content-between">
                
                {{-- Botão "Anterior" só aparece se $aulaAnterior existir --}}
                @if($aulaAnterior)
                    <a href="{{ route('curso.aula', $aulaAnterior->id) }}" class="btn btn-outline-secondary">
                        &larr; Aula Anterior
                    </a>
                @else
                    <span></span> 
                @endif

                {{-- Botão "Próximo" só aparece se $proximaAula existir --}}
                @if($proximaAula)
                    <a href="{{ route('curso.aula', $proximaAula->id) }}" class="btn btn-primary" id="btn-proximo">
                        Próxima Aula &rarr;
                    </a>
                @endif
                
            </div>
        </div>

    </div>
</div>

@endsection
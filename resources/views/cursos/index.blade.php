@extends('layouts.main')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h1 style="color: #000; font-weight: 800;">Módulos Educacionais</h1>
            <p class="lead mb-4">Explore nossos saberes. Selecione um módulo abaixo para começar a aprender.</p>

            <div class="list-group">
                {{-- Loop para listar TODAS as aulas --}}
                @forelse($aulas as $aula)
                    <a href="{{ route('curso.aula', $aula->id) }}" 
                       class="list-group-item list-group-item-action p-3">
                        
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1" style="color: rgba(1, 75, 160, 1);">{{ $aula->titulo }}</h5>
                            <small>Aula {{ $aula->ordem }}</small>
                        </div>
                        <p class="mb-1">
                            {{-- Pega os primeiros 150 caracteres da descrição, sem HTML --}}
                            {!! \Illuminate\Support\Str::limit(strip_tags($aula->descricao_html), 150) !!}
                        </p>
                    </a>
                @empty
                    <div class="alert alert-info">
                        Nenhuma aula cadastrada no momento.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>


@endsection
@extends('layouts.main')

@section('title', 'FonteNova - Curso')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cursos.css') }}">
@endpush

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">

        <div class="col-md-4">
            <h3 class="mb-3">Módulos do Curso</h3>
            <div class="list-group" id="aulas-list">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    Aula 1: Manejo e Conservação do Solo
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Aula 2: Reúso de Água na Prática
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Aula 3: Construindo Filtros Naturais
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Aula 4: Coleta de Chuva Eficiente
                </a>
                </div>
        </div>

        <div class="col-md-8">
            <h2 class="mb-3">Aula 1: Manejo e Conservação do Solo e da Água</h2>

            <div class="ratio ratio-16x9 mb-4" style="border-radius: 8px; overflow: hidden;">
                <iframe 
                    src="https://www.youtube.com/embed/SEU_7n94E5A" title="Manejo e Conservação do Solo e da Água" 
                    allowfullscreen>
                </iframe>
            </div>

            <h4>Sobre esta aula</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>

            <ul>
                <li>Lorem Ipsum Dolor</li>
                <li>Lorem Ipsum Dolor</li>
                <li>Lorem Ipsum Dolor</li>
            </ul>

            <hr class="my-4">
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-outline-secondary">
                    &larr; Aula Anterior
                </a>
                <a href="#" class="btn btn-primary" id="btn-proximo">
                    Próxima Aula &rarr;
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
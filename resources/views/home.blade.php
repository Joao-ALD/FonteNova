{{-- resources/views/home.blade.php --}}
{{-- VERSÃO CORRIGIDA USANDO APENAS O SEU `.px-custom` PARA O LAYOUT --}}

@extends('layouts.main')

@section('title', 'FonteNova - Início')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush

@section('content')

<section class="hero text-white">
    {{-- CORREÇÃO: Usando apenas a sua classe .px-custom --}}
    <div class="px-custom">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="hero-title fw-bolder">
                    Reimaginando o Futuro Com as Águas do Presente
                </h1>
                <p class="hero-sub my-4">
                    Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença...
                </p>
                <a class="btn btn-cta fw-bold" href="{{ route('agua.index') }}">Explore os saberes</a>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <img src="{{ asset('assets/img/little_house.svg') }}" alt="Ilustração casa" class="hero-illustration img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="section">
    {{-- CORREÇÃO: Usando apenas a sua classe .px-custom --}}
    <div class="px-custom">
        <h2 class="section-title">Galeria Interativa</h2>
        <div class="row g-4 justify-content-center">
            @php
            $cards = [
                ['img' => 'icon_balde.svg', 'label' => 'Coleta de chuva', 'bg' => '#3b8eed'],
                ['img' => 'icon_water.svg', 'label' => 'Reuso de água', 'bg' => '#014ba0'],
                ['img' => 'icon_hands.svg', 'label' => 'Cuidados à água', 'bg' => '#3b8eed'],
                ['img' => 'icon_filter.svg', 'label' => 'Filtros naturais', 'bg' => '#014ba0'],
            ];
            @endphp
            @foreach ($cards as $card)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-card d-flex flex-column justify-content-center align-items-center p-4 rounded-3 text-white" style="background-color: {{ $card['bg'] }};">
                        <img src="{{ asset('assets/img/' . $card['img']) }}" alt="{{ $card['label'] }}" class="gallery-card-icon mb-3">
                        <span class="gallery-card-label fw-bold">{{ $card['label'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="map-section text-white">
    {{-- CORREÇÃO: Usando apenas a sua classe .px-custom --}}
    <div class="px-custom">
        <div class="row align-items-center">
            <div class="col-lg-7 text-center text-lg-start">
                <h2 class="fw-bolder mb-3">Mapa do conhecimento</h2>
                <p>
                    Clique nos estados do mapa para descobrir iniciativas regionais que promovem o uso consciente da água. Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença na preservação dos nossos recursos hídricos.
                </p>
                <p class="mt-3">🚀 Cada estado tem algo a ensinar. Dê o primeiro clique!</p>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <img src="{{ asset('assets/img/icon_brasil.svg') }}" alt="Mapa do Brasil" class="map-illustration img-fluid">
            </div>
        </div>
    </div>
</section>

<section class="section edu-section">
    {{-- CORREÇÃO: Usando apenas a sua classe .px-custom --}}
    <div class="px-custom">
        <h2 class="section-title text-white">Educação Ambiental</h2>
        <div class="row g-4 justify-content-center">
            @php
            $eduItems = [
                ['img' => 'icon_workshop.svg', 'label' => 'Oficinas', 'highlight' => false],
                ['img' => 'icon_ebook.svg', 'label' => 'E-Books', 'highlight' => true],
                ['img' => 'icon_eventos.svg', 'label' => 'Eventos', 'highlight' => false],
            ];
            @endphp
            @foreach ($eduItems as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm text-center edu-card {{ $item['highlight'] ? 'edu-card--highlighted' : '' }}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                            <img src="{{ asset('assets/img/' . $item['img']) }}" alt="{{ $item['label'] }}" class="edu-card-icon mb-3">
                            <h4 class="edu-card-label fw-bold">{{ $item['label'] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section quote-section">
    {{-- CORREÇÃO: Usando apenas a sua classe .px-custom --}}
    <div class="px-custom">
        <div class="quote-box bg-white p-4 p-md-5 rounded-3 mx-auto">
            <img src="{{ asset('assets/img/quote.svg')}}" alt="Ícone de citação" class="quote-icon mb-4">
            <p class="quote-text fw-bold">Cuidar da água é cuidar da vida. Faça parte dessa transformação.</p>
        </div>
        <p class="quote-attribution text-center text-muted fst-italic mt-4">
            "Cuidar da água é cuidar da vida. Faça parte dessa transformação."
        </p>
    </div>
</section>

@endsection
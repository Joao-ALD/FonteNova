@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush

@section('content')
<!-- Hero -->
<section class="hero">
    <div class="px-custom hero-inner">
        <div class="hero-content">
            <h1 class="hero-title">
                Reimaginando o<br>Futuro Com as Águas<br>do Presente
            </h1>
            <p class="hero-sub">
                Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença...
            </p>
            <a class="btn btn-primary btn-cta" href="{{ route('agua.index') }}">Explorar os saberes</a>
        </div>

        <div class="hero-media">
            <img src="{{ asset('assets/img/little_house.svg') }}" alt="Ilustração casa" class="hero-illustration">
        </div>
    </div>
</section>

<!-- Galeria Interativa -->
<section class="section bg-white px-custom">
    <h3 class="section-title">Galeria Interativa</h3>
    <div class="gallery">
        @php
        $cards = [
        ['img' => 'icon_balde.svg', 'label' => 'Coleta de chuva', 'bg' => '#3b8eed'],
        ['img' => 'icon_water.svg', 'label' => 'Reuso de água', 'bg' => '#014ba0'],
        ['img' => 'icon_hands.svg', 'label' => 'Cuidados à água', 'bg' => '#3b8eed'],
        ['img' => 'icon_filter.svg', 'label' => 'Filtros naturais', 'bg' => '#014ba0'],
        ];
        @endphp
        @foreach ($cards as $card)
        <div class="card-square" style="background-color: {{ $card['bg'] }}">
            <div class="icon gallery-icon">
                <img src="{{ asset('assets/img/' . $card['img']) }}" alt="">
            </div>
            <div class="card-label gallery-label">{{ $card['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

<!-- Mapa do conhecimento -->
<section class="map-section bg-AzulClaro bg-fullwidth">
    <div class="px-custom d-flex align-items-center justify-content-between flex-wrap">
        <div class="map-text">
            <h3>Mapa do conhecimento</h3>
            <p>
                Clique nos estados do mapa para descobrir iniciativas regionais que promovem o uso consciente da água.
                Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença na preservação dos nossos recursos hídricos.
            </p>
            <p style="margin-top:8px">🚀 Cada estado tem algo a ensinar. Dê o primeiro clique!</p>
        </div>
        <div class="map-illustration">
            <img src="{{ asset('assets/img/icon_brasil.svg') }}" alt="Mapa do Brasil">
        </div>
    </div>
</section>

<!-- Educação Ambiental -->
<section class="edu bg-AzulEscuro bg-fullwidth">
    <div class="px-custom">
        <h3 class="section-title">Educação Ambiental</h3>
        <div class="edu-cards mt-4 d-flex justify-content-center flex-wrap">
            @php
            $eduItems = [
            ['img' => 'icon_workshop.svg', 'label' => 'Oficinas', 'highlight' => false],
            ['img' => 'icon_ebook.svg', 'label' => 'E-Books', 'highlight' => true],
            ['img' => 'icon_eventos.svg', 'label' => 'Eventos', 'highlight' => false],
            ];
            @endphp
            @foreach ($eduItems as $item)
            {{-- Usamos uma classe para o card destacado em vez de style inline --}}
            <div class="edu-card {{ $item['highlight'] ? 'edu-card--highlighted' : '' }}">
                <div class="icon edu-icon">
                    <img src="{{ asset('assets/img/' . $item['img']) }}" alt="">
                </div>
                <div class="card-label">{{ $item['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- <section class="quote px-custom">
    <div class="quote-box">
        <img src="{{ asset('assets/img/quote.svg')}}" alt="Ícone de citação" class="quote-icon">
        <p class="quote-text">Cuidar da água é cuidar da vida. Faça parte dessa transformação.</p>
    </div>
</section> -->

<!-- Citação -->
<section class="quote-section">
    <div class="px-custom">
        <div class="quote-box">
            <img src="{{ asset('assets/img/quote.svg')}}" alt="Ícone de citação" class="quote-icon">
            <p class="quote-text">Cuidar da água é cuidar da vida. Faça parte dessa transformação.</p>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@endsection
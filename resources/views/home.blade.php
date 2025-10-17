{{--
    - Página inicial do projeto FonteNova. Agrupa chamadas para componentes e
    - seções como Hero, Galeria Interativa, Mapa do Conhecimento e Educação Ambiental.
    - Inclui chamadas para assets (CSS/JS) locais; caso altere classes ou ids,
    - verifique compatibilidade com `public/assets/css/home.css`.
--}}
@extends('layouts.main')
@section('title', 'FonteNova - Início')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css"/>
@endpush

@section('content')

    <section class="hero text-white">
        <x-container>
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
        </x-container>
    </section>

    <section class="section">
        <x-container>
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
                <div class="col-xl-3 col-lg-4 col-md-6 d-flex justify-content-center">
                    <div class="gallery-card square-card d-flex flex-column justify-content-center align-items-center p-4 rounded-3 text-white"
                        style="background-color: {{ $card['bg'] }};">
                        <img src="{{ asset('assets/img/' . $card['img']) }}" alt="{{ $card['label'] }}" class="gallery-card-icon mb-3">
                        <span class="gallery-card-label fw-bold">{{ $card['label'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </x-container>
    </section>

    {{-- SEÇÃO DO MAPA CORRIGIDA E COMPLETA --}}
    <section class="map-section text-white">
        <x-container>
            <div class="row align-items-center">
                <div class="col-lg-7 text-center text-lg-start">
                    <h2 class="fw-bolder mb-3">Mapa do conhecimento</h2>
                    <p>
                        Clique nos estados do mapa para descobrir iniciativas regionais que promovem o uso consciente da água. Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença na preservação dos nossos recursos hídricos.
                    </p>
                    <p class="mt-3">🚀 Cada estado tem algo a ensinar. Dê o primeiro clique!</p>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0">
                    <div id="mapa-interativo-container" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </x-container>
    </section>

    <section class="section edu-section">
        <x-container>
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
                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                    <div class="card square-card border-0 shadow-sm text-center edu-card d-flex flex-column justify-content-center align-items-center p-4 {{ $item['highlight'] ? 'edu-card--highlighted' : '' }}">
                        <img src="{{ asset('assets/img/' . $item['img']) }}" alt="{{ $item['label'] }}" class="edu-card-icon mb-3">
                        <h4 class="edu-card-label fw-bold">{{ $item['label'] }}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </x-container>
    </section>

    <section class="section quote-section">
        <x-container>
            <div class="quote-box bg-white p-md-4 rounded-3 mx-auto text-center">
                <img src="{{ asset('assets/img/quote.svg')}}" alt="Ícone de citação" class="quote-icon">
                </div>
        </x-container>
    </section>
@endsection

@push('scripts')

    {{-- Scripts do mapa. O jQuery já é carregado no layout principal (main.blade.php) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/maps/jquery-jvectormap-br-mill.js"></script>

    <script>
        $(function () {
            // PASSO 1: Tentar renderizar o mapa da forma mais simples possível.
            // Removemos toda a lógica de clique e popover para isolar o problema.
            // Se o mapa aparecer com este código, o problema está na interação com o Popover.
            $('#mapa-interativo-container').vectorMap({
                map: 'br_mill',
                backgroundColor: 'transparent',
                regionStyle: {
                    initial: {
                        fill: '#014BA0' // Cor inicial dos estados
                    },
                    hover: {
                        fill: '#0066CC', // Cor ao passar o mouse
                        cursor: 'pointer'
                    }
                },
                // A lógica onRegionClick foi removida temporariamente para o teste.
            });
        });
    </script>
@endpush
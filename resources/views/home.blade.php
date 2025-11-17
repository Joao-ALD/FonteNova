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
    <link rel="stylesheet" href="{{ asset('assets/css/mapa.css') }}">
@endpush

@section('content')

    <section class="hero text-white">
        <div class="container">
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
                    <img src="{{ asset('assets/img/little_house.svg') }}" alt="Ilustração casa"
                        class="hero-illustration img-fluid">
                </div>
            </div>
</div>
    </section>

    <section class="section">
        <div class="container">
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
                            <img src="{{ asset('assets/img/' . $card['img']) }}" alt="{{ $card['label'] }}"
                                class="gallery-card-icon mb-3">
                            <span class="gallery-card-label fw-bold">{{ $card['label'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </<div>
    </section>

    {{-- SEÇÃO DO MAPA CORRIGIDA E COMPLETA --}}
    <section class="map-section text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center text-lg-start">
                    <h2 class="fw-bolder mb-3">Mapa do conhecimento</h2>
                    <p>
                        Clique nos estados do mapa para descobrir iniciativas regionais que promovem o uso consciente da
                        água. Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença na
                        preservação dos nossos recursos hídricos.
                    </p>
                    <p class="mt-3">🚀 Cada estado tem algo a ensinar. Dê o primeiro clique!</p>
                </div>
                <div class="col-lg-5 text-center mt-4 mt-lg-0 position-relative">
                    <div id="mapa-interativo-container" style="width: 100%; height: 500px;"></div>
                    <div id="mapa-card" class="mapa-card" style="display: none;">
                        <div id="mapa-card-content" class="mapa-card-content">
                            Carregando...
                        </div>
                        <div class="mapa-card-arrow"></div>
                    </div>
                </div>
            </div>
                </div>
    </section>

    <section class="section edu-section">
        <div class="container">
            <h2 class="section-title text-white">Educação Ambiental</h2>
            <div class="row g-4 justify-content-center">
                @php
                    $eduItems = [
                        ['img' => 'icon_workshop.svg', 'label' => 'Oficinas', 'highlight' => false],
                        ['img' => 'icon_ebook.svg', 'label' => 'E-Books', 'highlight' => true, 'link' => route('ebooks.index')],
                        ['img' => 'icon_eventos.svg', 'label' => 'Eventos', 'highlight' => false],
                    ];
                @endphp
                @foreach ($eduItems as $item)
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                        <div
                            class="card square-card border-0 shadow-sm text-center edu-card d-flex flex-column justify-content-center align-items-center p-4 {{ $item['highlight'] ? 'edu-card--highlighted' : '' }}">
                            <img src="{{ asset('assets/img/' . $item['img']) }}" alt="{{ $item['label'] }}"
                                class="edu-card-icon mb-3">
                            <h4 class="edu-card-label fw-bold">{{ $item['label'] }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section quote-section">
        <div class="container">
            <div class="quote-box bg-white p-md-4 rounded-3 mx-auto text-center">
                <img src="{{ asset('assets/img/quote.svg')}}" alt="Ícone de citação" class="quote-icon">
            </div>
                </div>
    </section>
@endsection

@push('scripts')

    <script>
        console.log('=== Carregando mapa SVG realista (icon_brasil.svg) ===');

        $(function () {
            var $container = $('#mapa-interativo-container');
            if ($container.length === 0) {
                console.error('❌ Container do mapa não encontrado');
                return;
            }

            var svgUrl = "{{ asset('assets/img/icon_brasil.svg') }}";

            $.get(svgUrl)
                .done(function (data) {
                    // Extract the <svg> element from the returned XML
                    var $svg = $(data).filter('svg');
                    if ($svg.length === 0) $svg = $(data).find('svg').first();
                    if ($svg.length === 0) {
                        $container.html('<p>Mapa indisponível</p>');
                        return;
                    }

                    // Fix SVG dimensions and responsiveness
                    $svg.attr('width', '100%')
                        .attr('height', '100%')
                        .attr('preserveAspectRatio', 'xMidYMid meet')
                        .attr('style', 'position: relative; top: 0; left: 0;');

                    // Add data-code and clickable class to path elements with ids (states)
                    // Handle both lowercase id= and uppercase ID= attributes
                    $svg.find('path').each(function () {
                        var $el = $(this);
                        var id = $el.attr('id') || $el.attr('ID');
                        
                        if (!id) return;
                        
                        // Normalize to lowercase for consistency
                        id = id.toUpperCase();
                        
                        $el.attr('id', id); // Normalize to lowercase id attribute
                        $el.attr('data-code', id);
                        $el.addClass('estado');
                        $el.css('cursor', 'pointer');
                        $el.css('transition', 'fill 0.2s ease');
                    });

                    // Wrap SVG in a container to properly handle positioning
                    var $svgWrapper = $('<div style="position: relative; width: 100%; height: 100%; overflow: visible;"></div>');
                    $svgWrapper.append($svg);

                    // Inject CSS styling for hover effects
                    var css = '<style>' +
                        '#mapa-interativo-container svg path.estado:hover { fill: #0066CC !important; }' +
                        '#mapa-interativo-container svg { max-height: 100%; }' +
                        '</style>';
                    
                    $container.html(css).append($svgWrapper);

                    // Click handler for states with tooltip positioning above click point
                    $container.on('click', 'path.estado', function (e) {
                        e.stopPropagation(); // Prevent triggering document click
                        
                        var code = $(this).attr('data-code');
                        if (!code) return;

                        console.log('✓ Estado clicado:', code);

                        // Get the SVG and click coordinates
                        var $svg = $container.find('svg');
                        var svgRect = $svg[0].getBoundingClientRect();
                        var clickX = e.clientX - svgRect.left;
                        var clickY = e.clientY - svgRect.top;

                        $.ajax({
                            url: '/mapa/info/' + code,
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                var card = $('#mapa-card');
                                var cardContent = $('#mapa-card-content');

                                cardContent.html(
                                    '<h5 style="color: #014BA0; font-weight: bold; margin-bottom: 1rem;">' + 
                                    (response.nome || code) + 
                                    '</h5>' +
                                    '<p style="color: #333; font-size: 0.95rem; line-height: 1.5; margin: 0;">' + 
                                    (response.iniciativas || 'Sem informações') + 
                                    '</p>'
                                );

                                // Position card above and centered on click point
                                var cardWidth = 350;
                                var cardHeight = card.outerHeight() || 200;
                                var topPos = Math.max(10, clickY - cardHeight - 20);
                                var leftPos = Math.max(10, Math.min(clickX - cardWidth/2, $container.width() - cardWidth - 10));

                                card.css({
                                    'top': topPos + 'px',
                                    'left': leftPos + 'px',
                                    'right': 'auto'
                                });

                                card.fadeIn(200);
                            },
                            error: function () {
                                $('#mapa-card-content').html(
                                    '<p style="color: #d32f2f; font-weight: bold;">Erro ao carregar informações do estado ' + code + '</p>'
                                );
                                $('#mapa-card').fadeIn(200);
                            }
                        });
                    });

                    // Close card when clicking outside the map
                    $(document).on('click', function (e) {
                        var card = $('#mapa-card');
                        var isClickOnMap = $container.find(e.target).length > 0;
                        var isClickOnCard = card.find(e.target).length > 0;
                        
                        if (!isClickOnMap && !isClickOnCard) {
                            card.fadeOut(200);
                        }
                    });

                    console.log('✓✓✓ Mapa SVG realista (icon_brasil.svg) carregado com sucesso! ✓✓✓');
                    console.log('Total de estados clicáveis encontrados');
                })
                .fail(function () {
                    $container.html('<p style="color: #d32f2f; padding: 2rem;">Falha ao carregar o mapa. Tente novamente mais tarde.</p>');
                    console.error('❌ Erro ao carregar SVG');
                });
        });
    </script>
@endpush
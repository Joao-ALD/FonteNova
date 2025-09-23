@extends('layouts.main')

@section('content')
<!-- Hero -->
<section class="hero px-custom">
    <div class="hero-inner">
        <div class="hero-content">
            <h1 class="hero-title">
                Reimaginando o<br>Futuro Com as Águas<br>do Presente
            </h1>
            <p class="hero-sub">Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença...</p>
            <a class="btn btn-primary btn-cta" href="{{ route('agua.index') }}">Explorar os saberes</a>
        </div>

        <div class="hero-media">
            <img src="assets/img/little_house.svg" alt="casa-pequena" class="hero-illustration">
        </div>
    </div>
</section>

<!-- Gallery -->
<section class="section bg-white px-custom">
    <h3 class="section-title">Galeria Interativa</h3>
    <div class="gallery">
        <div class="card-square" style="background-color: #3b8eed">
            <div class="icon"><img src="{{ asset('assets/img/icon_balde.svg') }}" alt=""></div>
            <div class="card-label">Coleta de chuva</div>
        </div>
        <div class="card-square" style="background-color: #014ba0">
            <div class="icon"><img src="{{ asset('assets/img/icon_water.svg') }}" alt=""></div>
            <div class="card-label">Reuso de água</div>
        </div>
        <div class="card-square" style="background-color: #3b8eed">
            <div class="icon"><img src="{{ asset('assets/img/icon_hands.svg') }}" alt=""></div>
            <div class="card-label">Cuidados à água</div>
        </div>
        <div class="card-square" style="background-color: #014ba0">
            <div class="icon"><img src="{{ asset('assets/img/icon_filter.svg') }}" alt=""></div>
            <div class="card-label">Filtros naturais</div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section bg-AzulClaro bg-fullwidth">
    <div class="px-custom d-flex align-items-center justify-content-between flex-wrap">
        <div class="map-text">
            <h3>Mapa do conhecimento</h3>
            <p>Clique nos estados do mapa para descobrir iniciativas regionais que promovem o uso consciente da água. Explore soluções criativas, saberes locais e tecnologias acessíveis que fazem a diferença na preservação dos nossos recursos hídricos.</p>
            <p style="margin-top:8px">🚀 Cada estado tem algo a ensinar. Dê o primeiro clique!</p>
        </div>
        <div class="map-illustration">
            <img src="{{ asset('assets/img/icon_brasil.svg') }}" alt="">
        </div>
    </div>
</section>

<!-- Education -->
<section class="edu bg-AzulEscuro bg-fullwidth">
    <div class="px-custom">
        <h3 class="section-title">Educação Ambiental</h3>
        <div class="edu-cards mt-4 d-flex justify-content-center">
            <div class="card-square" style="background-color: #fff;">
                <div class="icon"><img src="{{ asset('assets/img/icon_workshop.svg') }}" alt=""></div>
                <div class="card-label text-black"><h3>Oficinas</h3></div>
            </div>

            <div class="card-square" style="background-color: #3b8eed;">
                <div class="icon"><img src="{{ asset('assets/img/icon_ebook.svg') }}" alt=""></div>
                <div class="card-label text-black"><h3>E-Book</h3></div>
            </div>
            <div class="card-square" style="background-color: #fff;">
                <div class="icon"><img src="{{ asset('assets/img/icon_eventos.svg')}}" alt=""></div>
                <div class="card-label text-black"><h3>Eventos</h3></div>
            </div>
        </div>
    </div>
</section>

<!-- Quote -->
<section class="quote px-custom">
    <div class="m-4 d-flex justify-content-center">
        <img src="{{ asset('assets/img/quote.svg')}}" alt="">
    </div>
</section>
@endsection
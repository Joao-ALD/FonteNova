{{-- resources/views/layouts/home.blade.php --}}
@extends('layouts.main')

@section('title', 'Sobre')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <div class="container bg-primary border rounded-5 text-white cNossoProjeto">
        <h2 class="mt-4 text-center fw-bold">Nosso projeto</h2>
        <img src="{{asset('assets/img/icon_hands.svg')}}" class="mx-auto d-block mb-5 mt-5">
        <p class="mb-4 text-center">
            Nosso projeto tem como missão promover a conscientização sobre o uso responsável da
            água, incentivando práticas sustentáveis no cotidiano. <br> Através de recursos digitais,
            buscamos informar, inspirar e transformar hábitos, mostrando que pequenas atitudes podem causar grandes impactos. <br>
            Acreditamos que o conhecimento é o primeiro passo para a mudança e, por isso, criamos
            este espaço educativo, interativo e acessível a todos.
        </p>
    </div>
    <div>
        <h2 class="titulosSobre fw-bold mt-3">Objetivos</h2>
        <p class="textoSobre"> 
            · Estimular o uso sustentável da água no dia a dia <br>
            · Promover o acesso a informações confiáveis e aplicáveis <br>
            · Valorizar saberes locais e técnicas acessíveis de economia e reaproveitamento <br>
            · Incentivar a educação ambiental de forma lúdica e participativa
        </p>
        <br>
        <h2 class="titulosSobre fw-bold">Público-Alvo</h2>
        <p class="textoSobre">
            O projeto é voltado para estudantes, educadores, famílias e todas as pessoas interessadas em aprender mais
            sobre sustentabilidade e preservação ambiental, com linguagem simples e conteúdos visuais que facilitam a
            compreensão.
        </p>
        <br>
        <h2 class="titulosSobre fw-bold">Por que Falar Sobre Água?</h2>
        <p class="textoSobre mb-3">
            A água é um recurso limitado e essencial. Apesar de parecer abundante, apenas uma pequena parte da água
            disponível no planeta é própria para consumo. <br> Diante dos impactos ambientais e do desperdício cotidiano,
            torna-se urgente educar e mobilizar a sociedade para garantir que as próximas gerações tenham acesso a esse
            bem vital.
            <br>
            <br>
        </p>

    </div>
@endsection
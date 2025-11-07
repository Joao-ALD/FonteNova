@extends('layouts.main')

@section('title', 'Fonte Nova - Sobre')

@section('content')
    {{--
    View: Sobre
    - Página institucional que descreve missão, objetivos e pilares do projeto.
    - Conteúdo editorial: ideal para material estático. Caso membros alterem
    - textos, revisar consistência e imagens referenciadas em `public/assets/img`.
    --}}
    <link rel="stylesheet" href="{{ asset('assets/css/sobre.css') }}">

    {{-- NOSSO PROJETO --}}
    <div class="container sobre-container bg-AzulClaro text-white rounded-5 my-5 py-5 px-4">
        <div class="text-center">
            <h2 class="fw-bold">Nosso Projeto</h2>
            <img src="{{ asset('assets/img/icon_hands.svg') }}" class="img-fluid my-4" style="max-width: 150px;"
                alt="Mãos unidas">
            <p class="lead">
                Nosso projeto tem como missão promover a conscientização sobre o uso responsável da água,
                incentivando práticas sustentáveis no cotidiano. <br><br>
                Através de recursos digitais, buscamos informar, inspirar e transformar hábitos, mostrando que pequenas
                atitudes causam grandes impactos. <br><br>
                Acreditamos que o conhecimento é o primeiro passo para a mudança e, por isso, criamos este espaço educativo,
                interativo e acessível a todos.
            </p>
        </div>
    </div>

    {{-- OBJETIVOS / PÚBLICO / IMPORTÂNCIA --}}
    <div class="container my-5">
        <div class="row gy-5">
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Objetivos</h2>
                <ul class="objetivos-list">
                    <li>Estimular o uso sustentável da água no dia a dia</li>
                    <li>Promover o acesso a informações confiáveis e aplicáveis</li>
                    <li>Valorizar saberes locais e técnicas acessíveis</li>
                    <li>Incentivar a educação ambiental de forma lúdica</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Público-Alvo</h2>
                <p>
                    O projeto é voltado para estudantes, educadores, famílias e todas as pessoas interessadas em aprender
                    mais sobre sustentabilidade e preservação ambiental. <br><br>
                    Usamos linguagem simples e conteúdo visual para facilitar a compreensão.
                </p>
            </div>
            <div class="col-12">
                <h2 class="fw-bold mb-3">Por que Falar Sobre Água?</h2>
                <p>
                    A água é um recurso limitado e essencial. Apesar de parecer abundante, apenas uma pequena parte da água
                    disponível é própria para consumo. <br><br>
                    Diante dos impactos ambientais e do desperdício cotidiano, é urgente educar e mobilizar a sociedade para
                    garantir esse bem vital às próximas gerações.
                </p>
            </div>
        </div>
    </div>

    {{-- NOSSOS PILARES --}}
    <div class="bg-light py-5">
        <div class="container">
            <h3 class="text-center fw-bold mb-5">Nossos Pilares</h3>
            <div class="row text-center gy-4">
                <div class="col-md-4">
                    <!-- <img src="{{ asset('assets/img/icon_educacao.svg') }}" alt="Educação" style="height: 60px;"> -->
                    <h5 class="mt-3 fw-bold">Educação</h5>
                    <p>Promovemos conhecimento acessível e transformador para todas as idades.</p>
                </div>
                <div class="col-md-4">
                    <!-- <img src="{{ asset('assets/img/icon_consciencia.svg') }}" alt="Consciência" style="height: 60px;"> -->
                    <h5 class="mt-3 fw-bold">Consciência</h5>
                    <p>Despertamos a responsabilidade coletiva sobre o uso da água.</p>
                </div>
                <div class="col-md-4">
                    <!-- <img src="{{ asset('assets/img/icon_acao.svg') }}" alt="Ação" style="height: 60px;"> -->
                    <h5 class="mt-3 fw-bold">Ação</h5>
                    <p>Encorajamos atitudes práticas que fazem a diferença.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- FAQ --}}
    <div class="container my-5">
        <h3 class="fw-bold text-center mb-4">Perguntas Frequentes</h3>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button justify-content-between" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        Por que o projeto foca tanto na água?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Porque a água é um recurso essencial, limitado e muitas vezes desperdiçado. Educar sobre seu uso é
                        fundamental para a sustentabilidade.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed justify-content-between" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false"
                        aria-controls="collapse2">
                        O projeto é totalmente gratuito?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A maior parte do conteúdo do site é totalmente gratuito. No entanto, oferecemos um curso online
                        opcional para quem deseja aprofundar o aprendizado de forma mais didática, estruturada e com suporte
                        adicional.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed justify-content-between" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false"
                        aria-controls="collapse3">
                        Onde posso encontrar mais materiais?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Você pode explorar nossas seções de recursos, quiz e artigos. Novos materiais são adicionados
                        frequentemente para enriquecer sua experiência.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq4">
                    <button class="accordion-button collapsed justify-content-between" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                        aria-controls="collapse4">
                        O conteúdo do projeto é focado apenas em crianças?
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Não. O projeto é voltado para estudantes, educadores, famílias e todas as pessoas interessadas em
                        aprender sobre sustentabilidade. A linguagem simples e o conteúdo visual são usados para facilitar a
                        compreensão de todos os públicos.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq5">
                    <button class="accordion-button collapsed justify-content-between" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false"
                        aria-controls="collapse5">
                        O que significa o objetivo de "valorizar saberes locais"?
                    </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Além de informações técnicas, um dos objetivos do projeto é "valorizar saberes locais e técnicas
                        acessíveis". Isso significa que também buscamos divulgar soluções de reuso ou economia de água que
                        são tradicionais, de baixo custo e adaptadas à realidade de diferentes comunidades.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faq6">
                    <button class="accordion-button collapsed justify-content-between" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false"
                        aria-controls="collapse6">
                        Qual é a diferença entre os pilares "Educação" e "Consciência" do projeto?
                    </button>
                </h2>
                <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        A "Educação" é o pilar focado em promover conhecimento acessível para todas as idades. A
                        "Consciência" é o pilar focado em despertar a responsabilidade coletiva sobre o uso da água, que é o
                        resultado esperado da educação.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="sobre.css">
@endsection
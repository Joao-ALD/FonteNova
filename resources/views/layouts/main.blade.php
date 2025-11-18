{{--
Layout principal da aplicação (Blade)
- Inclui head com meta tags, links para CSS/JS e navbar comum.
- Usar `@stack('styles')` e `@yield('scripts')` para empilhar estilos e scripts
- específicos por view sem editar diretamente este arquivo.
- Atenção ao usar scripts externos: já incluímos bootstrap via CDN.
--}}
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FonteNova')</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Fontes, Bootstrap e CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrapLink.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-nav nav-auto-hide fixed-top">
        <div class="px-custom w-100 d-flex align-items-center justify-content-between">

            <!-- Logo -->
            <a class="navbar-brand text-white d-flex align-items-center" href="{{ route('home.index') }}">
                <img src="{{ asset('assets/img/icon_logo.svg') }}" alt="LogoFonteNova" class="logo-img" />
                FonteNova
            </a>

            <!-- Botão Hamburguer -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <!-- Menu (fora da .px-custom para ocupar tela toda no mobile) -->
        <div class="collapse navbar-collapse px-custom" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('agua.index') }}">Água</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('sobre.index') }}">Sobre</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('galeria.index') }}">Galeria</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('chatbot.index') }}">ChatBot</a></li>

                @guest
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Registrar</a></li>
                @endguest

                @auth
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('curso.index') }}">Curso</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('quizz.index') }}">Quizz</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownUserLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }} </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUserLink">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Sair') }}
                                    </a>
                                </form>
                        </li>
                    </ul>
                    </li>
                    @if(auth()->user()->is_admin)

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-shield-lock"></i> Área Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.cursos.index') }}">Gerenciar Cursos</a>
                                </li>
                            </ul>
                        </li>

                    @endif
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Conteúdo da página -->
    <main class="pt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white footer-custom-bg">
        <div class="container p-4 px-custom">
            <div class="row gy-5">

                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/img/icon_logo.svg') }}" alt="Logo FonteNova"
                            style="width: 60px; height: auto; margin-right: 15px;">
                        <h3 class="fw-bold mb-0">FonteNova</h3>
                    </div>
                    <p class="slogan">
                        Conectando saberes para preservar o amanhã.
                    </p>
                    <div class="mt-4 d-flex gap-2">
                        <a href="#" class="btn btn-floating btn-light btn-lg"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-floating btn-light btn-lg"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-floating btn-light btn-lg"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4">Sobre o Projeto</h5>
                    <p class="footer-text-dim">
                        Uma plataforma dedicada a disseminar o conhecimento sobre o uso consciente e sustentável da
                        água,
                        oferecendo soluções práticas para um futuro mais azul.
                    </p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4">Navegação</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="/">Home</a></li>
                        <li class="mb-2"><a href="/sobre">Sobre Nós</a></li>
                        <li class="mb-2"><a href="/mapa">Mapa do Conhecimento</a></li>
                        <li class="mb-2"><a href="/solucoes">Soluções</a></li>
                        <li class="mb-2"><a href="/eventos">Eventos</a></li>
                        <li><a href="/contato">Contato</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4">Contato</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-phone me-1"></i><span>(99) 99999-9999</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-envelope me-1"></i><span>contato@fontenova.com.br</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt me-1"></i><span>Registro, SP - Brasil</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            &copy; {{ date('Y') }} FonteNova. Todos os direitos reservados.
        </div>
    </footer>

    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
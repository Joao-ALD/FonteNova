<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon SVG (principal) -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- PNG para navegadores que não suportam SVG -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- ICO como fallback adicional (máxima compatibilidade) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    {{-- Bootstrap CSS (local) --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrapLink.css') }}">
    {{-- CSS customizado do projeto --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>@yield('title', 'FonteNova')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid bg-nav nav-h px-0">
            <div class="w-100 d-flex justify-content-between align-items-center px-custom">
                <!-- Logo alinhada ao centro -->
                <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('home.index') }}">
                    <img src="{{ asset('assets/img/icon_logo.svg') }}" alt="LogoFonteNova" class="logo-img">FonteNova
                </a>

                <!-- Botão mobile (hamburguer) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links de navegação -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active text-white" href="{{ route('agua.index') }}">Água</a></li>
                        <li class="nav-item"><a class="nav-link active text-white" href="#">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link active text-white" href="#">Galeria</a></li>
                        <li class="nav-item"><a class="nav-link active text-white" href="#">Mapa</a></li>
                        <li class="nav-item"><a class="nav-link active text-white" href="#">Curso</a></li>
                        <li class="nav-item"><a class="nav-link active text-white" href="{{ route('chatbot.index') }}">ChatBot</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    {{-- Conteúdo das páginas --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <footer class="text-white footer-custom-bg">
        <div class="container p-4 px-custom">
            <div class="row my-4 gy-5">

                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('assets/img/icon_logo.svg') }}" alt="Logo FonteNova"
                            style="width: 60px; height: auto; margin-right: 15px;">
                        <h3 class="fw-bold mb-0">FonteNova</h3>
                    </div>
                    <p class="slogan">
                        Conectando saberes para preservar o amanhã.
                    </p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-floating btn-light btn-lg me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-floating btn-light btn-lg me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-floating btn-light btn-lg"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4">Sobre o Projeto</h5>
                    <p class="footer-text-dim">
                        Uma plataforma dedicada a disseminar o conhecimento sobre o uso consciente e sustentável da água,
                        oferecendo soluções práticas para um futuro mais azul.
                    </p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4">Navegação</h5>
                    <ul class="list-unstyled mb-0 footer-links">
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
                        <li class="mb-3 d-flex">
                            <span class="fa-li pe-2"><i class="fas fa-phone"></i></span><span>(99) 99999-9999</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <span class="fa-li pe-2"><i class="fas fa-envelope"></i></span><span>contato@fontenova.com.br</span>
                        </li>
                        <li class="d-flex">
                            <span class="fa-li pe-2"><i class="fas fa-map-marker-alt"></i></span><span>Registro, SP - Brasil</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            &copy; {{ date('Y') }} FonteNova. Todos os direitos reservados.
        </div>
    </footer>
    {{-- Bootstrap JS (local) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Scripts personalizados --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- Scripts específicos de cada página --}}
    @yield('scripts')
</body>
</html>
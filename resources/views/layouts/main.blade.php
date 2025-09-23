<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrapLink.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>@yield('title', 'FonteNova')</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top nav-auto-hide bg-nav">
        <div class="container-fluid navbar-container">

            <!-- Logo + Botão hamburguer -->
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('home.index') }}">
                    <img src="{{ asset('assets/img/icon_logo.svg') }}" alt="LogoFonteNova" class="logo-img">
                    FonteNova
                </a>

                <!-- Botão hamburguer -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-end mt-2 mt-lg-0" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('agua.index') }}">Água</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('sobre.index') }}">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Galeria</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Mapa</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Curso</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('chatbot.index') }}">ChatBot</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('quizz.index') }}">Quizz</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo da página -->
    <main class="pt-5 mt-5">
        @yield('content')
    </main>

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
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
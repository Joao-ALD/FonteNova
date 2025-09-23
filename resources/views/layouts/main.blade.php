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

    

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
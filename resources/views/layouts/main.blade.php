<!-- resources/views/layouts/main.blade.php -->
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

    {{-- Bootstrap JS (local) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Scripts personalizados --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
        {{-- Scripts específicos de cada página --}}
        @yield('scripts')
</body>
</html>
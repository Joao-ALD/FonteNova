<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav fixed-top shadow">
        <div class="container">
            <!-- Logo + Nome -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home.index') }}">
                <img src="{{ asset('assets/img/icon_logo.svg') }}" alt="Logo" width="40" height="40" class="me-2">
                <span>FonteNova</span>
            </a>
    
            <!-- Botão mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Links -->
            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agua.index')}}">Água</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('sobre.index')}}">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeria">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#mapa">Mapa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#curso">Curso</a>
                    </li>
                </ul>
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
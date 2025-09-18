<!-- resources/views/layouts/main.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Bootsrap CSS TEMPORÁRIO (site) --}}
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->

    {{-- Bootstrap CSS (local) --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrapLink.css') }}">

    {{-- CSS customizado do projeto --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>@yield('title', 'FonteNova')</title>
</head>

<body>

    {{-- NAVBAR aqui ou em @include('layouts.header') --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid text-white bg-nav nav-h">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/LogoReduzida.svg') }}" alt="LogoFonteNova">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Galeria</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Mapa</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Curso</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteúdo das páginas --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS (local) --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrapLink.js') }}"></script>
    {{-- Scripts personalizados --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
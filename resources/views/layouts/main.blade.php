<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>FonteNova</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg  bs-primary">
        <!-- //- 'container-fluid' faz com que o conteúdo da barra ocupe toda a largura da tela. -->
        <div class="container-fluid text-white bg-nav nav-h">
            <!-- //- 'navbar-brand' é usado para o nome do site ou logo. -->
            <a class="navbar-brand" href="#"><img src="assets\img\LogoReduzida.svg" alt="LogoFonteNova"></a>

            <!-- //- Este é o botão "hambúrguer" que aparece em telas pequenas. -->
            <!-- //- 'data-bs-toggle="collapse"' e 'data-bs-target' o conectam ao nav que deve ser mostrado/escondido. -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- //- Este <div> contém os links do nav e pode ser recolhido/escondido. -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- //- Lista que agrupa os itens de navegação. -->
                <ul class="navbar-nav">
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples para a página "Home". 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="#">Sobre</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="#">Galeria</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="#">Mapa</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="#">Curso</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container">
        @yield('content')
    </section>

    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
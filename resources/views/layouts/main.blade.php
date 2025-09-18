<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>FonteNova</title>
</head>
<body>
       
    <nav class="navbar navbar-expand-lg  bs-primary  ">
        <!-- //- 'container-fluid' faz com que o conteúdo da barra ocupe toda a largura da tela. -->
        <div class="container-fluid text-white bg-nav nav-h">
            <!-- //- 'navbar-brand' é usado para o nome do site ou logo. -->
            <a class="navbar-brand" href="index "><img src="assets\img\LogoReduzida.png" alt="LogoFonteNova"></a>

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
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Sobre</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Galeria</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Mapa</a>
                    </li>
                    <!-- //- Item da lista de navegação. -->
                    <li class="nav-item">
                        <!-- //- Link simples 'active' o deixa destacado. -->
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Curso</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container">
    @yield('content')
    </section>

    <script src="assets/js/script.js"></script>
</body>

</html>
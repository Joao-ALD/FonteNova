@extends('layouts.main')

@section('content')

  <section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">

    <!-- Subtítulo -->
    <p class="lead mt-3">
      Olá, quer fazer o uso sustentavel da água?
    </p>

    <!-- Formulário de Pesquisa -->
<form method="GET" action="search.php" id="formPesquisa">
  <input type="text" name="query" id="campoPesquisa" placeholder="Digite sua pergunta..." required autofocus>
</form>

<!-- Botões de Tópicos -->
<div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
  <button class="btn btn-outline-primary btn-lg px-4" type="button" onclick="enviarTopico('Clima')">Clima</button>
  <button class="btn btn-outline-primary btn-lg px-4" type="button" onclick="enviarTopico('Coleta')">Coleta</button>
  <button class="btn btn-outline-primary btn-lg px-4" type="button" onclick="enviarTopico('Consumo')">Consumo</button>
  <button class="btn btn-outline-primary btn-lg px-4" type="button" onclick="enviarTopico('Preservação')">Preservação</button>
</div>

<!-- Script -->
<script>
  function enviarTopico(topico) {
    const campo = document.getElementById('campoPesquisa');
    campo.value = topico; // preenche o campo com o nome do botão
    document.getElementById('formPesquisa').submit(); // envia o formulário
  }
</script>
@endsection
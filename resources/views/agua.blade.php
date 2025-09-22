@extends('layouts.main')

@section('content')

  <section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">
    <!-- Título -->
    <h1 class="display-1 fw-bold p">Tudo sobre a Água</h1>

    <!-- Subtítulo -->
    <p class="lead mt-3">
      Explore o mundo água: do clima à preservação, entenda como cada ação impacta o nosso recurso mais precioso.
    </p>

    <!-- Botões do topicos Clima,Coleta,Consumo,Preservacao -->
    <div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseClima" aria-expanded="false" aria-controls="collapseClima">
        Clima
      </button>

      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseColeta" aria-expanded="false" aria-controls="collapseColeta">
        Coleta
      </button>

      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseConsumo" aria-expanded="false" aria-controls="collapseConsumo">
        Consumo
      </button>

      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapsePreservacao" aria-expanded="false" aria-controls="collapsePreservacao">
        Preservação
      </button>
    </div>



    <div class="container mt-5" id="infoPanels">

  <!-- Card Clima -->
  <div class="collapse" id="collapseClima" data-bs-parent="#infoPanels">
    <div class="row g-4">
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white text-end">Clima</h5>
            <p class="card-text text-white text-center" style="margin-top: 20px;">
              O clima desempenha um papel fundamental na disponibilidade de água no planeta...
            </p>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white text-end">Coleta de Água da chuva</h5>
            <p class="card-text text-white text-center" style="margin-top: 20px;">
              A coleta de água da chuva é uma forma sustentável...
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Coleta (4 cards) -->
  <div class="collapse" id="collapseColeta" data-bs-parent="#infoPanels">
    <div class="row g-4">
      <!-- Coleta -->
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white">Coleta</h5>
            <p class="card-text text-white">
              A coleta da água é o processo inicial pelo qual a água é retirada de suas fontes naturais...
            </p>
          </div>
        </div>
      </div>

      <!-- Captação -->
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white">Captação</h5>
            <p class="card-text text-white">
              A captação envolve estruturas como canais, bombas e adutoras...
            </p>
          </div>
        </div>
      </div>

      <!-- Armazenamento -->
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white">Armazenamento</h5>
            <p class="card-text text-white">
              Após a coleta e captação, a água precisa ser bem armazenada...
            </p>
          </div>
        </div>
      </div>

      <!-- Filtragem -->
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white">Filtragem</h5>
            <p class="card-text text-white">
              A filtragem é a etapa que torna essa água mais limpa e segura para o consumo...
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Consumo -->
  <div class="collapse" id="collapseConsumo" data-bs-parent="#infoPanels">
    <div class="row g-4">
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white text-end">Consumo</h5>
            <p class="card-text text-white text-center" style="margin-top: 20px;">
              O consumo consciente de água é crucial para garantir sua disponibilidade futura...
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Preservação -->
  <div class="collapse" id="collapsePreservacao" data-bs-parent="#infoPanels">
    <div class="row g-4">
      <div class="col-12">
        <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-white text-end">Preservação</h5>
            <p class="card-text text-white text-center" style="margin-top: 20px;">
              Preservar a água envolve proteger fontes naturais, como rios, nascentes e mananciais...
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
  </section>

  <script>
    const buttons = document.querySelectorAll('.btn[data-bs-toggle="collapse"]');

    buttons.forEach(btn => {
      btn.addEventListener('click', function () {
        // Se o botão já estiver ativo
        if (this.classList.contains('active')) {
          this.classList.remove('active'); // desativa
        } else {
          // Remove active de todos os outros
          buttons.forEach(b => b.classList.remove('active'));
          // Ativa o clicado
          this.classList.add('active');
        }
      });
    });
  </script>
@endsection
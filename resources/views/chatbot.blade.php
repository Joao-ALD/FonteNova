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

      <!-- card Clima -->
      <div class="collapse" id="collapseClima" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <div class="col-12">
            <div class="card text-start card bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Impacto do Clima na Água</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">O clima desempenha um papel central
                  na disponibilidade e na qualidade da água no planeta. Mudanças climáticas provocam eventos extremos como
                  secas prolongadas, enchentes e variações de temperatura, que afetam rios, lagos e aquíferos. Regiões com
                  chuvas irregulares enfrentam escassez, enquanto áreas com excesso de precipitação podem sofrer
                  inundações. Entender essas mudanças permite planejar o uso consciente da água e desenvolver estratégias
                  de adaptação em escolas, comunidades e residências.</p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start card bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Clima</h5>
                <p class="card-text text-white text-center">Aqui vai a informação sobre o clima. Este é o primeiro card
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Card Coleta -->
      <div class="collapse" id="collapseColeta" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Card de Coleta 1</h5>
                <p class="card-text text-white text-center">Informações sobre como a coleta da água funciona.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Comsumo -->
      <div class="collapse" id="collapseConsumo" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <div class="col-12">
            <div class="card text-start card bg-card mb-3 mx-auto " style="width: 90%; height: 15rem; ">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Card de Consumo 1</h5>
                <p class="card-text text-white text-center">Dados e dicas sobre o consumo consciente da água.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Preservação -->
      <div class="collapse" id="collapsePreservacao" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <div class="col-12">
            <div class="card text-start card bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Card de Preservação 1</h5>
                <p class="card-text text-white text-center">A importância de preservar nossos recursos hídricos.</p>
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
    btn.addEventListener('click', function() {
      // Se o botão já estiver ativo
      if(this.classList.contains('active')) {
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
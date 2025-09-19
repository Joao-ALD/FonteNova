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
    <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClima" aria-expanded="false" aria-controls="collapseClima">
      Clima
    </button>

    <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColeta" aria-expanded="false" aria-controls="collapseColeta">
      Coleta
    </button>

    <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConsumo" aria-expanded="false" aria-controls="collapseConsumo">
      Consumo
    </button>
    
    <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePreservacao" aria-expanded="false" aria-controls="collapsePreservacao">
      Preservação
    </button>
  </div>


  


  <div class="container mt-5" id="infoPanels">

<div class="collapse" id="collapseClima" data-bs-parent="#infoPanels">
  <div class="row g-4">
    <div class="col-12">
      <div class="card text-start card text-bg-info mb-3" style="width: 100%; height: 20rem;">
        <div class="card-body">
          <h5 class="card-title text-white text-end ">Card de Clima 1</h5>
          <p class="card-text text-white text-center">Aqui vai a informação sobre o clima. Este é o primeiro card.</p>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card text-start card text-bg-info mb-3" style="width: 100%; height: 20rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card de Clima 2</h5>
          <p class="card-text text-white text-center">Mais detalhes climáticos podem ser adicionados aqui neste segundo card.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="collapse" id="collapseColeta" data-bs-parent="#infoPanels">
  <div class="row g-4">
    <div class="col-12">
      <div class="card text-start card text-bg-info mb-3" style="width: 100%; height: 20rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card de Coleta 1</h5>
          <p class="card-text text-white text-center">Informações sobre como a coleta da água funciona.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="collapse" id="collapseConsumo" data-bs-parent="#infoPanels">
  <div class="row g-4">
    <div class="col-12">
      <div class="card text-start card text-bg-info mb-3" style="width: 100%; height: 20rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card de Consumo 1</h5>
          <p class="card-text text-white text-center">Dados e dicas sobre o consumo consciente da água.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="collapse" id="collapsePreservacao" data-bs-parent="#infoPanels">
  <div class="row g-4">
    <div class="col-12">
      <div class="card text-start card text-bg-info mb-3" style="width: 100%; height: 20rem;">
        <div class="card-body">
          <h5 class="card-title text-white">Card de Preservação 1</h5>
          <p class="card-text text-white text-center">A importância de preservar nossos recursos hídricos.</p>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

    
    </section>
@endsection
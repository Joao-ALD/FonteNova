@extends('layouts.main')

@section('content')

  <section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">
    <!-- Título -->
    <h1 class="display-1 fw-bold p">Tudo sobre a Água</h1>

    <!-- Subtítulo -->
    <p class="lead mt-3">
      Explore o mundo água: do clima à preservação, entenda como cada ação impacta o nosso recurso mais precioso.
    </p>

    <!-- Botões dos topicos Clima,Coleta,Consumo,Preservacao -->
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


    <!-- Container dinâmico que renderiza os cards -->
    <div class="container mt-5" id="infoPanels">
      @foreach ($topics as $topic => $cards)
        <div class="collapse" id="collapse{{ $topic }}" data-bs-parent="#infoPanels">
          <div class="row g-4">
            @foreach ($cards as $card)
              <div class="mb-4">
                <div class="card h-100 bg-card overflow-hidden border-0 shadow-sm">
                  <div class="row g-0 align-items-stretch">
                    <!-- Imagem à esquerda -->
                    @if(!empty($card['image']))
                      <div class="col-md-5">
                        <img src="{{ asset('assets/img/' . $card['image']) }}" class="img-fluid rounded-start h-100 w-100"
                          alt="{{ $card['title'] }}" style="object-fit: cover; min-height: 250px; max-height: 300px;">
                      </div>
                    @endif

                    <!-- Texto à direita -->
                    <div class="col-md-7 d-flex flex-column justify-content-center p-4">
                      <h5 class="card-title text-white fw-bold mb-3 fs-3">{{ $card['title'] }}</h5>
                      <p class="card-text text-white fs-5">{{ $card['text'] }}</p>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          </div>
        </div>
      @endforeach
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
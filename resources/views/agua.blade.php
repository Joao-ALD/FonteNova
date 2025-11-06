@extends('layouts.main')

@section('content')

  {{-- 
    ESTA SEÇÃO É SÓ PARA O TÍTULO E BOTÕES. 
    Ela sim pode ter min-vh-100 para centralizar o início.
  --}}
  <section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">
    <h1 class="display-1 fw-bold p">Tudo sobre a Água</h1>

    <p class="lead mt-3">
      Explore o mundo água: do clima à preservação, entenda como cada ação impacta o nosso recurso mais precioso.
    </p>

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
  </section> {{-- <--- A SEÇÃO TERMINA AQUI --}}


  {{-- 
    ESTE É O CONTAINER DOS CARDS.
    Ele fica FORA da seção anterior.
  --}}
  <div class="container  mb-5" id="infoPanels"> {{-- <--- EU ADICIONEI mb-5 (margin-bottom) PARA DAR ESPAÇO DO FOOTER --}}
    @foreach ($topics as $topic => $cards)
      <div class="collapse" id="collapse{{ $topic }}" data-bs-parent="#infoPanels">
        <div class="row g-4">
          @foreach ($cards as $card)
            <div class="col-12">
              <div class="card h-100 bg-card overflow-hidden border-0 shadow-sm">
                <div class="row g-0 align-items-stretch">
                  @if (!empty($card['image']))
                    <div class="col-md-5">
                      <img src="{{ asset('assets/img/' . $card['image']) }}" class="img-fluid rounded-start h-100 w-100"
                        alt="{{ $card['title'] }}" style="object-fit: cover;">
                    </div>
                  @endif

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

  {{-- O SEU SCRIPT CONTINUA IGUAL AQUI EMBAIXO --}}
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
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
        @foreach($topics as $key => $cards)
            <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                {{ ucfirst($key) }}
            </button>
        @endforeach
    </div>

    <!-- Panels de cards -->
    <div class="container mt-5" id="infoPanels">
        @foreach($topics as $key => $cards)
            <div class="collapse" id="collapse{{ $key }}" data-bs-parent="#infoPanels">
                <div class="row g-4">
                    @foreach($cards as $card)
                        <div class="col-12">
                            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 15rem;">
                                <div class="card-body">
                                    <h5 class="card-title text-white text-end">{{ $card['title'] }}</h5>
                                    <p class="card-text text-white text-center">{{ $card['text'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

</section>

@endsection

@section('scripts')
<script>
  const buttons = document.querySelectorAll('.btn[data-bs-toggle="collapse"]');

  buttons.forEach(btn => {
    btn.addEventListener('click', function() {
      // Toggle: se já ativo, remove
      if(this.classList.contains('active')) {
        this.classList.remove('active');
      } else {
        // Remove active de todos os outros
        buttons.forEach(b => b.classList.remove('active'));
        // Adiciona active ao clicado
        this.classList.add('active');
      }
    });
  });
</script>

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
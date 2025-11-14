@extends('layouts.main')

@section('title', 'Fonte Nova - Quizz')

@section('content')
  <div class="quiz-page">
    <div class="quiz-container">
      <!-- Tela inicial -->
      <div id="start-screen" class="screen active">
        <h1>FonteNova</h1>
        <h3>Salve a Água</h3>
        <br>
        <p class="quizz">
          A água é um dos recursos mais preciosos do planeta — e também um dos mais desperdiçados.
        </p>
        <p class="quizz">
          Neste quiz educativo, você irá responder a 7 perguntas simples sobre hábitos do dia a dia e descobrir quantos litros de água podem ser economizados com pequenas mudanças.
        </p>
        <p class="quizz">Prepare-se para aprender e fazer a diferença!</p>
        <button id="start-btn">Começar</button>
      </div>

      <!-- Quiz -->
      <div id="quiz-screen" class="screen">
        <h2 id="question">Pergunta</h2>
        <div class="answers">
          <button class="answer" id="a"></button>
          <button class="answer" id="b"></button>
          <button class="answer" id="c"></button>
        </div>
        <button id="next-btn" style="display: none;">Próxima</button>
      </div>

      <!-- Resultado -->
      <div id="result-screen" class="screen">
        <h2>Resultado</h2>
        <p id="score"></p>
        <p>
          Além de economizar água, atitudes conscientes ajudam a preservar o meio ambiente, reduzir sua conta de água e promover um futuro mais sustentável.
        </p>
        <p>
          Compartilhe este quiz com seus amigos e familiares para espalhar o conhecimento!
        </p>
        <button id="restart-btn">Refazer Quiz</button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('assets/js/quizz.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/quizz.css') }}">
@endpush


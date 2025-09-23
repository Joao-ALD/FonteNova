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
        <p>Responda 5 perguntas e descubra quanto de água você consegue salvar</p>
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
        <button id="restart-btn">Refazer Quiz</button>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <link rel="stylesheet" href="{{ asset('assets/css/quizz.css') }}">
  <script src="{{ asset('assets/js/quizz.js') }}"></script>
@endsection
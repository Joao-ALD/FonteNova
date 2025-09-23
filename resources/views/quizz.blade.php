@extends('layouts.main')

@section('title', 'Fonte Nova - Quizz')

@section('content')
<style>
  .quiz-page {
    background: #0288d1;
    width: 100%;
    min-height: calc(100vh - 100px);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 15px;
    box-sizing: border-box;
    font-family: 'Jersey 25', sans-serif;
  }

  .quiz-container {
    background: #0288d1;
    color: #fff;
    border-radius: 15px;
    padding: 30px;
    max-width: 500px;
    width: 100%;
    text-align: center;
    overflow: hidden;
    position: relative;
  }

  .screen {
    display: none;
    transition: all 0.5s ease;
  }

  .screen.active {
    display: block;
  }

  h1, h2 {
    margin-bottom: 20px;
  }

  p {
    font-size: 16px;
    color: #fff;
  }

  button {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    background: #1466c3;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  button:hover {
    background: #2575fc;
  }

  .answers button {
    width: 100%;
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    background-color: #f1f1f1;
    color: #333;
    transition: background 0.3s ease;
  }

  .answers button:hover {
    background-color: #ddd;
  }

  @import url('https://fonts.googleapis.com/css2?family=Jersey+25&display=swap');
</style>

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
<script>
  const quizData = [
    {
      question: "Quanto tempo você deve tomar banho para economizar água?",
      a: "20 minutos",
      b: "5 minutos",
      c: "15 minutos",
      correct: "b",
      liters: 60
    },
    {
      question: "O que é mais eficiente para escovar os dentes?",
      a: "Deixar a torneira aberta",
      b: "Fechar a torneira enquanto escova",
      c: "Escovar rápido sem fechar",
      correct: "b",
      liters: 6
    },
    {
      question: "Qual é a forma mais econômica de lavar roupa?",
      a: "Usar máquina com carga completa",
      b: "Lavar peça por peça",
      c: "Lavar roupa manualmente",
      correct: "a",
      liters: 50
    },
    {
      question: "Para que podemos reutilizar água da chuva em casa?",
      a: "Beber",
      b: "Regar plantas ou lavar áreas externas",
      c: "Descartar no vaso sanitário",
      correct: "b",
      liters: 30
    },
    {
      question: "Qual prática economiza mais água na cozinha?",
      a: "Lavar louça com a torneira aberta",
      b: "Lavar louça na pia com água acumulada",
      c: "Lavar louça no microondas",
      correct: "b",
      liters: 15
    }
  ];

  let currentQuiz = 0;
  let totalLiters = 0;
  let selectedAnswer = null;

  const startBtn = document.getElementById("start-btn");
  const restartBtn = document.getElementById("restart-btn");
  const nextBtn = document.getElementById("next-btn");

  const startScreen = document.getElementById("start-screen");
  const quizScreen = document.getElementById("quiz-screen");
  const resultScreen = document.getElementById("result-screen");

  const questionEl = document.getElementById("question");
  const a_btn = document.getElementById("a");
  const b_btn = document.getElementById("b");
  const c_btn = document.getElementById("c");
  const answersBtns = [a_btn, b_btn, c_btn];

  const scoreEl = document.getElementById("score");

  startBtn.addEventListener("click", () => {
    startScreen.classList.remove("active");
    quizScreen.classList.add("active");
    loadQuiz();
  });

  restartBtn.addEventListener("click", () => {
    currentQuiz = 0;
    totalLiters = 0;
    resultScreen.classList.remove("active");
    startScreen.classList.add("active");
  });

  function loadQuiz() {
    resetAnswers();
    const currentQuizData = quizData[currentQuiz];
    questionEl.innerText = currentQuizData.question;
    a_btn.innerText = currentQuizData.a;
    b_btn.innerText = currentQuizData.b;
    c_btn.innerText = currentQuizData.c;
  }

  function resetAnswers() {
    selectedAnswer = null;
    answersBtns.forEach(btn => {
      btn.disabled = false;
      btn.style.backgroundColor = "#f1f1f1";
    });
    nextBtn.style.display = "none";
  }

  answersBtns.forEach(button => {
    button.addEventListener('click', () => {
      selectedAnswer = button.id;

      answersBtns.forEach(btn => btn.disabled = true);

      // Aplica cor de feedback
      if (selectedAnswer === quizData[currentQuiz].correct) {
        button.style.backgroundColor = "#4caf50"; // verde
        totalLiters += quizData[currentQuiz].liters;
      } else {
        button.style.backgroundColor = "#f44336"; // vermelho
      }

      nextBtn.style.display = "inline-block";
    });
  });

  nextBtn.addEventListener("click", () => {
    currentQuiz++;
    if (currentQuiz < quizData.length) {
      loadQuiz();
    } else {
      quizScreen.classList.remove("active");
      resultScreen.classList.add("active");
      scoreEl.innerText = `Parabéns! Aplicando essas dicas, você pode economizar aproximadamente ${totalLiters} litros de água diariamente!`;
    }
  });
</script>
@endsection
const quizData = [
    {
        question: "Um banho de 15 minutos gasta cerca de 135L. Quantos litros economizamos ao reduzir o banho para 5 minutos?",
        a: "30 litros",
        b: "90 litros",
        c: "60 litros",
        correct: "b",
        liters: 90
    },
    {
        question: "O que é mais eficiente para escovar os dentes?",
        a: "Deixar a torneira aberta",
        b: "Usar um copo de água (ou fechar a torneira)",
        c: "Escovar rápido com a torneira 'meio aberta'",
        correct: "b",
        liters: 11
    },
    {
        question: "Ao usar a máquina de lavar, qual a forma mais econômica?",
        a: "Acumular roupas e usar a capacidade máxima (carga cheia)",
        b: "Lavar poucas peças em várias 'meias cargas'",
        c: "Lavar roupa manualmente no tanque",
        correct: "a",
        liters: 130
    },
    {
        question: "Uma torneira gotejando lentamente pode desperdiçar quantos litros por dia?",
        a: "Cerca de 5 litros",
        b: "Mais de 40 litros",
        c: "Exatamente 10 litros",
        correct: "b",
        liters: 46
    },
    {
        question: "Qual prática economiza mais água ao lavar louça?",
        a: "Lavar item por item com a torneira sempre aberta",
        b: "Limpar restos, ensaboar tudo (torneira fechada) e enxaguar de vez",
        c: "Usar a máquina de lavar louça meio vazia",
        correct: "b",
        liters: 100
    },
    {
        question: "Qual é a maneira mais econômica de lavar o carro?",
        a: "Usar uma mangueira com a água correndo livremente.",
        b: "Usar uma lavadora de alta pressão (WAP).",
        c: "Usar um balde com água e pano.",
        correct: "c",
        liters: 180
    },
    {
        question: "Qual é a forma mais econômica de limpar a calçada?",
        a: "Usar uma vassoura e, se necessário, um balde com água.",
        b: "Usar a mangueira com pressão, por 15 minutos.",
        c: "Usar a mangueira com pouca pressão, mas por mais tempo.",
        correct: "a",
        liters: 280
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

        if (selectedAnswer === quizData[currentQuiz].correct) {
            button.style.backgroundColor = "#4caf50";
            totalLiters += quizData[currentQuiz].liters;
        } else {
            button.style.backgroundColor = "#f44336";
            const correctBtn = document.getElementById(quizData[currentQuiz].correct);
            correctBtn.style.backgroundColor = "#4caf50";
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

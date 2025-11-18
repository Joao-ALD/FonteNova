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

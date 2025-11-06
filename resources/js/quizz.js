document.addEventListener("DOMContentLoaded", () => {
    const quizData = [
        {
            question: "Quanto tempo um banho de 5 minutos gasta em média?",
            options: {
                a: "15 litros de água",
                b: "45 litros de água",
                c: "100 litros de água",
            },
            correct: "b",
            liters: 45,
        },
        {
            question: "Deixar a torneira aberta ao escovar os dentes desperdiça em média:",
            options: {
                a: "1 litro de água",
                b: "5 litros de água",
                c: "12 litros de água",
            },
            correct: "c",
            liters: 12,
        },
        {
            question: "Qual eletrodoméstico consome mais água em um ciclo de lavagem?",
            options: {
                a: "Máquina de lavar louça",
                b: "Máquina de lavar roupa",
                c: "Ambos consomem a mesma quantidade",
            },
            correct: "b",
            liters: 135,
        },
        {
            question: "Uma pequena torneira a pingar pode desperdiçar até:",
            options: {
                a: "10 litros por dia",
                b: "46 litros por dia",
                c: "100 litros por dia",
            },
            correct: "b",
            liters: 46,
        },
        {
            question: "Qual a maneira mais eficiente de regar as plantas?",
            options: {
                a: "Durante o meio-dia, com sol forte",
                b: "No início da manhã ou no final da tarde",
                c: "A qualquer hora, com mangueira",
            },
            correct: "b",
            liters: 20,
        },
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
    const answerButtons = {
        a: document.getElementById("a"),
        b: document.getElementById("b"),
        c: document.getElementById("c"),
    };
    const progressEl = document.getElementById("progress");
    const scoreTextEl = document.getElementById("score-text");

    const setActiveScreen = (screen) => {
        [startScreen, quizScreen, resultScreen].forEach((s) =>
            s.classList.remove("active")
        );
        screen.classList.add("active");
    };

    const updateProgress = () => {
        const progressPercentage = (currentQuiz / quizData.length) * 100;
        progressEl.style.width = `${progressPercentage}%`;
    };

    const loadQuiz = () => {
        selectedAnswer = null;
        const currentQuizData = quizData[currentQuiz];
        questionEl.innerText = currentQuizData.question;
        for (const key in currentQuizData.options) {
            answerButtons[key].innerText = currentQuizData.options[key];
        }
        Object.values(answerButtons).forEach((btn) => {
            btn.disabled = false;
            btn.style.backgroundColor = "";
            btn.style.borderColor = "";
        });
        nextBtn.style.display = "none";
        updateProgress();
    };

    const showResult = () => {
        setActiveScreen(resultScreen);
        scoreTextEl.innerText = `Parabéns! Aplicando essas dicas, você pode economizar aproximadamente ${totalLiters} litros de água diariamente!`;
    };

    startBtn.addEventListener("click", () => {
        setActiveScreen(quizScreen);
        loadQuiz();
    });

    restartBtn.addEventListener("click", () => {
        currentQuiz = 0;
        totalLiters = 0;
        setActiveScreen(startScreen);
    });

    nextBtn.addEventListener("click", () => {
        currentQuiz++;
        if (currentQuiz < quizData.length) {
            loadQuiz();
        } else {
            showResult();
        }
    });

    Object.entries(answerButtons).forEach(([key, button]) => {
        button.addEventListener("click", () => {
            selectedAnswer = key;
            const currentQuizData = quizData[currentQuiz];
            Object.values(answerButtons).forEach((btn) => (btn.disabled = true));

            if (selectedAnswer === currentQuizData.correct) {
                button.style.backgroundColor = "#28a745";
                totalLiters += currentQuizData.liters;
            } else {
                button.style.backgroundColor = "#dc3545";
                answerButtons[currentQuizData.correct].style.backgroundColor =
                    "#28a745";
            }
            nextBtn.style.display = "inline-block";
        });
    });
});

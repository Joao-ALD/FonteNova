@extends('layouts.main')
 
@section('content')
<section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">
 
    <!-- Título -->
    <h1 class="display-1 fw-bold p">Tudo sobre a Água</h1>
 
    <!-- Subtítulo -->
    <p class="lead mt-3">
        Explore o mundo água: do clima à preservação, entenda como cada ação impacta o nosso recurso mais precioso.
    </p>
 
    <!-- Botões do tópicos -->
    <div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
        <button class="btn btn-outline-primary btn-lg px-4 active" data-target="#clima">Clima</button>
        <button class="btn btn-outline-primary btn-lg px-4" data-target="#coleta">Coleta</button>
        <button class="btn btn-outline-primary btn-lg px-4" data-target="#consumo">Consumo</button>
        <button class="btn btn-outline-primary btn-lg px-4" data-target="#preservacao">Preservação</button>
    </div>
 
    <!-- Conteúdos dos cards -->
    <div class="container mt-5">
        <!-- Clima -->
        <div id="clima" class="tab-content fade show">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card text-bg-info mb-3" style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title text-white text-end">Card de Clima 1</h5>
                            <p class="card-text text-white text-center">Aqui vai a informação sobre o clima. Este é o primeiro card.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card text-bg-info mb-3" style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title text-white text-end">Card de Clima 2</h5>
                            <p class="card-text text-white text-center">Mais detalhes climáticos podem ser adicionados aqui neste segundo card.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <!-- Coleta -->
        <div id="coleta" class="tab-content fade">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card text-bg-info mb-3" style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title text-white text-end">Card de Coleta 1</h5>
                            <p class="card-text text-white text-center">Informações sobre como a coleta da água funciona.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <!-- Consumo -->
        <div id="consumo" class="tab-content fade">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card text-bg-info mb-3" style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title text-white text-end">Card de Consumo 1</h5>
                            <p class="card-text text-white text-center">Dados e dicas sobre o consumo consciente da água.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <!-- Preservação -->
        <div id="preservacao" class="tab-content fade">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card text-bg-info mb-3" style="height: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title text-white text-end">Card de Preservação 1</h5>
                            <p class="card-text text-white text-center">A importância de preservar nossos recursos hídricos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</section>
 
<!-- CSS para animação fade -->
<style>
.tab-content {
    transition: opacity 0.5s ease-in-out;
    opacity: 0;
    display: none;
}
 
.tab-content.show {
    display: block;
    opacity: 1;
}
</style>
 
<!-- Script para alternar tabs com fade -->
<script>
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Remove active de todos os botões
        document.querySelectorAll('.btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
 
        // Pega o alvo
        const target = document.querySelector(btn.getAttribute('data-target'));
 
        // Remove show do card atual com fade
        document.querySelectorAll('.tab-content.show').forEach(current => {
            current.classList.remove('show');
        });
 
        // Aplica show ao novo card com pequeno delay para efeito fade
        setTimeout(() => {
            target.classList.add('show');
        }, 50);
    });
});
</script>
@endsection
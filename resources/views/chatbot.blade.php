@extends('layouts.main')

@section('content')

<section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">

    <!-- Subtítulo -->
    <h3 class="mt-3">Olá, quer fazer o uso sustentável da água?</h3>

    <!-- Campo de pergunta -->
    <div class="input-group my-4 w-75">
        <input type="text" id="mensagem" class="form-control form-control-lg" placeholder="Digite sua pergunta..." required autofocus>
        <button class="btn btn-primary btn-lg" id="enviar">Enviar</button>
    </div>

    <!-- Botões de Sugestões -->
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
        <button class="btn btn-outline-primary btn-lg sugestao">Como reutilizar água da chuva?</button>
        <button class="btn btn-outline-primary btn-lg sugestao">Como diminuir a conta de água?</button>
        <button class="btn btn-outline-primary btn-lg sugestao">Quais métodos de economia posso usar?</button>
        <button class="btn btn-outline-primary btn-lg sugestao">Preservação de rios e mananciais</button>
        <button class="btn btn-outline-primary btn-lg sugestao">Educação para uso sustentável</button>
    </div>

    <!-- Resposta do Chatbot -->
    <div id="resposta" class="alert alert-info d-none text-start w-75 mx-auto"></div>

</section>

<!-- Script -->
<script>
document.getElementById('enviar').addEventListener('click', enviarMensagem);
document.querySelectorAll('.sugestao').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('mensagem').value = btn.textContent;
        enviarMensagem();
    });
});

function enviarMensagem() {
    const msg = document.getElementById('mensagem').value;

    fetch("{{ route('chatbot.responder') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').content
        },
        body: JSON.stringify({ mensagem: msg })
    })
    .then(res => res.json())
    .then(data => {
        let resposta = `<p>${data.resumo}</p>
                        <a href="${data.link_site}" class="btn btn-sm btn-primary mt-2">Saiba mais</a>`;
        if (data.link_premium) {
            resposta += `<a href="${data.link_premium}" class="btn btn-sm btn-warning mt-2 ms-2">Conteúdo Premium</a>`;
        }
        document.getElementById('resposta').innerHTML = resposta;
        document.getElementById('resposta').classList.remove('d-none');
    });
}
</script>

@endsection
{{--
    View: ChatBot
    - Página que exibe a interface do chatbot voltada ao usuário final.
    - Contém campo de entrada, sugestões rápidas e área para exibir respostas.
    - A view realiza chamadas AJAX para a rota nomeada `chatbot.responder` e
        espera um JSON padronizado (success,status,data {...}).
    - Nota: links retornados pelo backend podem ser placeholders enquanto o
        trabalho dos demais membros estiver incompleto.
--}}
@extends('layouts.main')


@section('title', 'Fonte Nova - ChatBot')

@section('content')
<section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100 ">
    <!-- Subtítulo -->
    <h3 class="mt-3">Olá, quer fazer o uso sustentável da água?</h3>

    <!-- Campo de pergunta: usamos um form para melhorar acessibilidade (Enter envia) -->
    <form id="chat-form" class="input-group my-4 w-75" onsubmit="event.preventDefault(); enviarMensagem();">
        <input type="text" id="mensagem" name="mensagem" class="form-control form-control-lg" placeholder="Digite sua pergunta..." required autofocus aria-label="Pergunta ao chatbot">
        <button type="submit" class="btn btn-lg" id="enviar" style="background-color: rgba(20, 102, 195, 1); border-color: rgba(20, 102, 195, 1); color: white;" onmouseover="this.style.backgroundColor='rgba(33, 116, 212, 1)'; this.style.borderColor='rgba(33, 116, 212, 1)';" onmouseout="this.style.backgroundColor='rgba(20, 102, 195, 1)'; this.style.borderColor='rgba(20, 102, 195, 1)';">Enviar</button>
    </form>

    <!-- Botões de Sugestões -->
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
        <button class="btn btn-outline-primary btn-lg sugestao" style="border-color: rgba(20, 102, 195, 1); color: rgba(20, 102, 195, 1);" onmouseover="this.style.backgroundColor='rgba(20, 102, 195, 1)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(20, 102, 195, 1)';">Como reutilizar água da chuva?</button>
        <button class="btn btn-outline-primary btn-lg sugestao" style="border-color: rgba(20, 102, 195, 1); color: rgba(20, 102, 195, 1);" onmouseover="this.style.backgroundColor='rgba(20, 102, 195, 1)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(20, 102, 195, 1)';">Como diminuir a conta de água?</button>
        <button class="btn btn-outline-primary btn-lg sugestao" style="border-color: rgba(20, 102, 195, 1); color: rgba(20, 102, 195, 1);" onmouseover="this.style.backgroundColor='rgba(20, 102, 195, 1)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(20, 102, 195, 1)';">Quais métodos de economia posso usar?</button>
        <button class="btn btn-outline-primary btn-lg sugestao" style="border-color: rgba(20, 102, 195, 1); color: rgba(20, 102, 195, 1);" onmouseover="this.style.backgroundColor='rgba(20, 102, 195, 1)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(20, 102, 195, 1)';">Preservação de rios e mananciais</button>
        <button class="btn btn-outline-primary btn-lg sugestao" style="border-color: rgba(20, 102, 195, 1); color: rgba(20, 102, 195, 1);" onmouseover="this.style.backgroundColor='rgba(20, 102, 195, 1)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(20, 102, 195, 1)';">Educação para uso sustentável</button>
    </div>

    <!-- Resposta do Chatbot -->
    <div id="resposta" class="alert alert-info d-none text-start w-75 mx-auto" role="status" aria-live="polite"></div>

</section>
<script>
    // Ativa envio por Enter e ligações das sugestões
    document.getElementById('chat-form').addEventListener('submit', function (e) {
        e.preventDefault();
        enviarMensagem();
    });

    document.querySelectorAll('.sugestao').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('mensagem').value = btn.textContent;
            enviarMensagem();
        });
    });

    // Função utilitária para escapar texto antes de inserir no DOM
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/\"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    async function enviarMensagem() {
        const input = document.getElementById('mensagem');
        const btn = document.getElementById('enviar');
        const respostaEl = document.getElementById('resposta');
        const msg = input.value.trim();

        if (!msg) {
            respostaEl.classList.remove('d-none');
            respostaEl.classList.remove('alert-info');
            respostaEl.classList.add('alert-warning');
            respostaEl.innerHTML = '<strong>Por favor</strong> escreva uma pergunta.';
            return;
        }

        // Estado de loading
        btn.disabled = true;
        btn.textContent = 'Enviando...';
        respostaEl.classList.add('d-none');

        try {
            const res = await fetch("{{ route('chatbot.responder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ mensagem: msg })
            });

            if (!res.ok) {
                // Tenta extrair mensagem do corpo JSON se existir
                let errMsg = 'Erro na requisição. Tente novamente.';
                try { const err = await res.json(); if (err.message) errMsg = err.message; } catch(e){}
                respostaEl.classList.remove('d-none');
                respostaEl.classList.remove('alert-info');
                respostaEl.classList.add('alert-danger');
                respostaEl.innerHTML = escapeHtml(errMsg);
                return;
            }

            const data = await res.json();

            // Monta resposta de forma segura
            const content = [];
            content.push(`<p>${escapeHtml(data.data.resumo || data.data?.resumo || data.data)}</p>`);
            if (data.data.link_site) {
                content.push(`<a href="${escapeHtml(data.data.link_site)}" class="btn btn-sm btn-primary mt-2">Saiba mais</a>`);
            }
            if (data.data.link_premium) {
                content.push(`<a href="${escapeHtml(data.data.link_premium)}" class="btn btn-sm btn-warning mt-2 ms-2">Conteúdo Premium</a>`);
            }

            respostaEl.innerHTML = content.join('');
            respostaEl.classList.remove('d-none');
            respostaEl.classList.remove('alert-danger');
            respostaEl.classList.add('alert-info');

        } catch (err) {
            respostaEl.classList.remove('d-none');
            respostaEl.classList.remove('alert-info');
            respostaEl.classList.add('alert-danger');
            respostaEl.innerHTML = 'Erro de rede. Verifique sua conexão.';
        } finally {
            btn.disabled = false;
            btn.textContent = 'Enviar';
        }
    }
</script>
@endsection

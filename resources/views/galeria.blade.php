@extends('layouts.main')

@section('content')
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Galeria Interativa — Economia de Água</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --AzulEscuro: rgba(1, 75, 160, 1);
            --Azul2: rgba(10, 92, 184, 1);
            --Azul3: rgba(20, 102, 195, 1);
            --Azul4: rgba(33, 116, 212, 1);
            --AzulClaro: rgba(59, 142, 237, 1);
            --BrancoPuro: #ffffff;
            --Preto: #000000;

            --FontePrincipal: 'Poppins';
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            margin: 0;
            background: #fff;
            color: #053659;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .page {
            max-width: 1200px;
            margin: 36px auto;
            padding: 0 24px;
            text-align: center;
        }

        h1 {
            color: var(--AzulEscuro);
            margin-bottom: 30px;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 28px;
            align-items: start;
        }

        .card {
            background-color: var(--AzulClaro);
            border-radius: 15px;
            padding: 34px 18px 22px;
            cursor: pointer;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
            transition: transform .22s ease, box-shadow .22s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 260px;
            position: relative;
            outline: none;
            border: none;
        }

        .card:active {
            transform: scale(.99)
        }

        .card:focus {
            box-shadow: 0 8px 22px rgba(0, 0, 0, .15);
        }

        .card.dark {
            background: var(--AzulEscuro);
            color: var(--white);
        }

        .card.blueish {
            background: var(--AzulClaro);
        }

        .icon-wrap {
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            margin-bottom: 18px;
        }

        .caption {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.92);
            font-weight: 500;
        }

        /* small help text under cards when focused (for keyboard users) */
        .sr-only {
            position: absolute;
            left: -9999px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        /* Modal */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 60;
        }

        .modal {
            background: white;
            width: min(760px, 92%);
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 20px 50px rgba(6, 23, 45, 0.5);
        }

        .modal h2 {
            margin: 0 0 8px;
            color: var(--AzulEscuro);
        }

        .modal p {
            color: #164155;
            margin: 8px 0 18px;
            line-height: 1.5
        }

        .modal .close {
            background: var(--AzulEscuro);
            color: white;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600
        }

        /* small footer */
        .legend {
            margin-top: 26px;
            color: #2e586e;
            font-size: 14px
        }

        /* responsive tweaks */
        @media (max-width:560px) {
            h1 {
                font-size: 22px
            }

            .card {
                padding: 22px 12px;
                min-height: 220px
            }

            .icon-wrap {
                width: 96px;
                height: 96px
            }
        }

        .icon{
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <main class="page">
        <h1>Galeria Interativa</h1>

        <div class="gallery" role="list">

            <button class="card blueish" data-title="Coleta de chuva" data-desc="Instalações simples como calhas e caixas de armazenamento permitem aproveitar a água da chuva para jardinagem e limpeza. Economiza até 30% do consumo doméstico se usado em irrigação e descargas." aria-label="Coleta de chuva" role="listitem">
                <div class="icon-wrap" aria-hidden="true">
                    <!-- simple raindrop + bucket svg -->
                    <img class="icon" src="{{ asset('assets/img/icon_balde.svg') }}" alt="">
                </div>
                <div class="caption">Coleta de chuva</div>
                <span class="sr-only">Clique para ver instruções de coleta de chuva</span>
            </button>

            <button class="card dark" data-title="Reuso de água" data-desc="Filtre e reutilize águas de pias e chuveiros (graywater) em sistemas de descarga ou para irrigação. Exige cuidados de tratamento simples — reduz sensivelmente o consumo de água potável." aria-label="Reuso de água" role="listitem">
                <div class="icon-wrap" aria-hidden="true">
                    <!-- recycle drop icon -->
                    <img class="icon" src="{{ asset('assets/img/icon_water.svg') }}" alt="">
                </div>
                <div class="caption">Reuso de água</div>
                <span class="sr-only">Clique para ver instruções de reuso</span>
            </button>

            <button class="card" data-title="Cuidados à água" data-desc="Ações simples: consertar vazamentos, usar descargas econômicas e torneiras com arejador. Pequenas mudanças na rotina podem reduzir o consumo diário por pessoa em até 40 litros." aria-label="Cuidados à água" role="listitem">
                <div class="icon-wrap" aria-hidden="true">
                    <!-- hands holding drop -->
                    <img class="icon" src="{{ asset('assets/img/icon_hands.svg') }}" alt="">
                </div>
                <div class="caption">Cuidados à água</div>
                <span class="sr-only">Clique para ver instruções de cuidados</span>
            </button>

            <button class="card dark" data-title="Filtros naturais" data-desc="Filtros com camadas de areia, carvão e cascalho são ótimos para purificar água de reúso ou de chuva. São econômicos e fáceis de montar para uso não potável ou como pré-filtro." aria-label="Filtros naturais" role="listitem">
                <div class="icon-wrap" aria-hidden="true">
                    <!-- barrel filter -->
                    <img class="icon" src="{{ asset('assets/img/icon_filter.svg') }}" alt="">
                </div>
                <div class="caption">Filtros naturais</div>
                <span class="sr-only">Clique para ver instruções de filtros</span>
            </button>

        </div>

        <div class="legend">Clique em qualquer opção para ver instruções e dicas práticas.</div>

    </main>

    <!-- modal -->
    <div id="backdrop" class="modal-backdrop" role="dialog" aria-hidden="true">
        <div class="modal" role="document">
            <h2 id="modal-title">Título</h2>
            <p id="modal-desc">Descrição</p>
            <div style="text-align:right">
                <button id="closeBtn" class="close">Fechar</button>
            </div>
        </div>
    </div>

    <script>
        // progressive enhancement: cards behave as buttons and open a modal with instructions
        const cards = document.querySelectorAll('.card');
        const backdrop = document.getElementById('backdrop');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');
        const closeBtn = document.getElementById('closeBtn');

        function openModal(title, desc) {
            modalTitle.textContent = title;
            modalDesc.textContent = desc;
            backdrop.style.display = 'flex';
            backdrop.setAttribute('aria-hidden', 'false');
            closeBtn.focus();
        }

        function closeModal() {
            backdrop.style.display = 'none';
            backdrop.setAttribute('aria-hidden', 'true');
        }

        cards.forEach(card => {
            card.addEventListener('click', () => {
                openModal(card.dataset.title, card.dataset.desc);
            });
            card.addEventListener('keydown', (ev) => {
                if (ev.key === 'Enter' || ev.key === ' ') {
                    ev.preventDefault();
                    card.click();
                }
            });
        });

        closeBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>

</html>


@endsection
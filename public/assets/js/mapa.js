/*
    - Lógica de interatividade para o mapa vetorial da página inicial.
    - Utiliza a biblioteca jVectorMap.
    -
    - Funcionalidades:
    -   1. Renderização do mapa do Brasil.
    -   2. Lógica de clique (onRegionClick) para selecionar um estado.
    -   3. Destaque do estado selecionado (adiciona/remove classe CSS).
    -   4. Exibição e posicionamento de um "card" com informações do estado.
    -   5. Chamada AJAX para a API (`/api/estados/{uf}/iniciativas`) para buscar dados.
    -   6. Tratamento de múltiplos cliques e clique fora do mapa para fechar o card.
*/
$(function () {
    const mapa = $('#mapa-container');
    const card = $('#info-box');
    const cardContent = $('#info-content');

    let mapaObject; // Para armazenar a instância do mapa
    let estadoSelecionado = null;

    // Inicialização do mapa
    mapa.vectorMap({
        map: 'br_mill',
        backgroundColor: 'transparent',
        container: mapa,
        // Força recarregamento do SVG após mudanças
        mapData: {
            version: Date.now() // Timestamp para cache busting
        },
        regionStyle: {
            initial: {
                fill: '#014BA0' // Cor inicial dos estados
            },
            hover: {
                fill: '#0066CC', // Cor ao passar o mouse
                cursor: 'pointer'
            }
        },
        onRegionClick: function (event, code) {
            // Se o mesmo estado for clicado, deseleciona e esconde o card
            if (estadoSelecionado === code) {
                deselecionarEstado();
                return;
            }

            // Se um estado diferente for clicado, primeiro deseleciona o antigo
            if (estadoSelecionado) {
                deselecionarEstado(false); // Não esconde o card ainda
            }

            // Seleciona o novo estado
            estadoSelecionado = code;
            mapaObject = mapa.vectorMap('get', 'mapObject');
            mapaObject.regions[code].element.shape.addClass('estado-selecionado');

            // Exibe e posiciona o card
            posicionarCard(code);
            card.show();
            cardContent.html('Carregando...');

            // Busca os dados da API
            buscarIniciativas(code.toLowerCase());
        }
    });

    // Função para posicionar o card ao lado do estado
    function posicionarCard(code) {
        const mapaObject = mapa.vectorMap('get', 'mapObject');
        const regionElement = mapaObject.regions[code].element;
        const regionBBox = regionElement.getBBox(); // Bounding box do estado

        // Posição do container do mapa
        const mapaOffset = mapa.offset();

        // Calcula a posição do card (à esquerda do centro do estado)
        const cardTop = mapaOffset.top + regionBBox.y + (regionBBox.height / 2) - (card.outerHeight() / 2);
        const cardLeft = mapaOffset.left + regionBBox.x - card.outerWidth() - 20; // 20px de espaçamento

        card.css({
            top: `${cardTop}px`,
            left: `${cardLeft}px`,
            transform: 'none' // Remove o transform anterior se houver
        });
    }

    // Função para buscar dados da API
    function buscarIniciativas(uf) {
        $.ajax({
            url: `/mapa/info/${uf}`,
            method: 'GET',
            success: function (data) {
                if (data && data.iniciativas && data.iniciativas.length > 0) {
                    let html = `<h6>${data.nome}</h6><div class="iniciativas-list">`;
                    data.iniciativas.forEach(item => {
                        html += `
                            <div class="iniciativa-item mb-2 p-2 border-left border-primary">
                                <strong>${item.titulo}</strong>
                                <div class="mt-1">
                                    <span class="badge badge-${getStatusColor(item.status)} mr-1">${item.status}</span>
                                    <span class="badge badge-info">${item.tipo}</span>
                                </div>
                                <p class="small mt-2 mb-0">${item.descricao}</p>
                            </div>`;
                    });
                    html += '</div>';
                    cardContent.html(html);
                } else {
                    cardContent.html(`<h6>${data.nome}</h6><p class="text-muted">Nenhuma iniciativa encontrada.</p>`);
                }
            },
            error: function () {
                cardContent.html('<p class="text-danger">Erro ao carregar as iniciativas.</p>');
            }
        });
    }

    function getStatusColor(status) {
        switch(status) {
            case 'concluído': return 'success';
            case 'em_andamento': return 'warning';
            case 'planejado': return 'secondary';
            default: return 'primary';
        }
    }

    // Função para deselecionar o estado e esconder o card
    function deselecionarEstado(esconderCard = true) {
        if (estadoSelecionado) {
            const mapaObject = mapa.vectorMap('get', 'mapObject');
            mapaObject.regions[estadoSelecionado].element.shape.removeClass('estado-selecionado');
            estadoSelecionado = null;
            if (esconderCard) {
                card.hide();
            }
        }
    }

    // Clicar fora do mapa esconde o card
    $(document).on('click', function (e) {
        // Se o clique não foi no mapa nem no card
        if (!mapa.is(e.target) && mapa.has(e.target).length === 0 && !card.is(e.target) && card.has(e.target).length === 0) {
            deselecionarEstado();
        }
    });
});

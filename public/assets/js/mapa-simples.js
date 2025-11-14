$(document).ready(function() {
    // Função para buscar informações do estado
    function buscarInfoEstado(siglaEstado) {
        $.ajax({
            url: `/mapa/info/${siglaEstado}`,
            method: 'GET',
            success: function(data) {
                let html = `<h6>${data.nome}</h6>`;
                
                if (data.iniciativas && data.iniciativas.length > 0) {
                    html += '<div class="mt-3">';
                    data.iniciativas.forEach(function(iniciativa) {
                        html += `
                            <div class="mb-3 p-2 border-left border-primary">
                                <strong>${iniciativa.titulo}</strong>
                                <div class="mt-1">
                                    <span class="badge badge-primary">${iniciativa.tipo}</span>
                                    <span class="badge badge-secondary ml-1">${iniciativa.status}</span>
                                </div>
                                <p class="small mt-2 mb-0">${iniciativa.descricao}</p>
                            </div>
                        `;
                    });
                    html += '</div>';
                } else {
                    html += '<p class="text-muted mt-2">Nenhuma iniciativa encontrada.</p>';
                }
                
                $('#info-content').html(html);
            },
            error: function() {
                $('#info-content').html('<p class="text-danger">Erro ao carregar informações.</p>');
            }
        });
    }

    // Simular clique nos estados (você precisará adaptar para seu mapa SVG)
    $(document).on('click', '[data-estado]', function() {
        const siglaEstado = $(this).data('estado');
        buscarInfoEstado(siglaEstado);
    });
});
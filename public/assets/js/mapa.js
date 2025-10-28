$(document).ready(function() {
    var mapaUrl = $('#mapa-container').data('url');

    // Carregar o SVG no container
    $('#mapa-container').load(mapaUrl, function() {
        // Adicionar evento de clique para cada estado
        $('.estado').on('click', function() {
            var estadoId = $(this).attr('id');

            // Mudar a cor do estado selecionado
            $('.estado').css('fill', '#DCDCDC');
            $(this).css('fill', '#A9A9A9');

            // Buscar informações do estado via AJAX
            $.ajax({
                url: '/mapa/info/' + estadoId,
                type: 'GET',
                success: function(response) {
                    $('#info-title').text(response.nome);
                    $('#info-content').text(response.iniciativas);
                },
                error: function() {
                    $('#info-title').text('Erro');
                    $('#info-content').text('Não foi possível carregar as informações.');
                }
            });
        });
    });
});

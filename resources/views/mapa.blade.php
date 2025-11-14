@extends('layouts.main')

@section('title', 'Mapa Interativo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/mapa.css') }}">
@endpush

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-md-8">
            <div id="mapa-container" data-url="{{ asset('assets/img/mapa-brasil.svg') }}">
                <!-- O SVG do mapa será inserido aqui -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Filtros</h5>
                    <div class="form-group">
                        <label for="filtro-tipo">Tipo</label>
                        <select id="filtro-tipo" class="form-control">
                            <option value="">Todos</option>
                            <option value="água">Água</option>
                            <option value="ecologia">Ecologia</option>
                            <option value="saneamento">Saneamento</option>
                            <option value="energia">Energia</option>
                            <option value="conservação">Conservação</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filtro-status">Status</label>
                        <select id="filtro-status" class="form-control">
                            <option value="">Todos</option>
                            <option value="em_andamento">Em Andamento</option>
                            <option value="concluído">Concluído</option>
                            <option value="planejado">Planejado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="info-box" class="card">
                <div class="card-body">
                    <h5 class="card-title" id="info-title">Selecione um estado</h5>
                    <div id="info-content">Clique em um estado no mapa para ver as informações aqui.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="text-center">Estatísticas</h2>
            <div class="row">
                <div class="col-md-4">
                    <canvas id="chart-regiao"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="chart-tipo"></canvas>
                </div>
                <div class="col-md-4">
                    <h4>Investimento Total</h4>
                    <p id="investimento-total">R$ 0,00</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        window.exibirInfoEstado = function(sigla) {
            document.getElementById('info-content').innerHTML = '<p>Carregando...</p>';
            
            fetch(`/mapa/info/${sigla}`)
                .then(response => response.json())
                .then(data => {
                    let html = `<h6>${data.nome}</h6>`;
                    
                    if (Array.isArray(data.iniciativas) && data.iniciativas.length > 0) {
                        html += '<div class="mt-3">';
                        data.iniciativas.forEach(iniciativa => {
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
                    
                    document.getElementById('info-content').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('info-content').innerHTML = '<p class="text-danger">Erro ao carregar informações.</p>';
                });
        };
    </script>
@endpush

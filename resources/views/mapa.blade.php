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
            <div id="info-box" class="card">
                <div class="card-body">
                    <h5 class="card-title" id="info-title">Selecione um estado</h5>
                    <p class="card-text" id="info-content">Clique em um estado no mapa para ver as informações aqui.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/mapa.js') }}"></script>
@endpush

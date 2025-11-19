@extends('layouts.main')

@section('title', 'Editar Aula')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Aula: {{ $aula->titulo }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.cursos.update', $aula->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título da Aula</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $aula->titulo) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ordem" class="form-label">Ordem de Exibição</label>
                            <input type="number" class="form-control" id="ordem" name="ordem" value="{{ old('ordem', $aula->ordem) }}" required>
                            <small class="text-muted">Define a sequência das aulas (1, 2, 3...)</small>
                        </div>

                        <div class="mb-3">
                            <label for="video_embed_url" class="form-label">Link do Vídeo (Embed)</label>
                            <input type="text" class="form-control" id="video_embed_url" name="video_embed_url" value="{{ old('video_embed_url', $aula->video_embed_url) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_html" class="form-label">Conteúdo da Aula</label>
                            <textarea class="form-control" id="descricao_html" name="descricao_html" rows="6" required>{{ old('descricao_html', $aula->descricao_html) }}</textarea>
                            <small class="text-muted">Você pode escrever tags HTML aqui se necessário.</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
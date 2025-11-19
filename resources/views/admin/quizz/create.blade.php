@extends('layouts.main')

@section('title', 'Criar Nova Pergunta do Quizz')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Criar Nova Pergunta do Quizz</h4>
                </div>
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6>Corrija os seguintes erros:</h6>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.quizz.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="pergunta" class="form-label fw-bold">Texto da Pergunta</label>
                            <textarea class="form-control" id="pergunta" name="pergunta" rows="3" required>{{ old('pergunta') }}</textarea>
                        </div>

                        <hr>
                        <h5>Opções de Resposta e Correção</h5>

                        <div class="mb-3">
                            <label for="opcao_a" class="form-label">Opção A</label>
                            <input type="text" class="form-control" id="opcao_a" name="opcao_a" value="{{ old('opcao_a') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="opcao_b" class="form-label">Opção B</label>
                            <input type="text" class="form-control" id="opcao_b" name="opcao_b" value="{{ old('opcao_b') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="opcao_c" class="form-label">Opção C</label>
                            <input type="text" class="form-control" id="opcao_c" name="opcao_c" value="{{ old('opcao_c') }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="resposta_correta" class="form-label fw-bold">Resposta Correta</label>
                                <select class="form-select" id="resposta_correta" name="resposta_correta" required>
                                    <option value="">Selecione a correta</option>
                                    <option value="a" {{ old('resposta_correta') == 'a' ? 'selected' : '' }}>A</option>
                                    <option value="b" {{ old('resposta_correta') == 'b' ? 'selected' : '' }}>B</option>
                                    <option value="c" {{ old('resposta_correta') == 'c' ? 'selected' : '' }}>C</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="litros_economizados" class="form-label fw-bold">Litros Economizados</label>
                                <input type="number" class="form-control" id="litros_economizados" name="litros_economizados" value="{{ old('litros_economizados') }}" min="0" required>
                                <small class="text-muted">Valor em litros se o usuário acertar.</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="ordem" class="form-label fw-bold">Ordem de Exibição</label>
                            <input type="number" class="form-control" id="ordem" name="ordem" value="{{ old('ordem') }}" min="1" required>
                            <small class="text-danger">Escolha uma ordem única (1, 2, 3...).</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.quizz.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar Pergunta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
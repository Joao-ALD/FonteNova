@extends('layouts.main')

@section('title', 'Gerenciar Perguntas do Quizz')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gerenciar Perguntas do Quizz</h2>
            <a href="{{ route('admin.quizz.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nova Pergunta
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="ps-4">Ordem</th>
                                <th scope="col">Pergunta</th>
                                <th scope="col">Correta</th>
                                <th scope="col">Litros</th>
                                <th scope="col" class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perguntas as $pergunta)
                                <tr>
                                    <td class="ps-4 align-middle">
                                        <span class="badge bg-secondary rounded-pill">{{ $pergunta->ordem }}</span>
                                    </td>
                                    <td class="align-middle fw-bold" style="max-width: 400px;">
                                        {{ Str::limit($pergunta->pergunta, 80) }}
                                    </td>
                                    <td class="align-middle text-success fw-bold">
                                        {{ strtoupper($pergunta->resposta_correta) }}
                                    </td>
                                    <td class="align-middle text-info">
                                        {{ $pergunta->litros_economizados }} L
                                    </td>
                                    <td class="text-end pe-4 align-middle">

                                        <a href="{{ route('admin.quizz.edit', $pergunta->id) }}"
                                            class="btn btn-sm btn-outline-primary me-2">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        <form action="{{ route('admin.quizz.destroy', $pergunta->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Tem certeza que deseja EXCLUIR a pergunta? Esta ação é irreversível!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Excluir
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        Nenhuma pergunta do Quizz cadastrada ainda. Use o botão "Nova Pergunta".
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
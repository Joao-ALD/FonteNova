@extends('layouts.main')

@section('title', 'Gerenciar Aulas')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Aulas do Curso</h2>
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
                            <th scope="col">Título da Aula</th>
                            <th scope="col">Atualizado em</th>
                            <th scope="col" class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aulas as $aula)
                            <tr>
                                <td class="ps-4 align-middle">
                                    <span class="badge bg-secondary rounded-pill">{{ $aula->ordem }}</span>
                                </td>
                                <td class="align-middle fw-bold">
                                    {{ $aula->titulo }}
                                </td>
                                <td class="align-middle text-muted">
                                    {{ $aula->updated_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-end pe-4 align-middle">
                                    <a href="{{ route('admin.cursos.edit', $aula->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    Nenhuma aula cadastrada ainda.
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
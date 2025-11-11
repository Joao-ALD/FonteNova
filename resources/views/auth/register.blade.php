@extends('layouts.main')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h2 class="text-center mb-4" style="color: black; font-weight: 800;">
                        Criar Conta
                    </h2>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4" role="alert">
                            <strong>Ops!</strong> Algo deu errado.
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nome</label>
                            <input id="name" class="form-control form-control-lg" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input id="email" class="form-control form-control-lg" type="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Senha</label>
                            <input id="password" class="form-control form-control-lg" type="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Senha</label>
                            <input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required>
                        </div>


                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a class="small" href="{{ route('login') }}" style="color: var(--AzulClaro);">
                                Já tem uma conta?
                            </a>

                            <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--AzulEscuro); border-color: var(--AzulEscuro); font-weight: 600;">
                                Registrar
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
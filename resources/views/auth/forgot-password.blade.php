@extends('layouts.main') {{-- Usando o seu layout principal --}}

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h2 class="text-center mb-3" style="color: black; font-weight: 800;">
                            Esqueceu a Senha?
                        </h2>

                        <p class="text-center text-muted mb-4">
                            Sem problemas. Apenas nos informe seu endereço de e-mail e nós enviaremos um link para redefinir
                            sua senha.
                        </p>

                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

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

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input id="email" class="form-control form-control-lg" type="email" name="email"
                                    value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2"
                                    style="background-color: var(--AzulEscuro); border-color: var(--AzulEscuro); font-weight: 600;">
                                    Enviar Link de Redefinição
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
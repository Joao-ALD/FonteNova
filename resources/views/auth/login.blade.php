@extends('layouts.main') {{-- Usando o seu layout principal --}}

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                {{-- O 'card' do Bootstrap --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h2 class="text-center mb-4" style="color: black; font-weight: 800;">
                            Login
                        </h2>

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

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input id="email" class="form-control form-control-lg" type="email" name="email"
                                    value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Senha</label>
                                <input id="password" class="form-control form-control-lg" type="password" name="password"
                                    required>
                            </div>

                            <div class="mb-3 form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label" for="remember_me">Manter Conectado</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}" style="color: var(--AzulClaro);">
                                        Esqueceu sua senha?
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-primary px-4 py-2"
                                    style="background-color: var(--AzulEscuro); border-color: var(--AzulEscuro); font-weight: 600;">
                                    Entrar
                                </button>
                            </div>

                            <hr class="my-4">

                            <div class="text-center">
                                <p class="mb-0">Não tem uma conta?</p>
                                <a href="{{ route('register') }}" style="color: var(--AzulClaro); font-weight: 600;">Crie
                                    uma agora</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
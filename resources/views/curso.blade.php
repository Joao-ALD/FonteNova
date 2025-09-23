@extends('layouts.main')

@section('title', 'FonteNova - Curso')

@section('content')
<div class="container fluid">
    <div class="row">
        <div class="col-md-2 bg-AzulClaro text-white p-1 vh-50 d-flex flex-column">
            <button class="btn btn-dark w-100">
                <i class="bi bi-chevron-right"></i>
            </button>

            <div class="list-group list-group-flush mt-2">
                @for ($i = 1; $i <= 24; $i++)
                <a href="#" class="list-group-item list-group-item-action bg-AzulClaro text-white d-flex justify-content-between align-items-center">
                Aula {{$i}}
                <i class="bi bi-chevron-right"></i>
                </a>
                @endfor
            </div>
        </div>
        <!-- Conteúdo principal -->
        <div class="col-md-10 p-5">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...
            </p>

            <!-- Vídeo -->
            <div class="ratio ratio-16x9 mb-4">
                <iframe src="https://www.youtube.com/embed/jTEDNjVDuqE" title="Video player" allowfullscreen></iframe>
            </div>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...
            </p>

            <ul>
                <li>Lorem Ipsum Dolor</li>
                <li>Lorem Ipsum Dolor</li>
                <li>Lorem Ipsum Dolor</li>
                <li>Lorem Ipsum Dolor</li>
                <li>Lorem Ipsum Dolor</li>
            </ul>

            <div class="text-end mt-4">
                <button class="btn text-white bg-AzulClaro">Próximo</button>
            </div>
        </div>
     </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>E-books</h1>
    <div class="row">
        @foreach($ebooks as $ebook)
        <div class="col-md-4">
            <div class="card mb-3 p-3">
                <h5>{{ $ebook->title }}</h5>
                <p>{{ $ebook->summary }}</p>
                <a href="{{ route('ebooks.show', $ebook->slug) }}" class="btn btn-primary">Abrir</a>
                @if($ebook->is_paid)
                    <span class="badge bg-warning text-dark">Pago</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

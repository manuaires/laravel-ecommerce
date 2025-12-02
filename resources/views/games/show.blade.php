@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 d-flex align-items-start justify-content-center">
        @php
            $imgPath = $game->image ? 'images/' . $game->image : null;
        @endphp

        @if($imgPath && file_exists(public_path($imgPath)))
            <img src="{{ asset($imgPath) }}" class="fixed-game-img" alt="{{ $game->name }}">
        @else
            <img src="https://via.placeholder.com/420x280?text=Sem+imagem" class="fixed-game-img" alt="Imagem não disponível">
        @endif
    </div>
    <div class="col-md-6">
        <h1>{{ $game->name }}</h1>
        <p class="h3 text-purple">R$ {{ number_format($game->price, 2, ',', '.') }}</p>
        <p>{{ $game->description }}</p>
         @if($game->release_date)
        <p class="text-muted"><strong>Data de lançamento:</strong> {{ $game->release_date->format('d/m/Y') }}</p>
        @endif
        
        @if($game->category)
        <p><strong>Categoria:</strong> {{ $game->category->name }}</p>
        @endif

        <form action="{{ route('cart.add', $game) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-shopping-cart"></i> Adicionar ao carrinho
            </button>
        </form>
    </div>
</div>

<style>
.fixed-game-img {
    width: 420px;
    height: 420px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    display: block;
}

.text-purple {
    color: #6f42c1;
}

/* Responsivo em telas menores: mantém proporção, ocupa largura do container */
@media (max-width: 767.98px) {
    .fixed-game-img {
        width: 100%;
        height: 260px;
    }
}
</style>
@endsection
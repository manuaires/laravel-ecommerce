@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Nossos Jogos</h1>
    </div>
</div>

<div class="row">
    @foreach($games as $game)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ $game->image ?? 'https://via.placeholder.com/400x300' }}" class="card-img-top" alt="{{ $game->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $game->name }}</h5>
                <p class="card-text">{{ Str::limit($game->description, 100) }}</p>
                <p class="h5">${{ number_format($game->price, 2) }}</p>
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('games.show', $game) }}" class="btn btn-primary">Ver Detalhes</a>
                <form action="{{ route('cart.add', $game) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Adicionar ao carrinho</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-12">
        {{ $games->links() }}
    </div>
</div>
@endsection
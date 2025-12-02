@extends('layouts.app')

@section('content')
<div class="container mt-5 games-container">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 text-center">
                <i class="fas fa-star"></i> Nossos Jogos
            </h1>
            <p class="text-center text-muted">Escolha os melhores jogos do mercado</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse($games as $game)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card h-100 shadow-sm border-0 game-card">
                <div class="card-img-wrapper position-relative" style="height: 220px; overflow: hidden; background-color: #f0f0f0;">
                    @if($game->image)
                        <img src="{{ asset('images/' . $game->image) }}" 
                             class="card-img-top w-100 h-100" 
                             alt="{{ $game->name }}"
                             style="object-fit: cover;">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary">
                            <i class="fas fa-image text-white" style="font-size: 48px;"></i>
                        </div>
                    @endif
                </div>
                
                <div class="card-body">
                    <h5 class="card-title">{{ $game->name }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($game->description, 80) }}</p>
                    <p class="text-purple fw-bold fs-5">
                        R$ {{ number_format($game->price, 2, ',', '.') }}
                    </p>
                </div>
                
                <div class="card-footer bg-white border-top">
                    <div class="d-grid gap-2">
                        <a href="{{ route('games.show', $game) }}" class="btn btn-outline-purple btn-sm">
                            <i class="fas fa-info-circle"></i> Detalhes
                        </a>
                        <form action="{{ route('cart.add', $game) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 btn-sm">
                                <i class="fas fa-shopping-cart"></i> Carrinho
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-inbox" style="font-size: 48px;"></i>
                <p class="mt-3 fs-5">Nenhum jogo disponível no momento</p>
            </div>
        </div>
        @endforelse
    </div>

    @if($games->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $games->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .games-container {
        padding-bottom: 140px; /* espaçamento entre últimos cards e o footer */
    }

    .game-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .game-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
    }
    
    .card-img-wrapper {
        overflow: hidden;
    }
    
    .card-img-wrapper img {
        transition: transform 0.3s ease;
    }
    
    .game-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }
    
    .card-title {
        font-weight: 600;
        color: #333;
        min-height: 50px;
        display: flex;
        align-items: center;
    }

    /* Preço roxo */
    .text-purple {
        color: #6f42c1 !important;
    }

    /* botão detalhe roxo */
    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }
    .btn-outline-purple:hover,
    .btn-outline-purple:focus {
        background-color: #6f42c1;
        color: #fff;
        box-shadow: 0 6px 18px rgba(111,66,193,.18) !important;
    }
</style>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mt-5 home-container">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 text-center">
                <i class="fas fa-home"></i> Bem-vindo ao GameShop
            </h1>
            <p class="text-center text-muted">Sua loja de jogos favorita</p>
        </div>
    </div>

    @if (session('status'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Card Bem-vindo -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle"></i> Bem-vindo, {{ Auth::user()->name }}!
                    </h5>
                </div>
                <div class="card-body">
                    <p class="lead">Você está autenticado no sistema.</p>
                    <p class="text-muted">Explore nossa loja de jogos e aproveite as melhores ofertas do mercado.</p>
                    <a href="{{ route('games.index') }}" class="btn btn-purple btn-lg mt-3">
                        <i class="fas fa-star"></i> Ver Todos os Jogos
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Carrinho -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-shopping-cart"></i> Seu Carrinho
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = count($cartItems);
                        $cartTotal = array_sum(array_map(function($item) { 
                            return $item['price'] * $item['quantity']; 
                        }, $cartItems));
                    @endphp
                    <p class="h4">
                        <strong>{{ $cartCount }}</strong> {{ $cartCount == 1 ? 'item' : 'itens' }} no carrinho
                    </p>
                    <p class="text-purple h5 fw-bold">
                        Total: R$ {{ number_format($cartTotal, 2, ',', '.') }}
                    </p>
                    @if($cartCount > 0)
                        <a href="{{ route('cart.index') }}" class="btn btn-success btn-lg mt-3">
                            <i class="fas fa-arrow-right"></i> Ir para Carrinho
                        </a>
                    @else
                        <p class="text-muted mt-3">Seu carrinho está vazio. Comece a comprar agora!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <!-- Card Pedidos -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt"></i> Meus Pedidos
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $ordersCount = Auth::user()->orders->count();
                    @endphp
                    <p class="h4">
                        <strong>{{ $ordersCount }}</strong> {{ $ordersCount == 1 ? 'pedido' : 'pedidos' }} realizados
                    </p>
                    <p class="text-muted">Acompanhe o status de todos os seus pedidos.</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-purple btn-lg mt-3">
                        <i class="fas fa-eye"></i> Ver Pedidos
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Dicas -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb"></i> Dicas & Informações
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> 
                            <strong>Fácil de usar:</strong> Navegue entre os jogos com facilidade
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> 
                            <strong>Seguro:</strong> Seus dados estão protegidos
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> 
                            <strong>Rápido:</strong> Finalize suas compras em poucos cliques
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i> 
                            <strong>Suporte:</strong> Estamos aqui para ajudar
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Destaque -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="alert alert-info border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-star me-3" style="font-size: 24px;"></i>
                    <div>
                        <h5 class="mb-0">Confira Nossas Promoções!</h5>
                        <p class="mb-0 small">Explore novos jogos e aproveite as melhores ofertas do mercado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .home-container {
        padding-bottom: 140px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
    }

    .card-header {
        background-color: #13012e !important;
        border-bottom: 2px solid #6f42c1;
    }

    .card-header h5 {
        color: white;
        font-weight: 600;
    }

    .text-purple {
        color: #6f42c1 !important;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: #fff;
        border-color: #6f42c1;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        color: #fff;
        border-color: #5a32a3;
        box-shadow: 0 6px 18px rgba(111, 66, 193, 0.25) !important;
    }

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: #fff;
        box-shadow: 0 6px 18px rgba(111, 66, 193, 0.18) !important;
    }

    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d9ff;
        color: #004085;
    }

    @media (max-width: 768px) {
        .home-container {
            padding-top: 1rem;
        }

        .btn-lg {
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
@endsection

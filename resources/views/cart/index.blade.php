@extends('layouts.app')

@section('content')
<div class="container mt-5 cart-container">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 text-center">
                <i class="fas fa-shopping-cart"></i> Meu Carrinho
            </h1>
            <p class="text-center text-muted">Revise seus itens antes de finalizar a compra</p>
        </div>
    </div>

    @if(count($cartItems) > 0)
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-image"></i> Jogo</th>
                            <th class="text-center">Preço</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr class="align-middle">
                            <td>
                                @php
                                    $imgPath = $item['image'] ? 'images/' . $item['image'] : null;
                                @endphp
                                @if($imgPath && file_exists(public_path($imgPath)))
                                    <img src="{{ asset($imgPath) }}" width="60" height="60" class="me-3 rounded" style="object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/60?text=Sem+imagem" width="60" height="60" class="me-3 rounded">
                                @endif
                                <strong>{{ $item['name'] }}</strong>
                            </td>
                            <td class="text-center text-purple fw-bold">
                                R$ {{ number_format($item['price'], 2, ',', '.') }}
                            </td>
                            <td>
                                <form action="{{ route('cart.update', $item['game_id']) }}" method="POST" class="d-flex justify-content-center">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="form-control form-control-sm" style="width: 80px;" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="text-center text-purple fw-bold">
                                R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove', $item['game_id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Remover
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light fw-bold fs-5">
                            <td colspan="3" class="text-end">
                                <i class="fas fa-receipt"></i> Total do Carrinho:
                            </td>
                            <td class="text-center text-purple">
                                R$ {{ number_format($total, 2, ',', '.') }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-12 d-flex justify-content-between gap-3">
            <a href="{{ route('games.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left"></i> Continuar Comprando
            </a>
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                <i class="fas fa-credit-card"></i> Ir ao Pagamento
            </a>
        </div>
    </div>

    @else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-inbox" style="font-size: 48px;"></i>
                <p class="mt-3 fs-5">Seu carrinho está vazio</p>
                <a href="{{ route('games.index') }}" class="btn btn-purple mt-3">
                    <i class="fas fa-star"></i> Ver Nossos Jogos
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .cart-container {
        padding-bottom: 140px;
    }

    .table {
        margin-bottom: 0;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .text-purple {
        color: #6f42c1 !important;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: #fff;
        border-color: #6f42c1;
    }

    .btn-purple:hover,
    .btn-purple:focus {
        background-color: #5a32a3;
        color: #fff;
        border-color: #5a32a3;
        box-shadow: 0 6px 18px rgba(111, 66, 193, 0.25) !important;
    }

    .form-control-sm {
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }

    .form-control-sm:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }

    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }

        .btn-lg {
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-5 orders-container">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 text-center">
                <i class="fas fa-receipt"></i> Pedido #{{ $order->id }}
            </h1>
            <p class="text-center text-muted">
                <i class="fas fa-calendar"></i> Realizado em {{ $order->created_at->format('d/m/Y \à\s H:i') }}
            </p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Detalhes do Pedido -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> Detalhes do Pedido
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Status do Pedido</label>
                        <p>
                            @if($order->status == 'completed')
                                <span class="badge bg-success" style="font-size: 1rem;">
                                    <i class="fas fa-check-circle"></i> Concluído
                                </span>
                            @elseif($order->status == 'pending')
                                <span class="badge bg-warning" style="font-size: 1rem;">
                                    <i class="fas fa-hourglass-half"></i> Pendente
                                </span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge bg-danger" style="font-size: 1rem;">
                                    <i class="fas fa-times-circle"></i> Cancelado
                                </span>
                            @else
                                <span class="badge bg-info" style="font-size: 1rem;">
                                    <i class="fas fa-cog"></i> {{ ucfirst($order->status) }}
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Total do Pedido</label>
                        <p class="h4 text-purple fw-bold">
                            R$ {{ number_format($order->total, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">ID do Pedido</label>
                        <p class="text-monospace">{{ $order->id }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumo Rápido -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-shopping-bag"></i> Resumo
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Quantidade de Itens</label>
                        <p class="h4 fw-bold">
                            {{ $order->items->count() }} {{ $order->items->count() == 1 ? 'item' : 'itens' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Valor Total</label>
                        <p class="h4 text-purple fw-bold">
                            R$ {{ number_format($order->total, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle"></i> 
                            @if($order->status == 'completed')
                                Seu pedido foi entregue com sucesso!
                            @elseif($order->status == 'pending')
                                Seu pedido está sendo processado. Acompanhe o status aqui.
                            @else
                                Para mais informações, entre em contato conosco.
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Itens do Pedido -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> Itens do Pedido
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-gamepad"></i> Jogo</th>
                                    <th class="text-center">Preço Unitário</th>
                                    <th class="text-center">Quantidade</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->game->name }}</strong>
                                    </td>
                                    <td class="text-center text-purple fw-bold">
                                        R$ {{ number_format($item->price, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-center text-purple fw-bold">
                                        R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold fs-5">
                                    <td colspan="3" class="text-end">
                                        <i class="fas fa-calculator"></i> Total:
                                    </td>
                                    <td class="text-center text-purple">
                                        R$ {{ number_format($order->total, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="row mt-5 mb-5">
        <div class="col-12 d-flex justify-content-between gap-3">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left"></i> Voltar aos Pedidos
            </a>
            <a href="{{ route('games.index') }}" class="btn btn-purple btn-lg">
                <i class="fas fa-star"></i> Continuar Comprando
            </a>
        </div>
    </div>
</div>

<style>
    .orders-container {
        padding-bottom: 140px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
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

    .text-monospace {
        font-family: 'Courier New', monospace;
        background-color: #f8f9fa;
        padding: 0.5rem;
        border-radius: 4px;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        font-weight: 600;
    }

    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d9ff;
        color: #004085;
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

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }

        .btn-lg {
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
        }

        .row {
            flex-direction: column-reverse;
        }
    }
</style>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mt-5 orders-container">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 text-center">
                <i class="fas fa-receipt"></i> Meus Pedidos
            </h1>
            <p class="text-center text-muted">Acompanhe todos os seus pedidos realizados</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($orders->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-shopping-bag"></i> Histórico de Pedidos
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> Pedido #</th>
                                    <th><i class="fas fa-calendar"></i> Data</th>
                                    <th><i class="fas fa-box"></i> Itens</th>
                                    <th><i class="fas fa-money-bill"></i> Total</th>
                                    <th><i class="fas fa-info-circle"></i> Status</th>
                                    <th class="text-center"><i class="fas fa-cog"></i> Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <strong>#{{ $order->id }}</strong>
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        {{ $order->items->count() }} {{ $order->items->count() == 1 ? 'item' : 'itens' }}
                                    </td>
                                    <td class="text-purple fw-bold">
                                        R$ {{ number_format($order->total, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        @if($order->status == 'completed')
                                            <span class="badge bg-success" style="font-size: 0.85rem;">
                                                <i class="fas fa-check-circle"></i> Concluído
                                            </span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge bg-warning" style="font-size: 0.85rem;">
                                                <i class="fas fa-hourglass-half"></i> Pendente
                                            </span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge bg-danger" style="font-size: 0.85rem;">
                                                <i class="fas fa-times-circle"></i> Cancelado
                                            </span>
                                        @else
                                            <span class="badge bg-info" style="font-size: 0.85rem;">
                                                <i class="fas fa-cog"></i> {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-purple btn-sm">
                                            <i class="fas fa-eye"></i> Ver Detalhes
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($orders->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
            @endif

            @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 64px; color: #ccc;"></i>
                    <p class="mt-4 fs-5 text-muted">Você não realizou nenhum pedido ainda.</p>
                    <a href="{{ route('games.index') }}" class="btn btn-purple btn-lg mt-3">
                        <i class="fas fa-star"></i> Veja Nossos Jogos
                    </a>
                </div>
            </div>
            @endif
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

    .table {
        margin-bottom: 0;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .text-purple {
        color: #6f42c1 !important;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        font-weight: 600;
    }

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-purple:hover,
    .btn-outline-purple:focus {
        background-color: #6f42c1;
        color: #fff;
        box-shadow: 0 6px 18px rgba(111, 66, 193, 0.18) !important;
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

    @media (max-width: 768px) {
        .table {
            font-size: 0.85rem;
        }

        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
        }
    }
</style>
@endsection
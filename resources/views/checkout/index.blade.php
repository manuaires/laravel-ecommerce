@extends('layouts.app')

@section('content')
<div class="container mt-5 checkout-container">
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="display-5 text-center">
                <i class="fas fa-credit-card"></i> Finalizar Compra
            </h1>
            <p class="text-center text-muted">Revise seus itens e complete o pagamento</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Resumo do Pedido -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt"></i> Resumo do Pedido
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-gamepad"></i> Jogo</th>
                                    <th class="text-center">Preço</th>
                                    <th class="text-center">Quantidade</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item['name'] }}</strong>
                                    </td>
                                    <td class="text-center text-purple fw-bold">
                                        R$ {{ number_format($item['price'], 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item['quantity'] }}
                                    </td>
                                    <td class="text-center text-purple fw-bold">
                                        R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
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
                                        R$ {{ number_format($total, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações de Pagamento -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-lock"></i> Dados do Cartão
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Nome no Cartão
                            </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="João Silva" required>
                        </div>

                        <div class="mb-3">
                            <label for="card" class="form-label">
                                <i class="fas fa-credit-card"></i> Número do Cartão
                            </label>
                            <input type="text" class="form-control" id="card" name="card" placeholder="1234 5678 9012 3456" maxlength="19" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="expiry" class="form-label">
                                    <i class="fas fa-calendar"></i> Vencimento
                                </label>
                                <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label">
                                    <i class="fas fa-shield-alt"></i> CVV
                                </label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" maxlength="4" required>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i> Seus dados de pagamento são seguros e criptografados.
                            </small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check"></i> Confirmar Pedido
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar ao Carrinho
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .checkout-container {
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

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .form-control {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
        box-shadow: 0 6px 18px rgba(40, 167, 69, 0.25) !important;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d9ff;
        color: #004085;
    }

    @media (max-width: 768px) {
        .checkout-container {
            padding-top: 1rem;
        }

        .row {
            flex-direction: column-reverse;
        }
    }
</style>
@endsection
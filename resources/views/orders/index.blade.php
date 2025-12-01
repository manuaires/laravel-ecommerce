@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Meus Pedidos</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if($orders->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pedido #</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">Visualizar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
        @else
        <div class="alert alert-info">
            Você não realizou nenhum pedido ainda. <a href="{{ route('games.index') }}">Veja nossos jogos!</a>.
        </div>
        @endif
    </div>
</div>
@endsection
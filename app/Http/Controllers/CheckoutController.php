<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('games.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('games.index')->with('error', 'Seu carrinho está vazio!');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pendente'
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'game_id' => $item['game_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pedido realizado com sucesso!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;
        
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Game $game, Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$game->id])) {
            $cart[$game->id]['quantity']++;
        } else {
            $cart[$game->id] = [
                'game_id' => $game->id,
                'name' => $game->name,
                'price' => $game->price,
                'quantity' => 1,
                'image' => $game->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Jogo adicionado ao carrinho com sucesso!');
    }

    public function remove($gameId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$gameId])) {
            unset($cart[$gameId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Jogo removido do carrinho!');
    }

    public function update(Request $request, $gameId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$gameId])) {
            $cart[$gameId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrinho atualizado com sucesso!');
    }
}
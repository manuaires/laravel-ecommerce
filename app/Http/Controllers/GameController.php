<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('category')->latest()->paginate(12);
        return view('games.index', compact('games'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }
}
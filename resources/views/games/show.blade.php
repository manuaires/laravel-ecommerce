@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ $game->image ?? 'https://via.placeholder.com/400x300' }}" class="img-fluid" alt="{{ $game->name }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $game->name }}</h1>
        <p class="h3 text-primary">${{ number_format($game->price, 2) }}</p>
        <p>{{ $game->description }}</p>
         @if($game->release_date)
        <p class="text-muted"><strong>Release Date:</strong> {{ $game->release_date->format('d/m/Y') }}</p>
        @endif
        
        @if($game->category)
        <p>Category: {{ $game->category->name }}</p>
        @endif

        <form action="{{ route('cart.add', $game) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
        </form>
    </div>
</div>
@endsection
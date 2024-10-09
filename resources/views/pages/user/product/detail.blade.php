@extends('layouts.user.main')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
    <p>{{ $product->description }}</p>
    <h4>{{ $product->price }} RP</h4>
</div>
@endsection

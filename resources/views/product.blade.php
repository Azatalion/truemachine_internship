@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <img class="rounded mx-auto d-block" src="{{ Storage::url($product->image)}}" alt="Card image cap" width="440px">
    <div class="card-footer">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p>{{ $product->description}}</p>
    </div>
    <div class="card-body">
        <p class="card-link">Категория {{ $product->category->name }}</p>
    </div>
@endsection
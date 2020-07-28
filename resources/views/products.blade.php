@extends('layouts.app')

@section('title', 'Все товары')

@section('content')
    <div class="container">
        <div class="card"> 
            <div class="card-header">{{ 'Все товары' }} </div>
            <div class="card-body">
                @foreach($products as $product)
                    <div class="navbar-brand">
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                            {{ $product->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
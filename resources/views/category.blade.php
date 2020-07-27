@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $category->name }} </div>
            <div class="card-body">
                @foreach($category->products as $product)
                    <div class="navbar-brand">
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <a href="{{route('product', [$category->code, $product->code])}}">
                            {{ $product->name }}
                        </a>
                    </div>  
                @endforeach
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
        <div class="card">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p>{{ $product->description}}</p>
            </div>
            <div class="card-body">
                <a class="card-link" href="{{route('category', $product->category->code)}}">{{ $product->category->name }}</a>
            </div>
        </div>
    </div>
@endsection
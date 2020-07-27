@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $category->name }} </div>
            <div class="card-body">
                @foreach($products as $product)
                    @if ($product->category_id == $category->id)
                    <div class="navbar-brand">
                        <a href="/categories/{{ $category->code }}/{{ $product->code }}">
                            {{ $product->name }}
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
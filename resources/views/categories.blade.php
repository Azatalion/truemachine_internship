@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ 'Список категорий' }} </div>
            <div class="card-body">
                @foreach($categories as $category)
                    <div class="navbar-brand">
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <a href="{{ route('category', $category->code) }}">
                            {{ $category->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
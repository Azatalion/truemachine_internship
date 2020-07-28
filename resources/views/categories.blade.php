@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ 'Список категорий' }} </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ route('category', $category->code) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ 'Список категорий' }} </div>
            <div class="card-body">
                @foreach($categories as $category)
                    <div class="navbar-brand">
                        <a href="categories/{{ $category->code }}">
                            {{ $category->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
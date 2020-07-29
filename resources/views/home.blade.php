@extends('layouts.app')

@section('content')
    <div class="card-header">
        {{ 'Пользователь'}} {{ Auth::user()->name }}
    </div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="navbar-brand">
            <p>{{ 'Имя: ' }} {{ Auth::user()->name }}</p>
            <p>{{ 'Почта: ' }} {{ Auth::user()->email }}</p>
        </div>
    </div>
@endsection

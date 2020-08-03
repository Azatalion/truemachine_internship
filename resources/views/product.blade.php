@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <img class="rounded mx-auto d-block" src="{{ Storage::url($product->image)}}" alt="Card image cap" width="440px">
    <div class="card-footer">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p>{{ $product->description}}</p>
        <p> Категории:
            @foreach ($product->categories as $category)
                {{ $category->name.'; ' }}
            @endforeach
        </p>
        <p>
            @if ($product->averrageMark() == 0)
                Товар пока никто не оценил.
            @else
                {{ 'Средняя оценка: '.$product->averrageMark() }}
            @endif
        </p>
        @can('add review')
            @if($product->reviews->contains('user_name', Auth::user()->name))
                <p>Вы уже оставили отзыв на этот товар.</p>
            @else
                <a class="btn btn-success" type="button" href="{{ route('product.review', $product->code) }}">Добавить отзыв</a>
            @endif
        @endcan
    </div>
    @if ($product->reviewsCount() > 0)
        <div class="card-body">
            <p class="card-link">Отзывы:</p>
            @foreach ($product->reviews as $review)
                <div class="card">
                    <div class="card-header">
                        {{ $review->user_name }}
                    </div>  
                    <div class="card-body">
                        {{ $review->text }}
                    </div>
                    <div class="card-footer">
                        {{ 'Оценка: '.$review->mark }}
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    @endif
@endsection
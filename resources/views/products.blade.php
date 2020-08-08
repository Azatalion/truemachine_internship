@extends('layouts.app')

@section('title', 'Все товары')

@section('content')
    <div class="card-header">
        <form method="GET" action="{{ route('products') }}">
            <div class="row">
                <div class="col-sm-4">
                    <select class="form-control" name="categories" id="categories">
                        <option value="0" @if (app('request')->input('categories') == 0) selected @endif>Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if (app('request')->input('categories') == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="orders" id="orders">
                        <option value="0" @if (app('request')->input('orders') == 0) selected @endif>Не сортировать</option>
                        <option value="1" @if (app('request')->input('orders') == 1) selected @endif>Сортировать по возрастанию средней оценки</option>
                        <option value="2" @if (app('request')->input('orders') == 2) selected @endif>Сортировать по убыванию средней оценки</option>
                        <option value="3" @if (app('request')->input('orders') == 3) selected @endif>Сортировать по возрастанию количества отзывов</option>
                        <option value="4" @if (app('request')->input('orders') == 4) selected @endif>Сортировать по убыванию средней оценки</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Показать</button>
            </div>
        </form>  
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" src="{{ Storage::url($product->image)}}" height="240px">
                        <div class="card-footer">
                            <a href="{{ route('product', $product->code) }}">
                                {{ $product->name }}
                            </a>
                            <p>
                                @if ($product->averageMark() == 0)
                                    Товар пока никто не оценил.
                                @else
                                    {{ 'Средняя оценка: '.$product->averageMark() }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
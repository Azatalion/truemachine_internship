@extends('layouts.app')

@section('title', 'Все товары')

@section('content')
    <div class="card-header">
        <form method="GET" action="{{ route('products') }}">
            <div class="row">
                <div class="col-sm-4">
                    <select class="form-control" name="categories" id="categories">
                        <option value="0">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
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
                            <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                                {{ $product->name }}
                            </a>
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
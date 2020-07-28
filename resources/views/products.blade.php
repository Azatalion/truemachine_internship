@extends('layouts.app')

@section('title', 'Все товары')

@section('content')
    <div class="container">
        <div class="card"> 
            <div class="card-header">{{ 'Все товары' }} </div>
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
            </div>
        </div>
    </div>
@endsection
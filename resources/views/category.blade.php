@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="card-header">
        {{ $category->name }}
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($category->products as $product)
                <div class="col-sm-4">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" src="{{ Storage::url($product->image)}}" height="240px">
                        <div class="card-footer">
                            <a href="{{route('product', [$category->code, $product->code])}}">
                                {{ $product->name }}
                            </a>
                        </div>
                    </div> 
                    <br> 
                </div> 
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $category->products->links() }}
        </div>
    </div>
@endsection
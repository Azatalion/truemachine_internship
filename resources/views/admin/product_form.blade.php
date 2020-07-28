@extends('layouts.app')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @isset($product)
                    Редактировать товар <b>{{ $product->name }}</b>
                @else
                    Добавить товар
                @endisset
            </div>
            <form method="POST" enctype="multipart/form-data"
                @isset($product)
                action="{{ route('products.update', $product) }}"
                @else
                action="{{ route('products.store') }}"
                @endisset
            >
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @isset($product)
                            @method('PUT')
                        @endisset
                        @csrf
                        
                        <div class="input-group row">
                            <label for="code" class="col-sm-2 col-form-label">Код: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="code" id="code"
                                    value="@isset($product){{ $product->code }}@endisset">
                            </div>
                        </div>
                        <br>

                        <div class="input-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="@isset($product){{ $product->name }}@endisset">
                            </div>
                        </div>
                        <br>

                        <div class="input-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                            <div class="col-sm-6">
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @isset($product)
                                                @if($product->category_id == $category->id)
                                                selected
                                            @endif
                                            @endisset
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="input-group row">
                            <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                            <div class="col-sm-6">
                                <textarea name="description" id="description" cols="72"
                                        rows="7">@isset($product){{ $product->description }}@endisset</textarea>
                            </div>
                        </div>
                        <br>

                        <div class="input-group row">
                            <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                            <div class="col-sm-10">
                                <label class="btn btn-outline-info btn-file">
                                    Загрузить <input type="file" style="display: none;" name="image" id="image">
                                </label>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
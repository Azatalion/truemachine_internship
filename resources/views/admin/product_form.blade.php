@extends('layouts.app')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
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
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="code" id="code"
                            value="{{ old('code', isset($product) ? $product->code : null) }}">
                    </div>
                    @error('code')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>
                <br>

                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ old('name', isset($product) ? $product->name : null) }}">
                    </div>
                    @error('name')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>
                <br>

                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">{{ 'Категория:' }} </label>
                    <div class="col-sm-5">
                        <select name="category_id[]" id="category_id" class="form-control select2" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @isset($product)
                                            @foreach($product->categories as $product_category)
                                                @if($product_category->id == $category->id)
                                                    selected
                                                    @break
                                                @endif
                                            @endforeach
                                        @endisset
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>
                <br>

                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-5">
                        <textarea name="description" id="description" cols="57" rows="7">
                            {{ old('description', isset($product) ? $product->description : null) }}
                        </textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>
                <br>

                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Изображение: </label>
                    <div class="col-sm-5">
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
@endsection
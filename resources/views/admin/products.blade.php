@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
    <div class="card-header">{{ 'Все товары' }} </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Код
                    </th>
                    <th>
                        Название
                    </th>
                    <th>
                        Категории
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->code }}</td>
                        <td>
                            <a href="{{ route('product', $product->code) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>
                            @foreach($product->categories as $category)
                                {{ $category->name.'; ' }}<br>
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    <a class="btn btn-warning" type="button" href="{{ route('products.edit', $product) }}">
                                        Редактировать
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Удалить">
                                </form>
                            </div>
                        </td>    
                    </tr>    
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
    <div class="card-footer" style="width: 70rem;"> 
        <a class="btn btn-success" type="button" href="{{ route('products.create') }}">Добавить товар</a>
    </div>  
@endsection
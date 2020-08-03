@extends('layouts.app')

@section('title', 'Добавить отзыв к '.$product->name)

@section('content')
    <div class="card-header">
        Добавить отзыв к <b>{{ $product->name }}</b>
    </div>
    <form method="POST" enctype="multipart/form-data"
        action="{{ route('review.add', $product->code) }}"
    >
        @csrf
        <div class="card-body">
            <ul class="list-group list-group-flush">

                <div class="input-group row">
                    <label for="text" class="col-sm-2 col-form-label">Отзыв: </label>
                    <div class="col-sm-5">
                        <textarea name="text" id="text" cols="57" rows="7">
                            {{ old('text') }}
                        </textarea>
                    </div>
                    @error('text')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>
                <br>

                <div class="input-group row">
                    <label for="mark" class="col-sm-2 col-form-label">Оценка: </label>
                    <div class="col-sm-5">
                        <select name="mark" id="mark" class="form-control select2">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                </div>
            </ul>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Добавить отзыв</button>
        </div>
    </form>
@endsection
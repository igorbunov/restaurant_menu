@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Новое меню</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
                        @csrf

                        <label>Название:</label>
                        <br/>

                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>

                        <br/>

                        <label>Категория:</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                @if ($loop->first)
                                <option disabled selected>-- выберите категорию --</option>
                                @endif

                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @endforeach
                        </select>

                        <br/>

                        <label>Описание</label>
                        <textarea
                            name="description"
                            cols="30"
                            rows="10"
                            required
                            class="form-control">{{ old('description') }}</textarea>

                        <br/>

                        <label>Фото:</label>
                        <input type="file" name="photo">

                        <br>
                        <br/>

                        <label>Цена:</label>
                        <input type="text" class="form-control" name="price" required value="{{ old('price') }}">

                        <br>

                        <input type="submit" class="btn btn-primary" value="Создать" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
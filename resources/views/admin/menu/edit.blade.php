@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование меню</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.menu.update', $menu) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label>Название:</label>
                        <br/>

                        <input type="text" class="form-control" name="name" value="{{ $menu->name }}" required/>

                        <br/>

                        <label>Категория:</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                @if ($menu->category->id == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif

                            @endforeach
                        </select>

                        <br/>

                        <label>Описание</label>
                        <textarea
                            name="description"
                            cols="30"
                            rows="10"
                            required
                            class="form-control">{{ $menu->description }}</textarea>

                        <br/>

                        <label>Фото:</label>
                        <input type="file" name="photo">

                        @if (!empty($menu->photo))
                        <img class="card-img-top" src="/uploads/images/{{ $menu->photo }}" alt="Card image cap">
                        @endif

                        <br>
                        <br/>

                        <label>Цена:</label>
                        <input type="text" class="form-control" name="price" required value="{{ $menu->price }}">

                        <br>

                        <input type="submit" class="btn btn-primary" value="Сохранить" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
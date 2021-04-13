@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование категории</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <label>Название:</label>
                        <br/>

                        <input type="hidden" name="position" value="{{ $category->position }}">

                        @error('name')
                            <input type="text" class="form-control is-invalid" name="name" value="{{ $category->name }}" required/>

                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}" required/>
                        @enderror

                        <br/>
                        <input type="submit" class="btn btn-primary" value="Редактировать" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
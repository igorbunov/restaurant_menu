@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Новая категория</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.store') }}">
                        @csrf

                        <label>Название:</label>
                        <br/>

                        @error('name')
                            <input type="text" class="form-control is-invalid" name="name" value="{{ old('name') }}" required/>

                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
                        @enderror

                        <br/>
                        <input type="submit" class="btn btn-primary" value="Создать" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
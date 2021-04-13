@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-primary" href="{{ route('admin.category.create') }}">Добавить категорию</a>
                    <br/>
                    <br/>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Позиция</th>
                                <th style="width: 206px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around" style="width: 50px;">
                                            <div class="change-position" data-url="{{ route('admin.category.change-position', ['category' => $category, 'position' => -1]) }}">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                            {{-- <div>{{ $category->position }}</div> --}}
                                            <div class="change-position" data-url="{{ route('admin.category.change-position', ['category' => $category, 'position' => 1]) }}">
                                                <i class="fas fa-arrow-down"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-sm btn-info">Редактировать</a>

                                        <form
                                            class="d-inline-flex"
                                            onsubmit="return confirm('Вы уверенны?');"
                                            method="POST"
                                            action="{{ route('admin.category.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Удалить">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr colspan="2">
                                    <td>Нет категорий</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.change-position').click(function() {
            $(this).prop('disabled', true);

            $.ajax({
                type: "POST",
                url: $(this).data('url'),
                success: function(data) {
                    if (data.success) {
                        window.location.href = data.url;
                    }
                }
            });
        });
    });
</script>
@endsection
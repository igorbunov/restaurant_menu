@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div>
                            <a class="btn btn-primary" href="{{ route('admin.menu.create') }}">Добавить меню</a>
                        </div>
                        <div>
                            <select id="category-filter" name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    @if ($loop->first)
                                    <option
                                        data-url="{{ route('admin.menu.index') }}"
                                        @if (is_null($selectedCategory)) selected @endif>-- выберите категорию --</option>
                                    @endif

                                    @if (!is_null($selectedCategory) and $selectedCategory->id == $category->id)
                                    <option
                                        selected
                                        data-url="{{ route('admin.menu.index', ['category_id' => $category->id]) }}"
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @else
                                    <option
                                        data-url="{{ route('admin.menu.index', ['category_id' => $category->id]) }}"
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br/>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Позиция</th>
                                <th style="width: 206px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->category->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around" style="width: 50px;">
                                            <div class="change-position" data-url="{{ route('admin.menu.change-position', ['menu' => $menu, 'position' => -1]) }}">
                                                <i class="fas fa-arrow-up"></i>
                                            </div>
                                            <div class="change-position" data-url="{{ route('admin.menu.change-position', ['menu' => $menu, 'position' => 1]) }}">
                                                <i class="fas fa-arrow-down"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-sm btn-info">Редактировать</a>

                                        <form
                                            class="d-inline-flex"
                                            onsubmit="return confirm('Вы уверенны?');"
                                            method="POST"
                                            action="{{ route('admin.menu.destroy', $menu->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Удалить">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr colspan="2">
                                    <td>Нет меню</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $menus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#category-filter" ).change(function() {
            var url = $( "#category-filter option:selected" ).data('url');

            window.location.href = url;
        });

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
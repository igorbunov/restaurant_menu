@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-primary">
                        Меню ({{ $menuCount }})
                    </a>

                    <br/>
                    <br/>

                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                        Категорий меню ({{ $categoryCount }})
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
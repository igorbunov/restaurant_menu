@extends('layouts.app', [
    'show_top_menu' => false
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="accordion" id="menu-category">
                @foreach ($categories as $category)
                    <div class="card">
                        <div class="card-header" id="menu-category-heading-{{ $category->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#category-{{ $category->id }}" aria-expanded="true" aria-controls="category-{{ $category->id }}">
                                    {{ $category->name }}
                                </button>
                            </h2>
                        </div>

                        <div id="category-{{ $category->id }}" class="collapse" aria-labelledby="menu-category-heading-{{ $category->id }}" data-parent="#menu-category">
                            <div class="card-body">
                                @include('partials.menus', ['menus' => $category->menus])
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

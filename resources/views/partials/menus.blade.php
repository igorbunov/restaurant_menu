@foreach ($menus ?? [] as $menu)
    <div class="card mb-4">
        @if (!is_null($menu->photo))
        <img class="card-img-top" src="/uploads/images/{{ $menu->photo }}" alt="Card image cap">
        @else
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
        @endif
        <div class="card-body">
            <h2 class="card-title">{{ $menu->name }}</h2>
            <p class="card-text">{{ $menu->description }}</p>
            <p>price: {{ $menu->price }}</p>
        </div>
    </div>
@endforeach
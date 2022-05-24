<!DOCTYPE html>
<html lang="en">

<head>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    <title>Lotniska</title>
</head>

<body>
    @include('shared.nav')
    <div class="container container-fluid">
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">Lotniska</h1>
        @include('shared.error')
        @can('create', $airports->first())
        <div class="row">
            <a class="btn btn-lg btn-add" href="{{ route('airports.create') }}">
                <span>Dodaj lotnisko</span>
            </a>
        </div>
        @endcan
        {{ $airports->links('pagination::bootstrap-4') }}
        <div class="row">
            @forelse ($airports as $airport)
                <div class="col-md-4">
                    <div class="profile-card-4 text-center profile-card-airport">
                        <div class="profile-content">
                            <div class="profile-name mb-3">
                                {{ $airport->name }}
                            </div>
                                        <a class="btn btn-lg" href="{{ route('airports.show', $airport) }}">
                                            <span>Więcej<br>szczegółów</span>
                                        </a>
                                @can('update', $airport)
                                        <a class="btn btn-lg" href="{{ route('airports.edit', $airport) }}">
                                            <span>Edytuj</span>
                                        </a>
                                    @endcan
                                    @can('delete', $airport)
                                        <form id="delete" class="btn btn-lg" method="POST" action="{{ route('airports.destroy', $airport->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Jesteś pewien, że chcesz usunąć to lotnisko?')">Usuń</button>
                                        </form>
                                @endcan
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>

</html>

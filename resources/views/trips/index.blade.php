<!DOCTYPE html>
<html lang="en">
<head>
@include('shared.header')
<link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
<title>Wycieczki</title>
</head>
<body>
    @include('shared.nav')
    <div class="container" id="container_trips">
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">Nasze wycieczki</h1>
        @if($errors->any())
            <h4><?php echo "<script type='text/javascript'>alert('".$errors->first()."');</script>"; ?></h4>
        @endif
        @can('create', $trips->first())
        <div class="row">
            <a class="btn btn-lg btn-add" href="{{ route('trips.create') }}">
                <span>Dodaj wycieczkę</span>
            </a>
        </div>
        @endcan
        {{ $trips->links('pagination::bootstrap-4') }}
        <div class="row">
        @forelse ($trips as $trip)
            <div class="col-md-4">
                <div class="profile-card-4 text-center"><img src="{{ asset('storage\img_trips\\'.$trip->img_name.'') }}"
                        class="img img-fluid">
                    <div class="profile-content">
                        <div class="profile-name pt-0 mb-3">
                            {{ $trip->name }}
                        </div>
                                        <a class="btn btn-lg" href="{{ route('trips.show', $trip->id) }}">
                                            <span>Więcej<br>szczegółów</span>
                                        </a>
                                        <a class="btn btn-lg" href="{{ route('reserve', $trip->id) }}">
                                            <span>Rezerwuj<br>lot</span>
                                        </a>
                            @can('update', $trip)
                                <div class="mr-3">
                                    <a class="btn btn-lg" href="{{ route('trips.edit', $trip->id) }}">
                                        <span>Edytuj</span>
                                    </a>
                                    <form id="delete" class="btn btn-lg" method="POST" action="{{ route('trips.destroy', $trip->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Jesteś pewien, że chcesz usunąć tę wycieczkę?')">Usuń</button>
                                    </form>
                                </div>
                            @endcan
                    </div>
                </div>
            </div>
            @empty
            <h6 class="text-white text-center">Brak wycieczek</h6>
            @endforelse
        </div>
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>
</html>

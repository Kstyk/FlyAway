<!DOCTYPE html>
<html lang="en">

<head>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>

<body>
    @include('shared.nav')
    <div class="container container-fluid">
        @if ($errors->any())
            <h4><?php echo "<script type='text/javascript'>alert('" . $errors->first() . "');</script>"; ?></h4>
        @endif
        @can('create', $airports->first())
        <div class="row">
            <a class="btn btn-lg btn-add" href="{{ route('airports.create') }}">
                <span>Dodaj lotnisko</span>
            </a>
        </div>
        @endcan
        <div class="row">
            @forelse ($airports as $airport)
                <div class="col-md-4">
                    <div class="profile-card-4 text-center profile-card-airport">
                        <div class="profile-content">
                            <div class="profile-name">
                                {{ $airport->nazwa }}
                            </div>
                                        <a class="btn btn-lg" href="{{ route('airports.show', $airport) }}">
                                            <span>Więcej<br>szczegółów</span>
                                        </a>
                                @can('delete', $airport)
                                        <a class="btn btn-lg" href="{{ route('airports.edit', $airport) }}">
                                            <span>Edytuj</span>
                                        </a>
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
    @include('shared.js')
</body>

</html>

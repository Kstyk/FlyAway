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
        @can('create', $countries->first())
        <div class="row">
            <a class="btn btn-lg btn-add" href="{{ route('countries.create') }}">
                <span>Dodaj kraj</span>
            </a>
        </div>
        @endcan
        <div class="row">
            @forelse ($countries as $c)
                <div class="col-md-4">
                    <div class="profile-card-4 text-center">
                        <div class="profile-content">
                            <div class="profile-name">
                                {{ $c->name }}
                            </div>
                                        <a class="btn btn-lg" href="{{ route('countries.show', $c) }}">
                                            <span>Więcej<br>szczegółów</span>
                                        </a>
                                @can('update', $c)
                                        <a class="btn btn-lg" href="{{ route('countries.edit', $c) }}">
                                            <span>Edytuj</span>
                                        </a>
                                        <form id="delete" class="btn btn-lg" method="POST" action="{{ route('countries.destroy', $c->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Jesteś pewien, że chcesz usunąć ten kraj?')">Usuń</button>
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

<!DOCTYPE html>
<html lang="en">
<head>
@include('shared.header')
</head>
<body>
    @include('shared.nav')
    <div class="container" id="container_trips">
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
        <div class="row">
        @forelse ($trips as $trip)
            <div class="col-md-4">
                <div class="profile-card-4 text-center"><img src="{{ asset('storage\img_trips\p'.$trip->id.'.jpg') }}"
                        class="img img-responsive">
                    <div class="profile-content">
                        <div class="profile-name">
                            {{ $trip->nazwa }}
                        </div>
                        <div class="row">
                                <div class="row">
                                    <div class="mr-3">
                                        <a class="btn btn-lg" href="{{ route('trips.show', $trip->id) }}">
                                            <span>Więcej<br>szczegółów</span>
                                        </a>
                                        <a class="btn btn-lg" href="#">
                                            <span>Rezerwuj<br>lot</span>
                                        </a>
                                    </div>
                            </div>
                            @can('update', $trip)
                            <div class="row" style="margin-top:10px;">
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
                            </div>
                            @endcan
                        </div>
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

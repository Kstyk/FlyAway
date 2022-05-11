<!DOCTYPE html>
<html lang="en">
@include('shared.header')
<body>
    @include('shared.nav')
    <div class="container" id="container_trips">
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

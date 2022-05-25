<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;{{ route('trips.index') }}" />
    <title>Nie znaleziono strony</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>
<body>
    @include('shared.nav')
    <div class="container container-fluid text-white d-flex flex-column justify-content-center">
        <h3 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">{{ __('custom.404_notfound') }}</h3>
        <img class="img img-fluid" src="{{ asset('storage\errors\404.png') }}" alt="404">
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>
</html>

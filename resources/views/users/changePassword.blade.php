<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zmień hasło</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>
<body>
    @include('shared.nav')
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card bg-transparent text-white" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                      <h2 class="fw-bold mb-2 text-uppercase">Zmień hasło</h2>
                      @include('shared.error')
                      <form method="POST" action="{{ route('change.password') }}">
                        @csrf

                        <div class="form-outline form-white mb-4">
                            <input id="current_password" type="password" name="current_password" class="form-control-lg w-100
                            @error('current_password') is-invalid @else is-valid
                            @enderror" />
                            <label class="form-label" for="current_password">Obecne hasło</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input name="new_password" type="password" id="new_password" class="form-control-lg w-100
                            @error('new_password') is-invalid @else is-valid
                            @enderror" />
                            <label class="form-label" for="new_password">Nowe hasło</label>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input name="new_confirm_password" type="password" id="new_confirm_password" class="form-control-lg w-100
                            @error('new_confirm_password') is-invalid @else is-valid
                            @enderror" />
                            <label class="form-label" for="new_confirm_password">Powtórz nowe hasło</label>
                        </div>

                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Zmień hasło</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @include('shared.footer')
    @include('shared.js')
</body>
</html>

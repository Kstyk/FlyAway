<!DOCTYPE html>
<html lang="en">
<head>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    <style>
        body {
            color:white;
        }
    </style>
</head>
<body>
    @include('shared.nav')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Dodaj kraj</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('countries.store') }}">
                    @csrf
                    @method('POST')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="name" type="text" name="name" class="form-control form-control-lg
                        @error('name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="name">Nazwa</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input name="iso3166" type="text" id="iso3166" class="form-control form-control-lg
                        @error('iso3166') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="iso3166">Kod iso3166</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="currency" type="text" id="currency" class="form-control form-control-lg
                        @error('currency') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="currency">Waluta</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="total_surface" type="number" id="total_surface" class="form-control form-control-lg
                        @error('total_surface') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="total_surface">Powierzchnia całkowita</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="language" type="text" id="language" class="form-control form-control-lg
                        @error('language') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="language">Język urzędowy</label>
                    </div>
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Dodaj</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    @include('shared.js')
</body>
</html>


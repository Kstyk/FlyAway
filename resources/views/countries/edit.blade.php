<!DOCTYPE html>
<html lang="en">
<head>
    @include('shared.header')
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

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj kraj</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('countries.update', $c->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="nazwa" type="text" name="nazwa" value="{{ $c->nazwa }}" class="form-control form-control-lg
                        @error('nazwa') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typeEmailX">Nazwa</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input name="iso3166" type="text" id="iso" value="{{ $c->iso3166 }}" class="form-control form-control-lg
                        @error('iso3166') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Kod ISO 3166</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="waluta" type="text" id="waluta" value="{{ $c->waluta }}" class="form-control form-control-lg
                        @error('waluta') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Waluta</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="powierzchnia_calkowita" type="number" id="powierzchnia_calkowita" value="{{ $c->powierzchnia_calkowita }}" class="form-control form-control-lg
                        @error('powierzchnia_calkowita') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Powierzchnia całkowita</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="jezyk_urzedowy" type="text" id="jezyk_urzedowy" value="{{ $c->jezyk_urzedowy }}" class="form-control form-control-lg
                        @error('jezyk_urzedowy') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Język urzędowy</label>
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Edytuj</button>
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


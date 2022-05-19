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

                  <h2 class="fw-bold mb-2 text-uppercase">Dodaj wycieczkę</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('trips.store') }}">
                    @csrf
                    @method('POST')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="nazwa" type="text" name="nazwa" class="form-control form-control-lg
                        @error('nazwa') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typeEmailX">Nazwa</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input name="kontynent" type="text" id="kontynent" class="form-control form-control-lg
                        @error('kontynent') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Kontynent</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="okres_trwania" type="number" id="okres" class="form-control form-control-lg
                        @error('okres_trwania') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Okres trwania wycieczki</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <textarea name="opis" id="opis" rows="5" class="form-control form-control-lg
                        @error('okres_trwania') is-invalid @else is-valid
                        @enderror"></textarea>
                        <label class="form-label" for="typePasswordX">Opis</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="cena" type="number" id="okres" class="form-control form-control-lg
                        @error('okres_trwania') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="typePasswordX">Cena wycieczki</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="country_id" name="country_id">
                            @foreach ($countries as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->nazwa }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="typePasswordX">Kraj</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="img_name" type="file" id="img_name" class="form-control form-control-lg
                        @error('img_name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="img_name">Zdjęcie wycieczki</label>
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


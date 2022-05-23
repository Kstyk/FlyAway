<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doładuj konto</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>
<body>
    @include('shared.nav')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100 ">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-transparent text-white border-0" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Doładuj konto</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('save', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-outline form-white mb-4">
                        <input id="bank_balance" type="number" step="0.01" name="bank_balance" class="form-control form-control-lg
                        @error('bank_balance') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="bank_balance">Kwota</label>
                    </div>
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Doładuj</button>
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

@if ($errors->any())
    <div class="alert alert-danger d-flex flex-row justify-content-center border-2 mb-5"
    style="-webkit-box-shadow: 11px 11px 0px 5px rgb(160, 44, 44);
    -moz-box-shadow: 11px 11px 0px 5px rgb(160, 44, 44);
    box-shadow: 11px 11px 0px 5px rgb(160, 44, 44);">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

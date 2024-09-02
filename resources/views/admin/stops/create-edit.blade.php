@extends('layouts.admin')
@section('content')
@php
$isEdit = isset($stop);
@endphp
    <h2>{{$title}}</h2>
    <form action="{{$route}}" method="post"  enctype="multipart/form-data" id="stopForm" class="row fw-medium rounded-3 bg-gray p-5">
        @csrf
        @method($method)

        <div class="col-12 col-md-6 mb-3">
            <label for="name" class="form-label">Tappa (*)</label>
            <input name="name" type="text" placeholder="Inserisci il nome della tappa"
                class="form-control @error('name') is-invalid @enderror" id="name"
                value="{{ old('name', $stop?->name) }}" required minlength="3" maxlength="100">
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="date" class="form-label">Data</label>
            <input name="date" type="date"
                class="form-control" id="date"
                value="{{ old('date', $stop?->date) }}">
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="photo" class="form-label">Immagine</label>
            <input name="photo" type="file" onchange="showImage(event)"
                class="form-control  " id="photo"
                value="{{ old('photo', $stop?->photo) }}" >

            <img class="thumb img-thumbnail w-25 my-2" onerror="this.src='/noimg.jpg'" id="thumb" src="{{asset('storage/' . $stop?->photo)}}" >

        </div>

        {{-- Indirizzo --}}
        <div class="col-12 col-xl-6 mb-3">
            <label for="address" class="form-label">Indirizzo </label>
            <input type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" class="form-control"
                value="{{ old('', $stop?->address) }}" required min="2" max="100">
            <div id="addressList" role="button" class="autocomplete-items rounded-bottom-3 overflow-hidden"></div>
        </div>

        <input name="latitude" type="hidden" id="latitude" value="{{ old('latitude', $stop?->latitude) }}" required
            min="-90" max="90">

        <input name="longitude" type="hidden" id="longitude" value="{{ old('longitude', $stop?->longitude) }}" required
            min="-180" max="180">


        <div class="col-12 col-md-6 mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" placeholder="Inserisci la descrizione"
                class="form-control" id="description"
                value="{{ old('description', $stop?->description) }}"  minlength="3" maxlength="100" rows="5" cols="30"></textarea>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="description" class="form-label">Curiosità</label>
            <textarea name="description" placeholder="Inserisci la descrizione"
                class="form-control" id="description"
                value="{{ old('description', $stop?->description) }}"  minlength="3" maxlength="100" rows="2" cols="30"></textarea>
        </div>

        <div class="text-center pt-3">
            <button type="submit"
                class="btn w-25 me-3 {{ Route::currentRouteName() === 'admin.houses.create' ? 'btn-success' : 'btn-warning' }}">{{ $button }}</button>
            <button type="reset" class="btn btn-danger w-25">Reset</button>
        </div>
    </form>

    <script>
        function showImage(event){
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);

        }

        document.addEventListener('DOMContentLoaded', function() {
    const addressInput = document.getElementById('address');
    const addressList = document.getElementById('addressList');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');

    let addressSelected = @json($isEdit);

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    const handleAddressInput = debounce(function() {
        let query = addressInput.value;
        addressSelected = false;

        if (query.length > 1) {
            fetch('{{ route('autocomplete') }}?query=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    addressList.innerHTML = '';

                    data.forEach(item => {
                        const option = document.createElement('div');
                        option.classList.add('bg-white', 'p-1', 'ps-2', 'border-bottom', 'border-secondary-subtle');
                        option.innerHTML = "<strong>" + item.address.freeformAddress + "</strong>";

                        option.addEventListener('click', function() {
                            addressInput.value = item.address.freeformAddress;
                            latitudeInput.value = item.position.lat;
                            longitudeInput.value = item.position.lon;
                            addressList.innerHTML = '';
                            addressSelected = true;
                        });

                        addressList.appendChild(option);
                    });
                });
        } else {
            addressList.innerHTML = '';
        }
    }, 300);

    addressInput.addEventListener('input', handleAddressInput);

    document.addEventListener('click', function(e) {
        if (!addressList.contains(e.target) && e.target !== addressInput) {
            addressList.innerHTML = '';
        }
    });

});
    </script>
@endsection


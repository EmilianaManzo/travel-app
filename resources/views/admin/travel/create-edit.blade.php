@extends('layouts.admin')
@section('content')
<h1 class="py-5 text-center mt-3 rounded-3 bg-gray">{{ $title }}</h1>

<h6 class="ps-5">I campi con <strong>(*)</strong> sono obbligatori</h6>

<form action="{{$route}}" method="post" enctype="multipart/form-data" id="travelForm" class="row fw-medium rounded-3 bg-gray p-5">
    @csrf
    @method($method)

    <div class="col-12 col-md-6 mb-3">
        <label for="name" class="form-label">Viaggio (*)</label>
        <input name="name" type="text" placeholder="Inserisci il nome del viaggio"
            class="form-control @error('name') is-invalid @enderror" id="name"
            value="{{ old('name', $travel?->name) }}" required minlength="3" maxlength="100">
        @error('title')
            <small class="text-danger fw-bold">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="start_date" class="form-label">Data inizio</label>
        <input name="start_date" type="date"
            class="form-control @error('start_date') is-invalid @enderror " id="start_date"
            value="{{ old('start_date', $travel?->start_date) }}" required minlength="3" maxlength="100">
        @error('start_date')
            <small class="text-danger fw-bold">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="end_date" class="form-label">Data fine</label>
        <input name="end_date" type="date"
            class="form-control @error('end_date') is-invalid @enderror " id="end_date"
            value="{{ old('end_date', $travel?->end_date) }}" required minlength="3" maxlength="100">
        @error('end_date')
            <small class="text-danger fw-bold">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="days" class="form-label">Numero giorni</label>
        <input name="days" type="number"
            class="form-control" id="days"
            value="{{ old('days', $travel?->days) }}" required minlength="3" maxlength="100">
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="photo" class="form-label">Immagine</label>
        <input name="photo" type="file" onchange="showImage(event)"
            class="form-control @error('photo') is-invalid @enderror " id="photo"
            value="{{ old('photo', $travel?->photo) }}" required minlength="3" maxlength="100">
        @error('photo')
            <small class="text-danger fw-bold">
                {{ $message }}
            </small>
        @enderror
        <img class="thumb img-thumbnail w-25 my-2" onerror="this.src='/noimg.jpg'" id="thumb" src="{{asset('storage/' . $travel?->photo)}}" >

    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="days" class="form-label">Voto</label>
        <input name="vote" type="number"
        class="form-control" id="vote"
        value="{{ old('vote', $travel?->vote) }}" minlength="3" maxlength="100">
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label for="description" class="form-label">Descrizione</label>
        <textarea name="description" placeholder="Inserisci la descrizione"
            class="form-control" id="description"
            value="{{ old('description', $travel?->description) }}"  minlength="3" maxlength="100"></textarea>
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
</script>
@endsection

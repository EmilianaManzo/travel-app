@php
    use App\Functions\Helper as Help;
@endphp


@extends('layouts.admin')
@section('content')


<section class="h-100 flex-grow-1 sec-index ">
    <div class="container pt-4 w-100 ">

        <div class="row">
            <div class="col"><h1 class="mb-5">Dettagli</h1></div>
        </div>

        <div class="row">
            <div class="col">
                <img
                  src="{{asset('storage/' . $travel->photo)}}"
                  class="card-img-top img-fluid"
                  alt="{{$travel->name}}"
                  onerror="this.src='/img/noimg.jpg'">
            </div>
            <div class="col">
                      <h5 class="card-title mb-3  text-capitalize"><span class="fw-bold me-2">Nome:</span> {{$travel->name}}</h5>



                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Data inizio:</span> {{Help::formatDate($travel->start_date)}}</p>
                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Data inizio:</span> {{Help::formatDate($travel->end_date)}}</p>

                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Totale giorni:</span> {{$travel->days}}</p>

                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Voto:</span> {{$travel->vote}}</p>

                      <p class="card-text text-capitalize"><span class="fw-bold me-2">Descrizione:</span> {{$travel->description}}</p>

                    <div class="d-flex mb-3">

                        @include('admin.partials.formdelete')


                        <a href="{{route('admin.stop.create', $travel)}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                        <a href="{{route('admin.home')}}" class="btn btn-success ">Torna ai viaggi</a>
                    </div>


            </div>
        </div>

    </div>
</section>

@endsection

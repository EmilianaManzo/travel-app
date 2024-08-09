@extends('layouts.admin')
@section('content')

    <div class="row pt-2 pb-5 px-0 px-sm-5 px-md-0 px-lg-5">
        <div class="col-12">
            <div class="px-2 rounded-3 pb-1">
              @if (count($travels) > 0)
                <h2 class="py-3 text-dark rounded-3 fw-bold fs-2 p-3 mt-3">I tuoi Viaggi</h2>
              @endif

              <table class="table table-light table-striped table-responsive">
                @if (count($travels) > 0)
                  <thead>
                    <tr>

                      <th scope="col">Viaggio</th>
                      <th class="text-center d-none d-md-table-cell " scope="col">Data inizio</th>
                      <th class="text-center d-none  d-md-table-cell " scope="col">Data fine</th>
                      <th class="text-center d-none  d-md-table-cell " scope="col">Voto</th>
                      <th class="text-center" scope="col">Azioni</th>
                    </tr>
                  </thead>
                @endif
                <tbody class="table-group-divider">

                  @forelse ($travels as $travel)


                      <td class="align-content-center">
                        {{ $travel->name }}
                      </td>

                      <td class="align-content-center text-center d-none d-md-table-cell ">
                        {{$travel->start_date}}
                      </td>

                      <td class="align-content-center text-center d-none  d-md-table-cell ">
                        {{$travel->end_date}}
                      </td>
                      <td class="align-content-center text-center d-none  d-md-table-cell ">
                        {{$travel->days}}
                      </td>

                      <td class=" d-flex justify-content-center align-content-center text-center">

                        <a href="{{ route('admin.travel.show', $travel) }}" class="btn btn-info me-2 mb-2">
                          <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.travel.edit', $travel) }}" class="btn btn-warning me-2 mb-2">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </a>



                        @include('admin.partials.formdelete')

                      </td>

                    </tr>
                  @empty
                    <h2 class=" ms-3">Nessun Viaggio Presente</h2>
                  @endforelse
    </div>
@endsection

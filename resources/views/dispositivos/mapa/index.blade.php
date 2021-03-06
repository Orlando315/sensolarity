@extends('layouts.app')

@section('title','Valor en mapa - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Dispositivos </a>
@endsection

@section('content')
  
  @include('partials.flash')

  <div class="row mt-4">
    @forelse($dispositivos as $d)
      <div id="dispositivo-{{ $d->id }}" class="col-md-6">
        <div class="card card-dispositivo">
          <div class="card-header">
            <h4 class="card-title text-center">
              {{ $d->alias() }}

              <p class="text-center text-muted mb-0" style="font-size: .7em;">
                ({{ $d->serial }})
              </p>

              <div class="dropdown btn-config-dropdown">
                <button class="btn dropdown-toggle btn-fill btn-round btn-sm rounded-circle" type="button" id="dropdownConfigLink-{{ $d->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-cogs"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownConfigLink-{{ $d->id }}">
                  <a class="dropdown-item" href="{{ route('dispositivos.edit', ['dispositivo'=>$d->id]) }}">Editar</a>
                  <a class="dropdown-item text-danger" href="#" role="button" data-dispositivo="{{ $d->id }}" data-toggle="modal" data-target="#delModal">Eliminar</a>
                </div>
              </div>
            </h4>
          </div>
          <div class="card-body">
            <div class="row p-2">
              <div class="col-md-6 pb-2 pb-md-0">
                <div class="border rounded p-3 text-center">
                  {{ $d->aliasData(1) }}
                </div>
              </div>
              <div class="col-md-6 pb-2 pb-md-0 pl-md-2">
                <div class="border rounded p-3 text-right dispositivo-data-1">
                  {{ $d->lastData(1) }} {{ $d->unidad(1) }}
                </div>
              </div>
            </div>

            <div class="row p-2">
              <div class="col-md-6 pb-2 pb-md-0">
                <div class="border rounded p-3 text-center">
                  {{ $d->aliasData(2) }}
                </div>
              </div>
              <div class="col-md-6 pb-2 pb-md-0 pl-md-2">
                <div class="border rounded p-3 text-right dispositivo-data-2">
                  {{ $d->lastData(2) }} {{ $d->unidad(2) }}
                </div>
              </div>
            </div>

            <div class="row p-2">
              <div class="col-md-6 pb-2 pb-md-0">
                <div class="border rounded p-3 text-center">
                  {{ $d->aliasData(3) }}
                </div>
              </div>
              <div class="col-md-6 pb-2 pb-md-0 pl-md-2">
                <div class="border rounded p-3 text-right dispositivo-data-3">
                  {{ $d->lastData(3) }} {{ $d->unidad(3) }}
                </div>
              </div>
            </div>

            <div class="row p-2">
              <div class="col">
                <a href="{{ route('dispositivos.mapa.show', ['dispositivo' => $d->id]) }}" class="btn btn-primary btn-fill btn-block" title="Ver mapa">Ver mapa</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <h3 class="text-center text-muted">
          A??n no has agregado ning??n dispositivo
        </h3>

        <p class="text-center">
          <a class="btn btn-primary btn-lg" href="{{ route('dispositivos.create') }}" rel="tooltip" title="Agregar dispositivo">Agregar</a>
          <a class="btn btn-success btn-lg" href="{{ $store_url }}" rel="tooltip" title="Comprar dispositivo" target="_blank">Comprar</a>
        </p>
      </div>
    @endforelse
  </div>

  <div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="delModalLabel">Eliminar Dispositivo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-md-center">
            <form id="delete-dispositivo-form" class="col-md-10" action="#" method="POST">
              @csrf
              @method('DELETE')

              <p class="text-center">??Esta seguro de eliminar este Dispositivo?</p><br>

              <center>
                <button class="btn btn-fill btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  
  @component('partials.dispositivosPusher')
  @endcomponent
  
  <script type="text/javascript">
    $(document).ready(function () {
      $('#delModal').on('show.bs.modal', function (event) {
        let btn = $(event.relatedTarget),
            id = btn.data('dispositivo');

        $('#delete-dispositivo-form').attr('action', '{{ route("dispositivos.index") }}/' + id);
      })
    })
  </script>
@endsection

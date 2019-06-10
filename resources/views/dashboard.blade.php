@extends('layouts.app')

@section('title', 'Inicio - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Inicio </a>
@endsection

@section('content')
  <div class="row">
    @if($dispositivos->count() > 0)
    <div class="col-lg-3 col-sm-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-microchip text-primary"></i>
              </div>
            </div>
            <div class="col-7">
              <div class="numbers">
                <p class="card-category">Dispositivos</p>
                <h4 class="card-title">{{ $dispositivos->count() }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
  
  @include('partials.flash')

  <div class="row" style="margin-top: 20px">
    <div class="col-md-12">
      @if($dispositivos->count() > 0)
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">
              <i class="fa fa-microchip"></i> Dispositivos
              <span class="float-right">
                <a class="btn btn-success" href="{{ route('dispositivos.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Dispositivo</a>
              </span>
            </h4>
          </div>
          <div class="card-body">
            <table class="table data-table table-striped table-no-bordered table-hover table-sm" style="width: 100%">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Tipo</th>
                  <th scope="col" class="text-center">Serial</th>
                  <th scope="col" class="text-center">Agregado</th>
                  <th scope="col" class="text-center">Acción</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($dispositivos as $d)
                  <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $d->dispositivo->tipo() }}</td>
                    <td>{{ $d->serial }}</td>
                    <td>{{ $d->created_at }}</td>
                    <td>
                      <a class="btn btn-primary btn-link btn-sm" href="{{ route('dispositivos.show', ['id' => $d->id] )}}" rel="tooltip" title="Ver dispositivo" data-original-title="Ver dispositivo">
                        <i class="fa fa-search"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @else
        <h3 class="text-center text-muted">
          Aún no has agregado ningún dispositivo
        </h3>

        <p class="text-center">
          <a class="btn btn-primary btn-lg" href="{{ route('dispositivos.create') }}" rel="tooltip" title="Agregar dispositivo">Agregar</a>
          <a class="btn btn-success btn-lg" href="{{ $store_url }}" rel="tooltip" title="Comprar dispositivo" target="_blank">Comprar</a>
        </p>
      @endif
    </div>
  </div>
@endsection

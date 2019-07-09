@extends('layouts.app')

@section('title', 'Inicio - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Inicio </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center icon-warning text-muted">
                <i class="fa fa-cubes"></i>
              </div>
            </div>
            <div class="col-7">
              <div class="numbers">
                <p class="card-category">Modulos</p>
                <h4 class="card-title">{{ $modulos->count() }}</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <hr>
          <div class="stats">
            <a class="text-muted" href="{{ route('dispositivos.modulos.index') }}" title="Ver dispositivos">
              Ver dispositivos
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center icon-warning text-muted">
                <i class="fa fa-map-marker"></i>
              </div>
            </div>
            <div class="col-7">
              <div class="numbers">
                <p class="card-category">Mapas</p>
                <h4 class="card-title">{{ $mapas->count() }}</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <hr>
          <div class="stats">
            <a class="text-muted" href="{{ route('dispositivos.mapa.index') }}" title="Ver dispositivos">
              Ver dispositivos
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @include('partials.flash')

  <div class="row" style="margin-top: 20px">
    <div class="col-md-12">
      @if($dispositivos->count() == 0)
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

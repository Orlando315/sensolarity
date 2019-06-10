@extends('layouts.app')

@section('title','Modulo - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Dispositivos </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-3 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-cubes text-primary"></i>
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
  </div>
  
  @include('partials.flash')

  <div class="row" style="margin-top: 20px">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-cubes"></i> Modulo
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
                <th scope="col" class="text-center">Dispositivo</th>
                <th scope="col" class="text-center">Serial</th>
                <th scope="col" class="text-center">Agregado</th>
                <th scope="col" class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($dispositivos as $d)
                <tr>
                  <td scope="row">{{ $loop->index + 1 }}</td>
                  <td>{!! $d->name() !!}</td>
                  <td>{{ $d->serial }}</td>
                  <td>{{ $d->created_at }}</td>
                  <td>
                    <a class="btn btn-primary btn-link btn-sm" href="{{ route('dispositivos.show', ['id' => $d->id] )}}" rel="tooltip" title="Ver dispositivo" data-original-title="Ver dispositivo">
                      <i class="fa fa-search"></i>
                    </a>
                    <a class="btn btn-success btn-link btn-sm" href="{{ route('dispositivos.edit', ['id' => $d->id] )}}" rel="tooltip" title="Editar dispositivo" data-original-title="Editar dispositivo">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

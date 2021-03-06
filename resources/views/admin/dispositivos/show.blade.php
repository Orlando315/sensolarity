@extends('layouts.app')

@section('title','Dispositivos - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('admin.dispositivos.index') }}"> Dispositivos </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <a class="btn btn-default" href="{{ route('admin.dispositivos.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
      <a class="btn btn-success" href="{{ route('admin.dispositivos.edit', ['dispositivo' => $dispositivo->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
      
      @if($dispositivo->disponible)
      <button class="btn btn-fill btn-warning" data-toggle="modal" data-target="#blockModal"><i class="fa fa-ban" aria-hidden="true"></i>Marcar No disponible</button>
      @else
      <button class="btn btn-fill btn-success" data-toggle="modal" data-target="#blockModal"><i class="fa fa-check" aria-hidden="true"></i>Marcar Disponible</button>
      @endif

      <button class="btn btn-fill btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
    </div>
  </div>
  
  @include('partials.flash')

  <div class="row" style="margin-top: 20px">
    <div class="col-md-3">
      <div class="card card-information">
        <div class="card-header">
          <h4>Información</h4>
        </div><!-- .card-header -->
        <div class="card-body">
          <strong>Tipo</strong>
          <p class="text-muted">
            {{ $dispositivo->tipo() }}
          </p>
          <hr>

          <strong>Código</strong>
          <p class="text-muted">
            {{ $dispositivo->codigo }}
          </p>
          <hr>

          <strong>serial</strong>
          <p class="text-muted">
            {{ $dispositivo->serial }}
          </p>
          <hr>

          <strong>Disponible</strong>
          <p class="text-muted">
            {!! $dispositivo->disponible() !!}
          </p>
        </div>
        <div class="card-footer text-center">
          <small class="text-muted">
            {{ $dispositivo->created_at }}
          </small>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h4 style="margin: 0">Dispositivos de usuarios</h4>
        </div>
        <div class="card-body">
          <table class="table data-table table-striped table-no-bordered table-hover table-sm" style="width: 100%">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Serial</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($dispositivo->user as $d)
                <tr>
                  <td scope="row">{{ $loop->index + 1 }}</td>
                  <td title="{{ $d->nombres }} {{ $d->apellidos }}"><a href="{{ route('admin.users.show', ['user' => $d->id]) }}">{{ $d->email }}</a></td>
                  <td>{{ $d->pivot->serial }}</td>
                  <td>{!! $d->pivot->status() !!}</td>
                  <td>
                    <a class="btn btn-primary btn-link btn-sm" href="{{ route('dispositivos.show', ['dispositivo' => $d->pivot->id] )}}" rel="tooltip" title="Ver dispositivo" data-original-title="Ver dispositivo">
                      <i class="fa fa-search"></i>
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

  <div id="blockModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="passModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cambiar disponibilidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-md-center">
            <form class="col-md-8" action="{{ route('admin.dispositivos.disponibilidad', ['dispositivo' => $dispositivo->id]) }}" method="POST">
              @csrf
              @method('PATCH')

              <p class="text-center">
                Los Usuarios no podrán a gregar este dispositivo si no esta disponible.
                <br><br>
                ¿Esta seguro de cambiar la Disponibilidad de este Dispositivo?
              </p>

              <center>
                <button class="btn btn-fill btn-danger" type="submit">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
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
            <form class="col-md-10" action="{{ route('admin.dispositivos.destroy', ['dispositivo' => $dispositivo->id]) }}" method="POST">
              @csrf
              @method('DELETE')

              <p class="text-center">¿Esta seguro de eliminar este Dispositivo?</p><br>

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

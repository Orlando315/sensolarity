@extends('layouts.app')

@section('title','Usuarios - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('admin.users.index') }}"> Usuarios </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <a class="btn btn-default" href="{{ route('admin.users.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
      <a class="btn btn-success" href="{{ route('admin.users.edit', ['user' => $user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
      <button class="btn btn-warning" data-toggle="modal" data-target="#passModal"><i class="fa fa-lock" aria-hidden="true"></i> Cambiar contraseña</button>
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
          <strong>Role</strong>
          <p class="text-muted">
            {{ $user->role() }}
          </p>
          <hr>

          <strong>Nombres</strong>
          <p class="text-muted">
            {{ $user->nombres }}
          </p>
          <hr>

          <strong>Apellidos</strong>
          <p class="text-muted">
            {{ $user->apellidos }}
          </p>
          <hr>

          <strong>Email</strong>
          <p class="text-muted">
            {{ $user->email }}
          </p>
        </div>
        <div class="card-footer text-center">
          <small class="text-muted">
            {{ $user->created_at }}
          </small>
        </div><!-- .card-footer -->
      </div><!-- .card -->
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-microchip"></i> Dispositivos
          </h4>
        </div>
        <div class="card-body">
          <table class="table data-table table-striped table-no-bordered table-hover table-sm" style="width: 100%">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Dispositivo</th>
                <th scope="col" class="text-center">Serial</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Agregado</th>
                <th scope="col" class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($user->dispositivos as $d)
                <tr>
                  <td scope="row">{{ $loop->index + 1 }}</td>
                  <td>
                    <a href="{{ route('admin.dispositivos.show', ['dispositivo' => $d->dispositivo_id]) }}">
                      {{ $d->name() }}
                    </a>
                  </td>
                  <td>{{ $d->serial }}</td>
                  <td>{!! $d->status() !!}</td>
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
    </div>
  </div>

  <div id="passModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="passModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cambiar contraseña</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-md-center">
            <form class="col-md-8" action="{{ route('admin.users.password', ['user' => $user->id]) }}" method="POST">
              @csrf
              @method('PATCH')

              <div class="form-group">
                <label>Contraseña nueva: *</label>
                <input id="password" class="form-control" type="password" pattern=".{6,}" name="password" required>
                <small class="text-muted">Debe contener al menos 6 caracteres.</small>
              </div>
              <div class=" form-group">
                <label>Verificar: *</label>
                <input id="password_confirmation" class="form-control" type="password" pattern=".{6,}" name="password_confirmation" required>
                <small class="text-muted">Debe contener al menos 6 caracteres.</small>
              </div>

              @if(count($errors) > 0)
              <div class="alert alert-danger alert-important">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>  
              </div>
              @endif

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
          <h4 class="modal-title" id="delModalLabel">Eliminar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-md-center">
            <form class="col-md-8" action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
              @csrf
              @method('DELETE')

              <p class="text-center">¿Esta seguro de eliminar este Usuario?</p><br>

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

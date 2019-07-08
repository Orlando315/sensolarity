@extends('layouts.app')

@section('title','Dispositivos - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Dispositivos </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <a class="btn btn-default" href="{{ route('dashboard') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
      <a class="btn btn-success" href="{{ route('dispositivos.edit', ['dispositivo' => $dispositivo->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
      
      @if(Auth::user()->isAdmin())
        @if($dispositivo->disabled_at)
        <button class="btn btn-fill btn-success" data-toggle="modal" data-target="#blockModal"><i class="fa fa-check" aria-hidden="true"></i>Activar</button>
        @else
        <button class="btn btn-fill btn-warning" data-toggle="modal" data-target="#blockModal"><i class="fa fa-ban" aria-hidden="true"></i>Desactivar</button>
        @endif
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
          @if(Auth::user()->isAdmin())
          <strong>Usuario</strong>
          <p class="text-muted">
            <a href="{{ route('admin.users.show', ['user' => $dispositivo->user_id]) }}" rel="tooltip" title="{{$dispositivo->user->nombres}} {{$dispositivo->user->apellidos}}">
              {{ $dispositivo->user->email }}
            </a>
          </p>
          <hr>
          @endif

          <strong>Dispositivo</strong>
          <p class="text-muted">
            @if(Auth::user()->isAdmin())
              <a href="{{ route('admin.dispositivos.show', ['dispositivo' => $dispositivo->dispositivo_id]) }}">
                {{ $dispositivo->name() }}
              </a>
            @else
              {{ $dispositivo->name() }}
            @endif
          </p>
          <hr>

          <strong>Alias</strong>
          <p class="text-muted">
            {{ $dispositivo->config->alias ?? 'N/A' }}
          </p>
          <hr>

          <strong>Serial</strong>
          <p class="text-muted">
            {{ $dispositivo->serial }}
          </p>
          <hr>

          <strong>Estado</strong>
          <p class="text-muted">
            {!! $dispositivo->status() !!}
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
      @if($dispositivo->tipo == "M")
        @include('dispositivos.card-modulo')
      @else
        @include('dispositivos.card-point')
      @endif
    </div>

    <div class="col-12 mt-3">
      <div class="card">
        <div class="card-header">
          <h4 style="margin: 0">Datos</h4>
        </div>
        <div class="card-body">
          <table class="table data-table table-striped table-no-bordered table-hover table-sm" style="width: 100%">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Gateway</th>
                <th scope="col" class="text-center">{{ $dispositivo->aliasData(1) }}</th>
                <th scope="col" class="text-center">{{ $dispositivo->aliasData(2) }}</th>
                <th scope="col" class="text-center">{{ $dispositivo->aliasData(3) }}</th>
                <th scope="col" class="text-center">Agregado</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($dispositivo->data as $data)
                <tr>
                  <td scope="row">{{ $loop->index + 1 }}</td>
                  <td>{{ $data->gateway }}</td>
                  <td>{{ $data->data(1) }}</td>
                  <td>{{ $data->data(2) }}</td>
                  <td>{{ $data->data(3) }}</td>
                  <td>{{ $data->created_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  @if(Auth::user()->isAdmin())
  <div id="blockModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="passModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cambiar estado</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-md-center">
            <form class="col-md-8" action="{{ route('dispositivos.status', ['dispositivo' => $dispositivo->id]) }}" method="POST">
              @csrf
              @method('PATCH')
              <p class="text-center">
                Los dispositivos desactivados no guardaran información.
              </p>
              <p class="text-center">¿Esta seguro de cambiar el Estado de este Dispositivo?</p>

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
  @endif

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
            <form class="col-md-10" action="{{ route('dispositivos.destroy', ['dispositivo' => $dispositivo->id]) }}" method="POST">
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

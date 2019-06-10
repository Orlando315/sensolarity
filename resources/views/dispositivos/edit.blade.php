@extends('layouts.app')

@section('title','Dispositivos - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Dispositivos </a>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('dispositivos.update', ['dispositivo' => $dispositivo->id]) }}" method="POST">
              @csrf
              @method('PATCH')

              <h4>Editar Dispositivo</h4>

              <div class="form-group">
                <label class="control-label" for="serial">Serial: *</label>
                <input id="serial" class="form-control{{ $errors->has('serial') ? ' is-invalid' : '' }}" type="text" name="serial" maxlength="50" value="{{ old('serial') ?? $dispositivo->serial }}" placeholder="Serial" required>
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

              <div class="form-group text-right">
                <a class="btn btn-default" href="{{ route('dispositivos.show', ['dispositivo' => $dispositivo]) }}"><i class="fa fa-reply"></i> Atras</a>
                <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

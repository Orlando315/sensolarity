@extends('layouts.app')

@section('title',$dispositivo->alias() . ' - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dispositivos.modulos.index') }}"> Modulo </a>
@endsection

@section('content')
  
  @include('partials.flash')

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            <i class="fa fa-cog"></i> Configuración
          </h4>
        </div>
        <div class="card-body">
          <form action="{{ route('dispositivos.config.updateM', ['dispositivo' => $dispositivo->id, 'data' => $data]) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group{{ $errors->has('alias') ? 'has-error' : '' }}">
              <label class="control-label" for="alias">Alias data {{ $data }}:</label>
              <input id="alias" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" type="text" name="alias" maxlength="20" value="{{ old('alias') ?? $dispositivo->aliasData($data) }}" placeholder="Alias Data {{ $data }}">
            </div>
            
            <div class="form-row">
              <div class="form-group col">
                <label class="control-label" for="min">Valor mínimo:</label>
                <input id="min" class="form-control{{ $errors->has('min') ? ' is-invalid' : '' }}" type="number" name="min" min="0" max="4096" value="{{ old('min') ?? $dispositivo->min($data) }}" placeholder="Valor mínimo">
                <small class="text-muted">Valor mínimo.</small>
              </div>

              <div class="form-group col">
                <label class="control-label" for="max">Valor máximo:</label>
                <input id="max" class="form-control{{ $errors->has('max') ? ' is-invalid' : '' }}" type="number" name="max" min="0" max="4096" value="{{ old('max') ?? $dispositivo->max($data) }}" placeholder="Valor máximo">
                <small class="text-muted">Valor máximo.</small>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col">
                <label class="control-label" for="unidad">Agregar unidad:</label>
                <input id="unidad" class="form-control{{ $errors->has('unidad') ? ' is-invalid' : '' }}" type="text" name="unidad" maxlength="10" value="{{ old('unidad') ?? $dispositivo->unidad($data) }}" placeholder="Unidad">
              </div>

              <div class="form-group col">
                <label class="control-label" for="porcentual">Representar en unidad o porcentual: *</label>
                <div class="form-check" style="padding: .5rem">
                  <input id="porcentual" class="form-control{{ $errors->has('porcentual') ? ' is-invalid' : '' }}" type="checkbox" name="porcentual" {{ old('porcentual') ? 'checked' : $dispositivo->porcentual($data) == true ? 'checked' : '' }} data-toggle="switch" data-on-color="info" data-off-color="info" data-on-text="" data-off-text="">
                </div>
              </div>
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

            <div class="form-group text-center">
              <a class="btn btn-default" href="{{ route('dispositivos.modulos.index') }}"><i class="fa fa-reply"></i> Atras</a>
              <button id="send-form" class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

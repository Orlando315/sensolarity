@extends('layouts.app')

@section('title', 'Configuracion - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('admin.configurations') }}"> Configuraci&oacute;n </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <a class="btn btn-default" href="{{ route('dashboard') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    </div>
  </div>

  @include('partials.flash')

  <div class="row justify-content-center" style="margin-top: 20px">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <form class="" action="{{ route('admin.configurations.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
              <label class="control-labe" for="url">URL: *</label>
              <input id="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" type="text" name="url" maxlength="100" value="{{ old('url') ?? $store_url }}" placeholder="URL" required>
              <small class="text-muted">URL de la tienda. Usar # para desactivar link</small>
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
              <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

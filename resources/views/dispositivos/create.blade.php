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
            <form action="{{ route('dispositivos.store') }}" method="POST">
              @csrf

              <h4>Agregar Dispositivo</h4>

              <div class="form-group">
                <label class="control-label" for="tipo">Tipo: *</label>
                <select id="tipo" class="form-control" name="tipo" required>
                  <option value="P" {{ old('tipo') == 'P' ? 'selected' : '' }}> Valor en mapa (P)</option>
                  <option value="M" {{ old('tipo') == 'M' ? 'selected' : '' }}> Modulo (M)</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="codigo">Código: *</label>
                <input id="codigo" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" type="text" name="codigo" pattern=".{3}" maxlength="3" value="{{ old('codigo') }}" placeholder="Código" required>
                <small class="text-muted">Debe contener 3 caracteres.</small>
              </div>

              <div class="alert alert-form alert-dismissible alert-danger" role="alert" style="display: none">
                <strong class="text-center">Dispositivo no encontrado</strong> 
              </div>
              
              <fieldset id="final-area" style="display: none">
                <div class="form-group">
                  <label class="control-label" for="alias">Alias del dispositivo:</label>
                  <input id="alias" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" type="text" name="alias" maxlength="30" value="{{ old('alias') }}" placeholder="Alias del dispositivo">
                </div>

                <div class="form-group">
                  <label class="control-label" for="serial">Serial: *</label>
                  <input id="serial" class="form-control{{ $errors->has('serial') ? ' is-invalid' : '' }}" type="text" name="serial" maxlength="50" value="{{ old('serial') }}" placeholder="Serial" required disabled>
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
                  <a class="btn btn-default" href="{{ route('dashboard') }}"><i class="fa fa-reply"></i> Atras</a>
                  <button id="send-form" class="btn btn-primary" type="submit" disabled><i class="fa fa-send"></i> Guardar</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tipo').change(checkDevice)
      $('#codigo').keyup(checkDevice)

      checkDevice()
    })

    function checkDevice(){
      let tipo = $('#tipo'),
          codigo = $('#codigo');

      let alert = $('.alert-form');

      if(codigo.val().length == 3){
        $.ajax({
          type: 'POST',
          cache: false,
          url: '{{ route("dispositivos.checkIfExist") }}',
          data: {
            _token: '{{ csrf_token() }}',
            tipo: tipo.val(),
            codigo: codigo.val()
          },
          dataType: 'json',
        })
        .done(function (res){
          if(res){
            $('#final-area').show()
            $('#alias, #serial, #send-form').prop('disabled', false)
          }else{
            $('#final-area').hide()
            $('#alias, #serial, #send-form').prop('disabled', true)
            $('#alias, #serial').val('')
            alert.removeClass('alert-success').addClass('alert-danger')
            alert.show().delay(5000).hide('slow')
          }
        })
        .fail(function (){
          $('#final-area').hide()
          $('#alias, #serial, #send-form').prop('disabled', true)
          $('#alias, #serial').val('')
        })
      }
    }
  </script>
@endsection

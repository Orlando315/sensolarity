@extends('layouts.app')

@section('title','Valor en mapa - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Dispositivos </a>
@endsection

@section('content')
  
  @include('partials.flash')

  <div class="row justify-content-center mt-2">
    <div class="col-8 card-dispositivo">
      <h4 class="text-center">
        {{ $dispositivo->alias() }}

        <p class="text-center text-muted mb-0" style="font-size: .7em;">
          ({{ $dispositivo->serial }})
        </p>
        <div class="dropdown btn-config-dropdown">
          <button class="btn dropdown-toggle btn-fill btn-round btn-sm" type="button" id="dropdownConfigLink-{{ $dispositivo->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cogs"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownConfigLink-{{ $dispositivo->id }}">
            <a class="dropdown-item" href="{{ route('dispositivos.edit', ['dispositivo'=>$dispositivo->id]) }}">Editar</a>
            <a class="dropdown-item text-danger" href="#" role="button" data-dispositivo="{{ $dispositivo->id }}" data-toggle="modal" data-target="#delModal">Eliminar</a>
          </div>
        </div>
      </h4>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="row">

        <div class="col-4 p-1">
          <div class="card card-dispositivo m-0">
            <div class="card-body p-0">
              <div class="row m-0">

                <div class="col-md-4 p-1">
                  <div id="data-alias-1" class="border rounded p-2 text-center text-truncate" rel="tooltip" title="{{ $dispositivo->aliasData(1) }}">
                    {{ $dispositivo->aliasData(1) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div id="data-last-1" class="border rounded p-2 text-right text-truncate" rel="tooltip" title="{{ $dispositivo->lastData(1) }} {{ $dispositivo->unidad(1) }}">
                    {{ $dispositivo->lastData(1) }} {{ $dispositivo->unidad(1) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div class="border rounded p-2 text-center">
                    <a href="{{ route('dispositivos.data.history', ['dispositivo' => $dispositivo->id, 'data' => 1]) }}" title="Ver historial">
                      Historial
                    </a>
                  </div>
                </div>

                <button class="btn btn-fill btn-round btn-sm dispositivo-config-link" title="Configuracion {{ $dispositivo->aliasData(1) }}" type="button" data-toggle="modal" data-target="#configModal" data-data="1">
                  <i class="fa fa-cog"></i>
                </button>

              </div>
            </div>
          </div>
        </div>

        <div class="col-4 p-1">
          <div class="card card-dispositivo m-0">
            <div class="card-body p-0">
              <div class="row m-0">

                <div class="col-md-4 p-1">
                  <div id="data-alias-2" class="border rounded p-2 text-center text-truncate" rel="tooltip" title="{{ $dispositivo->aliasData(2) }}">
                    {{ $dispositivo->aliasData(2) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div id="data-last-2" class="border rounded p-2 text-right text-truncate" rel="tooltip" title="{{ $dispositivo->lastData(2) }} {{ $dispositivo->unidad(2) }}">
                    {{ $dispositivo->lastData(2) }} {{ $dispositivo->unidad(2) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div class="border rounded p-2 text-center">
                    <a href="{{ route('dispositivos.data.history', ['dispositivo' => $dispositivo->id, 'data' => 2]) }}" title="Ver historial">
                      Historial
                    </a>
                  </div>
                </div>

                <button class="btn btn-fill btn-round btn-sm dispositivo-config-link" title="Configuracion {{ $dispositivo->aliasData(1) }}" type="button" data-toggle="modal" data-target="#configModal" data-data="2">
                  <i class="fa fa-cog"></i>
                </button>

              </div>
            </div>
          </div>
        </div>

        <div class="col-4 p-1">
          <div class="card card-dispositivo m-0">
            <div class="card-body p-0">
              <div class="row m-0">

                <div class="col-md-4 p-1">
                  <div id="data-alias-3" class="border rounded p-2 text-center text-truncate" rel="tooltip" title="{{ $dispositivo->aliasData(3) }}">
                    {{ $dispositivo->aliasData(3) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div id="data-last-3" class="border rounded p-2 text-right text-truncate" rel="tooltip" title="{{ $dispositivo->lastData(3) }} {{ $dispositivo->unidad(3) }}">
                    {{ $dispositivo->lastData(3) }} {{ $dispositivo->unidad(3) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div class="border rounded p-2 text-center">
                    <a href="{{ route('dispositivos.data.history', ['dispositivo' => $dispositivo->id, 'data' => 3]) }}" title="Ver historial">
                      Historial
                    </a>
                  </div>
                </div>

                <button class="btn btn-fill btn-round btn-sm dispositivo-config-link" title="Configuracion {{ $dispositivo->aliasData(1) }}" type="button" data-toggle="modal" data-target="#configModal" data-data="3">
                  <i class="fa fa-cog"></i>
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12 p-0">
      <div class="card card-dispositivo m-0">
        <div class="card-body p-1">
           <div id="map" class="div" style="min-height: 70vh"></div>
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
            <form id="delete-dispositivo-form" class="col-md-10" action="{{ route('dispositivos.destroy', [$dispositivo]) }}" method="POST">
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

  <div id="configModal" class="modal fade" data-easein="slideRightBigIn"  tabindex="-1" role="dialog" aria-labelledby="configModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="config-form" action="#" method="POST">
          <input id="rangos" type="hidden" name="rangos">
          <input id="rangos-to-delete" type="hidden" name="delete">
          @csrf
          @method('PATCH')

          <div class="modal-header">
            <h4 class="modal-title" id="configModalLabel">Configuraci&oacute;n</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <fieldset>
              <legend>Rangos</legend>
              <div id="rangos-box" class="p-1">
              </div>
              <div class="p-1">
                <button class="add-rango btn btn-round btn-sm" role="button" type="button">
                  <i class="fa fa-plus" aria-hidden="true"></i> Agregar rango
                </button>
              </div>

            </fieldset>
            <fieldset>
              <div class="form-group">
                <label class="control-label" for="alias_data">Alias:</label>
                <input id="alias-data" class="form-control" type="text" name="alias_data" maxlength="20" value="" placeholder="Alias">
              </div>
              
              <div class="form-row">
                <div class="form-group col">
                  <label class="control-label" for="unidad">Agregar unidad:</label>
                  <input id="unidad" class="form-control" type="text" name="unidad" maxlength="10" value="" placeholder="Unidad">
                </div>

                <div class="form-group col">
                  <label class="control-label" for="porcentual">Representar en unidad o porcentual: *</label>
                  <div class="form-check" style="padding: .5rem">
                    <input id="porcentual" class="form-control" type="checkbox" name="porcentual" data-toggle="switch" data-on-color="info" data-off-color="info" data-on-text="" data-off-text="">
                  </div>
                </div>
              </div>

              <div class="alert alert-dismissible alert-config" role="alert">
              </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
              Cerrar
            </button>
            <button id="send-form" class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
          </div>
        </form>

        <div class="loading-screen d-flex justify-content-center align-items-center invisible">
          <div class="spinner-border text-primary" role="status" style="width: 3em; height: 3em">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#configModal').on('show.bs.modal', loadConfig);
      $('#configModal').on('hide.bs.modal', removeConfig);
      $('#config-form').submit(saveConfig)
      $('.add-rango').click(addRango)
      $('#rangos-box').on('click', '.btn-remove', removeRango)
      $('#rangos-box').on('change', '.rango-color-picker', changeSliderColor)
    })

    let rangosToDelete = []
    const alertConfig = $('.alert-config');
    const loadingScreen = $('.loading-screen');
    let dispositivo = @json($dispositivo->id);
    let rangoGroup =  `<div class="form-row rango-group" position=":position:" rango=":id:">
                        <div class="form-group col-10">
                          <input type="text" name="rango[]" position=":position:">
                        </div>
                        <div class="form-group col-2">
                          <input class="rango-color-picker" type="color" name="color[]" value=":color:">
                        </div>
                        <button class="btn btn-danger btn-fill btn-round btn-sm btn-remove" title="Eliminar rango" type="button">
                          &times;
                        </button>
                      </div>
                      `;

    // Cargar configuracion de una Data especificoa
    function loadConfig(e) {
      let btn = $(e.relatedTarget),
          data = btn.data('data');

      loadingScreen.toggleClass('invisible', false)

      $('#config-form').data('data', data)

      $.ajax({
        type: 'POST',
        url: `{{ route("dispositivos.index") }}/${dispositivo}/get/${data}/config`,
        data: {_token: '{{ @csrf_token() }}'},
        dataType: 'json',
      })
      .done(function (response) {
        $('#alias-data').val(response.alias)
        $('#unidad').val(response.unidad)
        $('#porcentual').prop('checked', response.porcentual).trigger('change')

        $.each(response.rangos, function (k, rango) {
          addRango(rango.id, rango.min, rango.max, rango.color)
        })

        loadingScreen.toggleClass('invisible', true)
      })
      .fail(function () {
        showAlert()
      })
    }

    // Eliminar datos de configuracion del modal
    function removeConfig() {
      $('#rangos').val(null)
      $('#rangos-to-delete').val(null)
      $('#alias-data').val(null)
      $('#unidad').val(null)
      $('#porcentual').prop('checked', false).trigger('change')

      rangosToDelete = []

      $.each($('.rango-group'), function (k) {
        removeRango(k + 1, false)
      })
    }

    // Obtener el valor maximo del ultimo rango
    function getRangeValue(position, index = 1)
    {
      return $(`input[position="${position}"]`).slider('getValue')[index]
    }

    // Agregar rango
    function addRango(id = null, min = null, max = null, color = '#ffffff') {
      let count = $('.rango-group').length

      if(count < 6){
        id = Number.isInteger(id) ? id : '';
        let position = count + 1
        // Si no se recibe el min, se coloca el maximo del rango anterior + 1
        let minRange = min != null ? min : count > 0 ? getRangeValue(count) + 1 : 0
        let maxRange = max || minRange + 1

        let group = rangoGroup
                      .replace(/:id:/gi, id)
                      .replace(/:color:/gi, color)
                      .replace(/:position:/gi, position)
        $('#rangos-box').append(group)

        $(`input[position="${position}"]`).slider({
          min: 0,
          max: 4096,
          value: [minRange, maxRange],
          range: true,
        });

        $(`.rango-group[position="${position}"] .rango-color-picker`).change();

        // Ocultar boton de agregar si hay 6 rangos
        ++count >= 6 && $(this).hide()
      } 
    }

    // Elimiar rango
    function removeRango(position = null, shouldFixPositions = true) {
      position = Number.isInteger(position) ? position : $(this).closest('.rango-group').attr('position');
      let rangoId = $(`.rango-group[position="${position}"]`).attr('rango')

      if(rangoId){
        rangosToDelete.push(rangoId)
      }

      $(`.rango-group[position="${position}"]`).remove()
      $(`input[position="${position}"]`).slider('destroy')

      // Mostrar boton para agregar rangos
      $('.add-rango').show()

      // No arreglar posiciones al cerrar el modal
      shouldFixPositions && fixPositions()
    }

    // Arreglar posiciones de los rangos
    function fixPositions() {
      $.each($('.rango-group'), function (k, rango) {
        let position = k + 1,
            previousPosition = $(rango).attr('position');

        $(rango).attr('position', position)
        $(`input[position="${previousPosition}"]`).attr('position', position)
      })
    }

    // Cambiar el color del slider con el color seleccionado del Usuario
    function changeSliderColor() {
      let color = $(this).val(),
          position = $(this).closest('.rango-group').attr('position');

      $(`.rango-group[position="${position}"] .slider-selection`).css('background', color)
    }

    // Devolver informacion de los rangos como texto
    function stringifyRangos() {
      let rangos = []

      $.each($('.rango-group'), function (k, rango) {
        let position = $(rango).attr('position'),
            id = $(rango).attr('rango'),
            min = getRangeValue(position, 0),
            max = getRangeValue(position, 1),
            color = $(rango).find('.rango-color-picker').val();

        rangos.push({
          id: id,
          min: min,
          max: max,
          color: color,
        })
      })

      return JSON.stringify(rangos)
    }

    // Guardar configuracion
    function saveConfig(e) {
      e.preventDefault();

      let form = $(this),
          data = form.data('data'),
          btn  = $('#send-form');

      loadingScreen.toggleClass('invisible', false)

      let rangos = stringifyRangos()
      $('#rangos').val(rangos)
      $('#rangos-to-delete').val(JSON.stringify(rangosToDelete))

      btn.prop('disabled', true)

      $.ajax({
        type: 'POST',
        url: `{{ route("dispositivos.index") }}/${dispositivo}/p/${data}/config`,
        data: form.serialize(),
        dataType: 'json',
      })
      .done(function (response) {
        if(response){
          $(`#data-alias-${data}`).text(response.alias)
          $(`#data-last-${data}`).text(response.lastData)

          showAlert(false)
        }else{
          showAlert()
        }
      })
      .fail(function () {
        showAlert()
      })
      .always(function () {
        btn.prop('disabled', false)
      })
    }

    function showAlert(error = true){
      let message = error ? 'Ha ocurrido un error.' : 'Cambios guardados con exito.';

      alertConfig
        .toggleClass('alert-danger', error)
        .toggleClass('alert-success', !error)

      alertConfig.text(message)
      alertConfig.show().delay(5000).hide('slow')

      loadingScreen.toggleClass('invisible', true)
    }
  </script>
@endsection

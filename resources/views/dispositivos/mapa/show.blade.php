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
    <div id="dispositivo-{{ $dispositivo->id }}" class="col-12">
      <div class="row">

        <div class="col-md-4 p-1 data-container" data-data="1">
          <div class="card card-dispositivo m-0">
            <div class="card-body p-0">
              <div class="row m-0">

                <div class="col-md-4 p-1">
                  <div id="data-alias-1" class="border rounded p-2 text-center text-truncate" rel="tooltip" title="{{ $dispositivo->aliasData(1) }}">
                    {{ $dispositivo->aliasData(1) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div class="border rounded p-2 text-right text-truncate dispositivo-data-1" data-last="{{ $dispositivo->lastData(1) }}" rel="tooltip" title="{{ $dispositivo->lastData(1) }} {{ $dispositivo->unidad(1) }}">
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

                <button class="btn btn-fill btn-round btn-sm dispositivo-config-link" title="Configuracion {{ $dispositivo->aliasData(1) }}" type="button" data-data="1">
                  <i class="fa fa-cog"></i>
                </button>

              </div>
            </div>
          </div>
        </div>

        <div data-data="2" class="col-md-4 p-1 data-container">
          <div class="card card-dispositivo m-0">
            <div class="card-body p-0">
              <div class="row m-0">

                <div class="col-md-4 p-1">
                  <div id="data-alias-2" class="border rounded p-2 text-center text-truncate" rel="tooltip" title="{{ $dispositivo->aliasData(2) }}">
                    {{ $dispositivo->aliasData(2) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div class="border rounded p-2 text-right text-truncate dispositivo-data-2" data-last="{{ $dispositivo->lastData(2) }}" rel="tooltip" title="{{ $dispositivo->lastData(2) }} {{ $dispositivo->unidad(2) }}">
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

                <button class="btn btn-fill btn-round btn-sm dispositivo-config-link" title="Configuracion {{ $dispositivo->aliasData(1) }}" type="button" data-data="2">
                  <i class="fa fa-cog"></i>
                </button>

              </div>
            </div>
          </div>
        </div>

        <div data-data="3" class="col-md-4 p-1 data-container">
          <div class="card card-dispositivo m-0">
            <div class="card-body p-0">
              <div class="row m-0">

                <div class="col-md-4 p-1">
                  <div id="data-alias-3" class="border rounded p-2 text-center text-truncate" rel="tooltip" title="{{ $dispositivo->aliasData(3) }}">
                    {{ $dispositivo->aliasData(3) }}
                  </div>
                </div>
                <div class="col-md-4 p-1">
                  <div class="border rounded p-2 text-right text-truncate dispositivo-data-3" data-last="{{ $dispositivo->lastData(3) }}" rel="tooltip" title="{{ $dispositivo->lastData(3) }} {{ $dispositivo->unidad(3) }}">
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

                <button class="btn btn-fill btn-round btn-sm dispositivo-config-link" title="Configuracion {{ $dispositivo->aliasData(1) }}" type="button" data-data="3">
                  <i class="fa fa-cog"></i>
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-2 justify-content-center">
    <div class="col-md-1 border rounded p-2{{ $dispositivo->config->hasPosition() ? ' border-default' : ' border-primary' }}">
      <img id="google-pin" class="d-flex mx-auto{{ $dispositivo->config->hasPosition() ? ' invisible' : '' }}" src="{{ asset('img/google-pin.png') }}" alt="Google pin" draggable="true">
    </div>
    <div class="col-12 mt-2">
      <div class="alert alert-dismissible alert-map m-0" role="alert" style="display: none">
      </div>
    </div>
  </div>

  <div class="row mt-2">
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

  <div id="config-modal" class="modal fade" data-easein="slideRightBigIn"  tabindex="-1" role="dialog" aria-labelledby="config-modalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="config-form" action="#" method="POST">
          <input id="rangos" type="hidden" name="rangos">
          <input id="rangos-to-delete" type="hidden" name="delete">
          @csrf
          @method('PATCH')

          <div class="modal-header">
            <h4 class="modal-title" id="config-modalLabel">Configuraci&oacute;n</h4>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBoqIKTFDnTKZ_xy5Q_X64P1LsbDhkPzds&callback=initMap"
  async defer></script>
  <script type="text/javascript" src="{{ asset('js/plugins/DragDropTouch.js') }}"></script>

  @component('partials.dispositivosPusher')
    updateSelectedData(k+1, v)
  @endcomponent

  <script type="text/javascript">
    $(document).ready(function () {
      $('#config-modal').on('show.bs.modal', loadConfig);
      $('#config-modal').on('hide.bs.modal', removeConfig);
      $('#config-form').submit(saveConfig)
      $('.add-rango').click(addRango)
      $('#rangos-box').on('click', '.btn-remove', removeRango)
      $('#rangos-box').on('change', '.rango-color-picker', changeSliderColor)
      $('.data-container').click(loadSelectedData)
      $('.dispositivo-config-link').click(function (e) {
        e.stopPropagation()
        $('#config-modal').modal('show')
      })

      $('#google-pin').on('drag', draggingPin)

      $('html').on('dragover', function(e) {
                  e.preventDefault();
                  return false
                })
                .on('drop', function(e){
                  e.preventDefault();
                  return false
                })

      $('#map').on('drop', dropedPin)

      // Si no hay ubicacion guardara, usar la HTML5 geolocation
      if(!@json($dispositivo->config->lat) && !@json($dispositivo->config->lng)){
        getLocation()
      }else{
        initMarker()
      }
    })

    let selectedData = null
    let selectedDataRangos = []
    let selectedDataValue = 0
    let rangosToDelete = []
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
      .always(function () {
        loadingScreen.toggleClass('invisible', true)
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
          $(`.dispositivo-data-${data}`).text(response.lastData)

          if(data == selectedData){
            selectedDataRangos = response.rangos
            updateCircle()
          }

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
        loadingScreen.toggleClass('invisible', true)
      })
    }

    function showAlert(element = '.alert-config', error = true){
      let message = error ? 'Ha ocurrido un error.' : 'Cambios guardados con exito.';
      let alert = $(element)
      alert
        .toggleClass('alert-danger', error)
        .toggleClass('alert-success', !error)

      alert.text(message)
      alert.show().delay(5000).hide('slow')
    }

    var map, marker, infoWindow, saveMapBtn, overlayLayer, dataCircle;
    var zoom = @json($dispositivo->config->zoom);
    var myPosition = {
          lat: @json($dispositivo->config->lat) || -34.397,
          lng: @json($dispositivo->config->lng) || 150.644
        };
    const alertMap = $('.alert-map');

    // Crear boton para gaurdar ubicacion del mapa
    (function () {
      saveMapBtn = document.createElement('button')
      saveMapBtn.id = 'save-map-btn'
      saveMapBtn.innerHTML = 'Guardar ubicación'
      saveMapBtn.title = 'Guardar informacón de ubicación'
      saveMapBtn.className = 'btn btn-sm btn-fill btn-primary mt-2'

      saveMapBtn.addEventListener('click', saveMapLocation)
    })()

    // Inicializar Google Maps
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: myPosition.lat,
          lng: myPosition.lng,
        },
        zoom: zoom || 12,
        mapTypeControl: false,
        streetViewControl: false,
      })

      // Insertar boton en el mapa
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(saveMapBtn)

      overlayLayer = new google.maps.OverlayView()
      overlayLayer.draw = function() {}
      overlayLayer.setMap(map)
    }

    // Iniciar el marcador
    function initMarker() {
      if(!google || !map){
        setTimeout(initMarker, 1000)
        return false
      }

      marker = new google.maps.Marker({
        map: map,
        position: myPosition,
        title: '{{ $dispositivo->alias() }}',
        draggable: true,
      })

      // Al iniciar el arrastre del pin
      google.maps.event.addListener(marker, 'dragstart', function() {
        // Agragar animacion
        marker.setAnimation(google.maps.Animation.BOUNCE)
      })

      // Durante e arrastre del pin
      google.maps.event.addListener(marker, 'drag', function() {
        map.setOptions({draggable: false});
        let pixelPosition =  getPixelPosition()

        // Sacar pin de mapa si la posicion del pin alcanza los bordes
        if(pixelPosition.y <= 10 || pixelPosition.x <= 10){
          dragOut()
        }
      })

      // Al soltar el pin
      google.maps.event.addListener(marker, 'dragend', function(e) {
        // Eliminar animacion
        marker.setAnimation(google.maps.Animation.DROP)
        map.setOptions({draggable: true});

        // Guardar ubicacion
        myPosition.lat = e.latLng.lat()
        myPosition.lng = e.latLng.lng()
      })
    }

    // Obtener ubicacion del usuario
    function getLocation() {
      if(!google || !map){
        setTimeout(getLocation, 1000)
        return false
      }

      infoWindow = new google.maps.InfoWindow({
        position: map.getCenter()
      })

      // HTML5 geolocation
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          myPosition = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          } 

          infoWindow.setPosition(myPosition)
          infoWindow.setContent('Ubicación encontrada.')
          infoWindow.open(map)
          map.setCenter(myPosition)
          initMarker()

          // Ocular la ventana de informacion en el mapa
          setTimeout(function(){
            infoWindow.close()
          }, 5000)

          // Quitar Pin de Google
          toggleGooglePinStatus(false)

        }, function() {
          handleLocationError(true, infoWindow, map.getCenter())
        });
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter())
      }
    }

    // Error al ubicar la posicion
    function handleLocationError(browserHasGeolocation) {
      infoWindow.setPosition(myPosition)
      infoWindow.setContent(browserHasGeolocation ?
                            'Error: El servicio de Geolocalizacion falló.' :
                            'Error: Tu navegador no soporta geolocalización.');
      infoWindow.open(map)

      // Ocular la ventana de informacion en el mapa
      setTimeout(function(){
        infoWindow.close()
      }, 5000)
    }
    // Al arrastrar el Pin, disminuir el opacity
    function draggingPin(e) {
      e.preventDefault();
      e.stopPropagation();
      e.originalEvent.target.style.opacity = '0.4'
    }

    // Al soltar el pin
    function dropedPin(e) {
      e.preventDefault();
      e.stopPropagation();
      document.getElementById('google-pin').style.opacity = '1'

      let x = e.pageX - $('#map').offset().left,
          y = e.pageY - $('#map').offset().top;
      
      if(y > 0) {
        let point = new google.maps.Point(x, y),
            pointPosition = overlayLayer.getProjection().fromContainerPixelToLatLng(point)
        
        // Guardar ubicacion
        myPosition.lat = pointPosition.lat()
        myPosition.lng = pointPosition.lng()

        initMarker()
        toggleGooglePinStatus(false)
      }
    }

    // Cuando el marcador esta fuera del mapa.
    function dragOut() {
      map.setOptions({draggable: true})
      marker.setMap(null)
      myPosition.lat = null
      myPosition.lng = null

      // Colocar el pin de Google como disponible para mover
      toggleGooglePinStatus(true)
    }

    // Colocar el Pin de Google disponible/no disponible para arrastrar
    function toggleGooglePinStatus(addClass = null)
    {
      addClass = addClass === null ? !$('#google-pin').parent().hasClass('border-primary') : addClass
      $('#google-pin').parent()
                      .toggleClass('border-primary', addClass)
                      .toggleClass('border-default', !addClass)
      $('#google-pin').toggleClass('invisible', !addClass)
    }

    // Obtener la ubicacion del pin con relacion a la ubicacion del mapa en pantalla
    function getPixelPosition () {
      let scale = Math.pow(2, map.getZoom()),
          nw = new google.maps.LatLng(
            map.getBounds().getNorthEast().lat(),
            map.getBounds().getSouthWest().lng()
          );
      let worldCoordinateNW = map.getProjection().fromLatLngToPoint(nw),
          worldCoordinate = map.getProjection().fromLatLngToPoint(marker.getPosition()),
          pixelOffset = new google.maps.Point(
            Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale),
            Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale)
          );

      return {
        x: pixelOffset.x,
        y: pixelOffset.y,
        right:  document.getElementById('map').clientWidth - pixelOffset.x,
        bottom: document.getElementById('map').clientHeight - pixelOffset.y
      };
    }

    // Guardar ubicacion del Pin en DB al darle al boton en el Mapa
    function saveMapLocation() {
      $('#save-map-btn').attr('disabled', true)

      $.ajax({
        type: 'POST',
        url: '{{ route("dispositivos.config.location", ["dispositivo" => $dispositivo->id]) }}',
        data: {
          _token: '{{ csrf_token() }}',
          _method: 'PATCH',
          lat: myPosition.lat,
          lng: myPosition.lng,
          zoom: map.getZoom(),
        },
        dataType: 'json',
      })
      .done(function(response) {
        showAlert('.alert-map', !response)
        dataCircle && updateCircle()
      })
      .fail(function() {
        showAlert('.alert-map')
      })
      .always(function() {
        $('#save-map-btn').attr('disabled', false)
      })
    }

    function loadSelectedData() {
      selectedData = $(this).data('data')
      markAsSelected()

      $.ajax({
        type: 'POST',
        url: `{{ route("dispositivos.index") }}/${dispositivo}/get/${selectedData}/config`,
        data: {_token: '{{ @csrf_token() }}'},
        dataType: 'json',
      })
      .done(function (response) {

        selectedDataRangos = [...response.rangos]
        setSelectedDataValue()

        dataCircle ? updateCircle() : createCircle()
      })
      .fail(function () {
        showAlert()
      })
      .always(function () {
      })
    }

    // Marcar el data-container seleccionado con un .border-primary
    function markAsSelected() {
      $('.data-container .card').removeClass('border-primary')
      $(`.data-container[data-data="${selectedData}"] .card`).addClass('border-primary')
    }

    function setSelectedDataValue() {
      let value = $(`.dispositivo-data-${selectedData}`).data('last')

      if(typeof value === 'string'){
        value = value.replace('.', '') * 1
      }

      selectedDataValue = value;
    }

    function getSelectedRangoColor() {
      let rangoColor = null;

      selectedDataRangos.forEach(rango => {
        if(rango.min <= selectedDataValue && rango.max >= selectedDataValue){
          rangoColor = rango.color
        }
      });

      return rangoColor || '#FFFFFF';
    }

    // Crear circulo en Google Maps
    function createCircle() {
      let color = getSelectedRangoColor();

      dataCircle = new google.maps.Circle({
        strokeColor: color,
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: color,
        fillOpacity: 0.3,
        map: map,
        center: myPosition,
        radius: 1000,
      })
    }

    function updateCircle() {
      let color = getSelectedRangoColor()
      dataCircle.setOptions({
        strokeColor: color,
        fillColor: color,
        center: myPosition,
      })
    }

    function updateSelectedData(data, value) {
      if(data == selectedData){
        selectedDataValue = value.split(' ')[0] * 1;
        updateCircle()
      }
    }

  </script>
@endsection

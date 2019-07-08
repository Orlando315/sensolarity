@extends('layouts.app')

@section('title','Dispositivos - '.config('app.name'))

@section('head')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Dispositivos </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <a class="btn btn-default" href="{{ url()->previous() }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    </div>
  </div>

  <div class="row mt-2 justify-content-center">
    <div class="col-md-4">
      <div id="reportrange" class="border p-1" style="background: #fff; cursor: pointer;">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
      </div>
    </div>

    <div class="col-md-2 mt-2 mt-md-0">
      <button id="search" class="btn btn-sm btn-fill btn-primary" type="button">
        <i class="fa fa-search" aria-hidden="true"></i> Buscar
      </button>
    </div>

    <div class="col-12 mt-2">
      <div class="alert alert-dismissible alert-danger alert-chart" role="alert" style="display: none">
        Ha ocurrido un error
      </div>
    </div>
  </div>
  
  <div class="row mt-4">
    <div class="col-12">
      <div class="card card-dispositivo">
        <div class="card-header">
          <h4 class="card-title text-center">
            {{ $dispositivo->aliasData($data) }}

            <p class="text-center text-muted mb-0" style="font-size: .7em;">
              {{ $dispositivo->alias() }}
            </p>
          </h4>
        </div>
        <div class="card-body p-1 overflow-auto">
          <div id="container" style="min-width: 310px; height: 400px;"></div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/plugins/moment-with-locales.min.js') }}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/modules/export-data.js"></script>
  <script type="text/javascript" src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#reportrange').daterangepicker({
        startDate: startDate,
        endDate: endDate,
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
           'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
           'Este mes': [moment().startOf('month'), moment().endOf('month')],
           'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
          format: 'DD/MM/YYYY',
          separator: ' - ',
          applyLabel: 'Aplicar',
          cancelLabel: 'Cancelar',
          fromLabel: 'Desde',
          toLabel: 'Hasa',
          customRangeLabel: 'Personlaizada',
          weekLabel: 'W',
          daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Dicimbre'],
          firstDay: 1
        },
      }, cb);

      // Mostrar fechas
      cb(startDate, endDate);

      // Crear grafico
      loadChart()

      // Obtener datos
      $('#search').click(getData)
      $('#search').click()
    }) // Ready

    moment.locale('es');
    var startDate = moment().subtract(29, 'days').hours(0).minutes(0).seconds(0)
    var endDate = moment()
    var chart = null

    // Callback daterangepicker
    function cb(start, end) {
      startDate = start
      endDate = end
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    // Obtener informacion con las fechas seleccionadas
    function getData() {
      $.ajax({
        type: 'POST',
        url: '{{ route("dispositivos.data.get", ["dispositivo" => $dispositivo->id, "data" => $data]) }}',
        data: {
          _token: '{{ csrf_token() }}',
          start: startDate.format('YYYY-MM-DD H:mm:ss'),
          end: endDate.format('YYYY-MM-DD H:mm:ss')
        },
        dataType: 'json',
      })
      .done(function(response) {
        if(response){
          updateChart(response.created, response.data)
        }else{
          $('.alert-chart').show().delay(5000).hide('slow')
        }
      })
      .fail(function() {
        $('.alert-chart').show().delay(5000).hide('slow')
      })
      .always(function() {
      })
    }

    // Actualizar inormacion del grafico
    function updateChart(xAxis, data) {
      chart.xAxis[0].update({
        categories: xAxis
      })

      chart.series[0].update({
        name: '{{ $dispositivo->aliasData($data) }}',
        data: data
      })
    }

    // Cargar el grafico
    function loadChart(){
      chart = Highcharts.chart('container', {
        exporting: {
          buttons: {
            contextButton: {
              menuItems: ['viewFullscreen', 'printChart', 'downloadPNG', 'downloadJPEG']
            }
          },
          menuItemDefinitions: {
            viewFullscreen: {
              text: 'Ver en pantalla completa'
            },
            printChart: {
              text: 'Imprimir'
            },
            downloadPNG: {
              text: 'Descargar como PNG'
            },
            downloadJPEG: {
              text: 'Descargar como JPEG'
            },
          }
        },
        chart: {
          type: 'area'
        },
        credits: {
            enabled: false
        },
        title: {
          text: ''
        },
        xAxis: {
          categories: null,
        },
        yAxis: {
          title: {
            text: 'Datos'
          },
        },
        tooltip: {
          pointFormat: '{series.name} <b>{point.y:,.0f}</b><br/>'
        },
        series: [{
          name: '{{ $dispositivo->aliasData($data) }}',
          data: null
        }]
      });
    }
  </script>
@endsection

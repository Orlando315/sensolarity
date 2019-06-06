@extends('layouts.app')

@section('title', 'Inicio - '.config('app.name'))

@section('brand')
  <a class="navbar-brand" href="{{ route('dashboard') }}"> Inicio </a>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h3>Inicio</h3>
    </div>
  </div>
@endsection

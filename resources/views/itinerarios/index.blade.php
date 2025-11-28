@extends('layouts.app')
@section('title', 'panel')
@section('content')
 <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      @include('layouts.app.nav')
      @include('layouts.app.menu')

    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div id="itinerarios-page">
          <v-itinerarios 
            :empresas="{{ json_encode($empresas) }}" 
            :sucursales="{{ json_encode($sucursales) }}"
            :buses="{{ json_encode($buses) }}"
            :choferes="{{ json_encode($choferes) }}"
            :destinos="{{ json_encode($destinos) }}"
            :user="{{ json_encode(auth()->user()) }}"></v-itinerarios>
        </div>
        @include('layouts.app.derechos')
      </div>
    </div>
  </div>
  @endsection
  @section('custom-js')
  <script src="/js/dist/manifest.js"></script>
  <script src="/js/dist/vendor.js"></script>
  <script src="/js/dist/itinerarios.js"></script>
  @stop


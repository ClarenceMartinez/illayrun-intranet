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
        <div id="buses-page">
            <v-buses :caracteristicas_base="{{ json_encode($caracteristicas_base) }}" :empresas="{{ json_encode($empresas) }}" :usuario="{{ auth()->user()->id }}"></v-buses>
        </div>
        @include('layouts.app.derechos')
      </div>
    </div>
  </div>
  @endsection
@section('custom-js')
  <script src="/js/dist/manifest.js"></script>
  <script src="/js/dist/vendor.js"></script>
  <script src="/js/dist/bus.js"></script>
  <script src="/js/dist/buses.js"></script>
@stop

@extends('layouts.app')
@section('title', 'panel')
@section('styles')
<style type="text/css">
    .form-control,
    .typeahead,
    .tt-query,
    .tt-hint,
    .select2-container--default .select2-selection--single .select2-search__field,
    .select2-container--default .select2-selection--single,
    .jsgrid .jsgrid-table .jsgrid-filter-row input[type=number],
    .jsgrid .jsgrid-table .jsgrid-filter-row input[type=text],
    .jsgrid .jsgrid-table .jsgrid-filter-row select,
    .dataTables_wrapper select,
    .asColorPicker-input {
        height: 36px;
    }
</style>
@endsection
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
                <div id="ventas-page">
                    <v-ventas :sucursales="{{ json_encode($sucursales) }}" :usuario="{{ json_encode(auth()->user()) }}"></v-ventas>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                @include('layouts.app.derechos')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
@section('custom-js')
<script src="/js/dist/manifest.js"></script>
<script src="/js/dist/vendor.js"></script>
<script src="/js/dist/venta-asiento.js"></script>
<script src="/js/dist/venta-bus.js"></script>
<script src="/js/dist/venta-form.js"></script>
<script src="/js/dist/venta-modal.js"></script>
<script src="/js/dist/ventas.js"></script>

<link rel="stylesheet" href="/css/venta-bus.css">
@stop

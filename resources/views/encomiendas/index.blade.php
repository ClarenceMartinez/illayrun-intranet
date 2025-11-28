@extends('layouts.app')
@section('title', 'panel')
@section('styles')
<link rel="stylesheet" href="{{ asset('vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
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
        <div class="horizontal-menu">
            @include('layouts.app.nav')
            @include('layouts.app.menu')
        </div>

        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div id="encomiendas-page">
                    <v-encomiendas :sucursales="{{ json_encode($sucursales) }}" :tipodocumentos="{{ json_encode($tipodocumentos) }}" :usuario="{{ json_encode(auth()->user()) }}"></v-encomiendas>
                </div>
                @include('layouts.app.derechos')
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script src="/js/dist/manifest.js"></script>
    <script src="/js/dist/vendor.js"></script>
    <script src="/js/dist/encomiendas.js"></script>
@stop



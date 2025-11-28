@extends('layouts.app')
@section('title', 'panel')
@section('styles')
    <link rel="stylesheet" href="{{ 'vendors/jquery-toast-plugin/jquery.toast.min.css' }}">
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
                <div class="content-wrapper">
                    <div class="row grid-margin">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">LIQUIDACION DE CAJA / DANES / FUNDICION </h4>
                                    <div id="" class="row">
                                        <form id="form_buses_filtros" action="">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha</label>
                                                        <input type="date" class="form-control form-control-md"
                                                            name="desde" id="desde" value="2022-12-01">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="">Cod. Apertura</label>
                                                        <select name="" id=""
                                                            class="form-control form-control-md">
                                                            <option value="">SELECCIONE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group mt-4">
                                                        <button type="button" id="search_buses"
                                                            class="btn btn-secondary btn-sm text-white mt-1"><i
                                                                class="ti-search"></i> Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="resumen-tab" data-bs-toggle="tab" href="#resumen-1" role="tab"
                                                aria-controls="resumen-1" aria-selected="true">Resumen</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="detalles-tab" data-bs-toggle="tab" href="#detalles-1" role="tab"
                                                aria-controls="detalles-1" aria-selected="false">Detalles</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="visa-tab" data-bs-toggle="tab" href="#visa-1" role="tab"
                                                aria-controls="visa-1" aria-selected="false">Visa</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="resumen-1" role="tabpanel"
                                            aria-labelledby="resumen-tab">
                                            @include('caja.resumen')
                                        </div>
                                        <div class="tab-pane fade" id="detalles-1" role="tabpanel" aria-labelledby="detalles-tab">
                                            @include('caja.detalles')
                                        </div>
                                        <div class="tab-pane fade" id="visa-1" role="tabpanel" aria-labelledby="visa-tab">
                                            @include('caja.ventastarjeta')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">IMPRESIÓN / CERRAR CAJA</h4>
                                    <div class="row justify-content-end">
                                        <div class="col-5">
                                            <button type="button" class="btn btn-outline-info btn-fw"> <i class="fa fa-file-text-o"></i> Imprimir Detallado</button>
                                            <button type="button" class="btn btn-outline-info btn-fw"><i class="fa fa-print"></i> Imprimir</button>
                                            <button type="button" class="btn btn-outline-info btn-fw"><i class="fa fa-times"></i> Cerrar Caja</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                @include('layouts.app.derechos')
                @include('encomiendas.nuevo')

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
@section('custom-js')
    <!-- <script src="../../../../js/modal-demo.js"></script> -->
@stop
@section('scripts')
    {{-- <!-- jQuery -->
<script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('../../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>

    <script src="{{ asset('js/encomiendas/encomiendas.js') }}"></script>
@endsection

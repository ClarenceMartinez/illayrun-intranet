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
                <div class="content-wrapper">
                    <div class="row grid-margin">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">BUSCAR POR DOCUMENTO</h4>
                                    <div id="" class="row">
                                        <form id="form_buses_filtros" action="">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Forma</label>
                                                        <select name="" id=""
                                                            class="form-control form-control-md">
                                                            <option value="">Seleccione...</option>
                                                            <option value="">Por Cliente</option>
                                                            <option value="">Por Documento</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Tipo</label>
                                                        <select name="" id=""
                                                            class="form-control form-control-md">
                                                            <option value="">Seleccione...</option>
                                                            <option value="">DNI</option>
                                                            <option value="">Carnet Extranjero</option>
                                                            <option value="">Pasaporte</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Número</label>
                                                        <input type="text" class="form-control form-control-md"
                                                            name="desde">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" id="btnFiltros"
                                                        class="btn btn-outline-info btn-sm mt-4"><i
                                                            class="fa fa-sliders"></i> Filtros</button>
                                                    <button type="button" id="btnCleanFiltros"
                                                            class="btn btn-outline-warning btn-sm mt-4"><i
                                                                class="ti-eraser"></i> Limpiar</button>
                                                </div>
                                                <div class="col-md-2 ">
                                                    <div id="filtros" class="form-group ">
                                                        <label for="">T. Procesos</label>
                                                        <div class="pb-0">
                                                            <button type="button" class="btn btn-link btn-sm">V.
                                                                Boleto</button>
                                                            <button type="button" class="btn btn-link btn-sm">Exceso
                                                                E.</button>
                                                            <button type="button" class="btn btn-link btn-sm">F.
                                                                Abierta</button>
                                                            <button type="button"
                                                                class="btn btn-link btn-sm">Reintegro</button>
                                                            <button type="button"
                                                                class="btn btn-link btn-sm">Encomienda</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 ">
                                                    <div class="form-group mt-3"
                                                        style="display: flex;width: 100%;justify-content: flex-end;">
                                                        <button type="button" id="search_buses"
                                                            class="btn btn-primary btn-sm text-white"><i
                                                                class="ti-reload"></i> Actualizar</button>
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
                            <div class="table-responsive bg-white">
                                <table id="order-listing" class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">#</th>
                                            <th class="text-center align-middle">FECHA</th>
                                            <th class="text-center align-middle">DOCUMENTO</th>
                                            <th class="text-center align-middle">CLIENTE</th>
                                            <th class="text-center align-middle">T. PROCESO</th>
                                            <th class="text-center align-middle">F. PAGO</th>
                                            <th class="text-center align-middle">TOTAL</th>
                                            <th class="text-center align-middle">ESTADO</th>
                                            <th class="text-center align-middle">REGISTRO</th>
                                            <th class="text-center align-middle">ANULADO</th>
                                            <th class="text-center align-middle"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>22/10/2022</td>
                                            <td>BV BP1100007480</td>
                                            <td>DNI 74589749 Danes Ronaldinhio Coronel Castillo</td>
                                            <td>V. Boleto</td>
                                            <td>Efectivo</td>
                                            <td>S/40,00</td>
                                            <td>Activo</td>
                                            <td>Vendedor | 20:00:35</td>
                                            <td></td>
                                            <td><button type="button" class="btn btn-link p-1 text-primary"><i class="fa fa-ticket"></i> </button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>22/10/2022</td>
                                            <td>BV BP1100007480</td>
                                            <td>DNI 74589749 Danes Ronaldinhio Coronel Castillo</td>
                                            <td>V. Boleto</td>
                                            <td>Efectivo</td>
                                            <td>S/40,00</td>
                                            <td>Activo</td>
                                            <td>Vendedor | 20:00:35</td>
                                            <td>Vendedor | 22/10/2022 - 20:00:35 | Motivo de Anulación</td>
                                            <td><button type="button" class="btn btn-link p-1 text-primary"><i class="fa fa-ticket"></i> </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                @include('layouts.app.derechos')
                @include('ventas.nuevo')

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

    <script>
        (function($) {
            'use strict';
            $('#filtros').hide();
            $('#btnFiltros').click(function() {
                $('#filtros').show();
            });
            $('#btnCleanFiltros').click(function() {
                $('#filtros').hide();
            });
        })(jQuery);
    </script>
@endsection

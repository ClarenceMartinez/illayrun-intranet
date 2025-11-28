@extends('layouts.app')
@section('title', 'panel')
@section('content')
    <style type="text/css">
        .form-control, .typeahead, .tt-query, .tt-hint, .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single, .jsgrid .jsgrid-table .jsgrid-filter-row input[type=number], .jsgrid .jsgrid-table .jsgrid-filter-row input[type=text], .jsgrid .jsgrid-table .jsgrid-filter-row select, .dataTables_wrapper select, .asColorPicker-input {
            height: 36px;
        }
    </style>

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
                  <h4 class="card-title">EMPRESAS</h4>
                  <p class="card-text">
{{--                    Click on any image to open in lightbox gallery--}}
                  </p>
                  <div id="" class="row">
                    <form id="form_empresa_filtros" action="">
                      <div class="row">
                        <div class="col-2">
                          <div class="form-group">
                            <label for="filter-nombre_comercial">Empresa</label>
                            <select name="nombre_comercial" id="filter-nombre_comercial" class="form-control form-control-md">
                                <option value="">SELECCIONE</option>
                                @foreach($tableRows as $row)
                                    <option value="{{ $row->nombre_comercial }}">{{ $row->nombre_comercial }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                          <div class="col-3">
                              <div class="form-group">
                                  <label for="filter-nombre_comercial">Ruc</label>
                                  <input type="text" class="form-control form-control-sm resetable" id="input-ruc" name="ruc">
                              </div>
                          </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label for="filter-estado">Estado</label>
                            <select name="estado" id="filter-estado" class="form-control form-control-md">
                                <option value="">SELECCIONE</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group mt-3" style="display: flex;width: 100%;justify-content: flex-end;">
                            <button type="button" id="search_empresa" class="btn btn-primary btn-sm text-white action-search"><i class="ti-search"></i> Buscar</button>
                            <!-- <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Nuevo</button> -->
                            <button type="button" class="btn btn-success text-white btn-sm action-create" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i>Crear Nueva Empresa</button>
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
                    <table id="tbl-empresas" class="table table-hover table-sm">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center align-middle">NOMBRE COMERCIAL</th>
                            <th class="text-center align-middle">TIPO DOCUMENTO</th>
                            <th class="text-center align-middle">Nº DOCUMENTO</th>
                            <th class="text-center align-middle">RAZON SOCIAL</th>
                            <th class="text-center align-middle">DIRECCION</th>
                            <th class="text-center align-middle">TELEFONO 1</th>
                            <th class="text-center align-middle">TELEFONO 2</th>
                            <th class="text-center align-middle">EMAIL</th>
                            <th class="text-center align-middle">PAIS</th>
                            <th class="text-center align-middle">TIPO MEMBRESIA</th>
                            <th class="text-center align-middle">MONTO MEMBRESIA</th>
                            <th class="text-center align-middle">FECHA CREACION</th>
                            <th class="text-center align-middle">FECHA ELIMINACION</th>
                            <th class="text-center align-middle">ESTADO</th>
                            <th class="text-center align-middle">ACCIONES</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($tableRows as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nombre_comercial }}</td>
                                <td>{{ $row->tipo_documento }}</td>
                                <td>{{ $row->numero_documento }}</td>
                                <td>{{ $row->razon_social }}</td>
                                <td>{{ $row->direccion }}</td>
                                <td>{{ $row->telefono_1 }}</td>
                                <td>{{ $row->telefono_2 }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->pais }}</td>
                                <td>{{ $row->tipo_membresia }}</td>
                                <td>{{ $row->monto_membresia }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y') }}</td>
                                <td>
                                    @if($row->estado)
                                        <button class='btn btn-outline-success btn-sm align-middle text-center'>Activo</button>
                                    @else
                                        <button class='btn btn-outline-danger btn-sm align-middle text-center'>Inactivo</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('empresas.find', $row->id) }}" class="label text-primary action-edit" style="text-decoration: none;"><i class="ti-pencil"></i></a>
                                    <a href="{{ route('empresas.find', $row->id) }}" class="label text-danger action-delete" style="text-decoration: none;"><i class="ti-close"></i></a>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('layouts.app.derechos')
        @include('empresas.nuevo')

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  @endsection
  @section('custom-js')
  <!-- <script src="../../../../js/modal-demo.js"></script> -->
    <script>
        $(function ()
        {
            let isEdit = false;
            let $form = $('#exampleModal-4').find('form');

            function search(){
              let formData = $('#form_empresa_filtros').serialize();
              $.get('{{ route('empresas.filter') }}', formData, function (data)
              {
                  let html = '';
                  $.each(data.LISTA, function (i, value)
                  {
                      html += "<tr>";
                      html += "<td class='align-middle text-center' scope='col'>" + (i + 1) + "</td>";
                      html += "<td class='align-middle text-left'>" + value.nombre_comercial + "</td>";
                      html += "<td class='align-middle text-left'>" + value.tipo_documento + "</td>";
                      html += "<td class='align-middle text-left'>" + value.numero_documento + "</td>";
                      html += "<td class='align-middle text-left'>" + value.razon_social + "</td>";
                      html += "<td class='align-middle text-left'>" + value.direccion + "</td>";
                      html += "<td class='align-middle text-left'>" + value.telefono_1 + "</td>";
                      html += "<td class='align-middle text-left'>" + value.telefono_2 + "</td>";
                      html += "<td class='align-middle text-left'>" + value.email + "</td>";
                      html += "<td class='align-middle text-left'>" + value.pais + "</td>";
                      html += "<td class='align-middle text-left'>" + value.tipo_membresia + "</td>";
                      html += "<td class='align-middle text-left'>" + value.monto_membresia + "</td>";
                      html += "<td class='align-middle text-center'>"+dayjs(value.created_at).format('DD/MM/YYYY')+"</td>";
                      html += "<td class='align-middle text-center'>"+dayjs(value.updated_at).format('DD/MM/YYYY')+"</td>";
                      if(value.estado == 1)
                      {
                          estado_ = "Activo";
                          html += "<td>"
                          html += "<button class='btn btn-outline-success btn-sm align-middle text-center'>"+estado_+"</button>"
                          html += "</td>"
                      }
                      else
                      {
                          estado_ = "Inactivo";
                          html += "<td>"
                          html += "<button class='btn btn-outline-danger btn-sm align-middle text-center'>"+estado_+"</button>"
                          html += "</td>"
                      }
                      html += "<td align-middle text-center>"
                      html += "<a href='empresa/"+value.id+"' class='action-edit label text-primary' style='text-decoration: none; margin-left:15px;'  ><i class='ti-pencil'></i></a>"
                      html += "<a href='empresa/"+value.id+"' class='action-delete label text-danger' style='text-decoration: none; margin-left:10px;'><i class='ti-close'></i></a>"
                      html += "</td>"
                      html += "</tr>"
                  });

                  $(".table").find("tbody").html(html);
              });

            }


            $('.action-create').click(function ()
            {
                isEdit = false;

                $form.find('[name="_method"]').val('post');
                $form.find('.resetable').val('');
                $form.attr('action', 'empresas');
            });

            $( "#input-razon_social" ).focus(function() {


                const tipo_documento=$form.find('#input-tipo_documento').val();

                let numdocruc=$form.find('#input-numero_documento').val();
                if(tipo_documento=='1'){
                    let action = '{{ route('clientes.reniec') }}';
                    $.post(action,{numero:numdocruc,_token: '{{ csrf_token() }}'} , function (data)
                    {
                        if (data.status){

                            $form.find('#input-razon_social').val(data.data.nombre);
                            toastr.success(data.mesage);
                        }
                        else{
                            toastr.error(data.mesage, 'Error');
                        }
                    });
                }else{
                    let action = '{{ route('sucursales.sunat') }}';
                    $.post(action,{numero:numdocruc,_token: '{{ csrf_token() }}'} , function (data)
                    {
                        if (data.status){

                            $form.find('#input-razon_social').val(data.data.nombre);
                            toastr.success(data.mesage);
                        }
                        else{
                            toastr.error(data.mesage, 'Error');
                        }
                    });
                }

            });

            $('#tbl-empresas').on('click', '.action-edit', function (e)
            {
                e.preventDefault();

                let $link = $(this);

                $.get($link.attr('href'), null, function (data)
                {
                    $form.find('#input-nombre_comercial').val(data.nombre_comercial);
                    $form.find('#input-razon_social').val(data.razon_social);
                    $form.find('#input-tipo_documento').val(data.tipo_documento);
                    $form.find('#input-numero_documento').val(data.numero_documento);
                    $form.find('#input-direccion').val(data.direccion);
                    $form.find('#input-pais').val(data.pais);
                    $form.find('#input-telefono_1').val(data.telefono_1);
                    $form.find('#input-telefono_2').val(data.telefono_2);
                    $form.find('#input-email').val(data.email);
                    $form.find('#input-tipo_membresia').val(data.tipo_membresia);
                    $form.find('#input-monto_membresia').val(data.monto_membresia);

                    $form.attr('action', 'empresa/' + data.id);

                    isEdit = true;

                    $form.find('[name="_method"]').val('put');

                    $('#exampleModal-4').modal('show');
                });
            });

            $('#tbl-empresas').on('click', '.action-delete', function (e)
            {
                e.preventDefault();
                let $link = $(this);
                swal({title: 'Eliminar', text: '¿Estás seguro de borrar esta empresa?', icon: 'warning', buttons: ['No', 'Sí'], dangerMode: true})
                    .then(function (confirm)
                    {
                        if (confirm)
                            $.ajax({
                                method: 'delete',
                                url: $link.attr('href'),
                                data: {_token: '{{ csrf_token() }}'}
                            }).done(function (data)
                            {
                                if (data.status){
                                  toastr.success(data.message);
                                  search();
                                }
                                else
                                    toastr.error('No se pudo eliminar la empresa', 'Error');
                            });
                    });
            });

            $('#form-crud').submit(function (e)
            {
                e.preventDefault();

                let $form = $(this);
                let action = $form.attr('action');

                $.post(action, $form.serialize(), function (data)
                {
                    let status = data.status;

                    if (status)
                    {
                      toastr.success(data.message);
                      $('div.modal .close').click();
                      search();
                    }
                    else
                        toastr.warning(data.message, 'Error');
                });
            });

            $('.action-search').click(function ()
            {
                search();
            });

            search();
        });
    </script>
  @stop

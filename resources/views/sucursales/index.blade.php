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
                  <h4 class="card-title">SUCURSALES</h4>
                  <div id="" class="row">
                    <form id="form_sucursal_filtros" action="">
                      <input type="hidden" name="with_relations" value="1">
                      <div class="row">
                          @if(auth()->user()->isadmin)
                          <div class="col-2">
                            <div class="form-group">
                              <label for="filter-empresa_id">Empresas</label>
                              <select name="empresa_id" id="filter-empresa_id" class="form-control form-control-md">
                                  <option value="">SELECCIONE</option>
                                  @foreach($empresas as $row)
                                      <option value="{{ $row->id }}">{{ $row->nombre_comercial }}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          @endif
                          <div class="col-2">
                              <div class="form-group">
                                  <label for="filter-nombre_comercial">Nombre Comercial</label>
                                  <input type="text" class="form-control form-control-sm resetable" id="input-nombre_comercial" name="nombre_comercial">

                              </div>
                          </div>
                          <div class="col-2">
                              <div class="form-group">
                                  <label for="filter-numero_documento">Ruc</label>
                                  <input type="text" class="form-control form-control-sm resetable" id="input-numero_documento" name="numero_documento">

                              </div>
                          </div>
                        <div class="col-2">
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
                            <button type="button" id="search_sucursal" class="btn btn-primary btn-sm text-white action-search"><i class="ti-search"></i> Buscar</button>
                            <!-- <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Nuevo</button> -->
                            <button type="button" class="btn btn-success text-white btn-sm action-create" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i>Crear Nueva Sucursal</button>
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
                    <table id="tbl-sucursales" class="table table-hover table-sm">
                      <thead>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">EMPRESA</th>
                            <th class="text-center align-middle">NOMBRE COMERCIAL</th>
                            <th class="text-center align-middle">TIPO DOCUMENTO</th>
                            <th class="text-center align-middle">Nº DOCUMENTO</th>
                            <th class="text-center align-middle">RAZON SOCIAL</th>
                            <th class="text-center align-middle">TELEFONO</th>
                            <th class="text-center align-middle">DIRECCION</th>
                            <th class="text-center align-middle">EMAIL</th>
                            <th class="text-center align-middle">DEPARTAMENTO</th>
                            <th class="text-center align-middle">PROVINCIA</th>
                            <th class="text-center align-middle">DISTRITO</th>
                            <th class="text-center align-middle">LATITUD</th>
                            <th class="text-center align-middle">LONGITUD</th>
                            <th class="text-center align-middle">FECHA CREACION</th>
                            <th class="text-center align-middle">FECHA ACTUALIZACION</th>
                            <th class="text-center align-middle">ESTADO</th>
                            <th class="text-center align-middle">ACCIONES</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
        @include('layouts.app.derechos')
        @include('sucursales.nuevo')
      </div>
    </div>
  </div>
  @endsection
  @section('custom-js')
  <script>
      $(function ()
      {
          let provincias = {!! json_encode($provincias) !!};
          let distritos = {!! json_encode($distritos) !!};
          let isEdit = false;
          let $form = $('#exampleModal-4').find('form');

          function search(){
            let formData = $('#form_sucursal_filtros').serialize();

            $.get('{{ route('sucursales.filter') }}', formData, function (data)
            {
                let html = '';

                $.each(data.LISTA, function (i, value)
                {
                    html += "<tr>";
                    html += "<td class='align-middle text-center' scope='col'>" + (i + 1) + "</td>";
                    html += "<td class='align-middle text-left'>" + value.empresa_id + "</td>";
                    html += "<td class='align-middle text-left'>" + value.nombre_comercial + "</td>";
                    html += "<td class='align-middle text-left'>" + value.tipo_documento + "</td>";
                    html += "<td class='align-middle text-left'>" + value.numero_documento + "</td>";
                    html += "<td class='align-middle text-left'>" + value.razon_social + "</td>";
                    html += "<td class='align-middle text-left'>" + value.telefono + "</td>";
                    html += "<td class='align-middle text-left'>" + value.direccion + "</td>";
                    html += "<td class='align-middle text-left'>" + value.email + "</td>";
                    html += "<td class='align-middle text-left'>" + value.departamento?.nombre + "</td>";
                    html += "<td class='align-middle text-left'>" + value.provincia?.nombre + "</td>";
                    html += "<td class='align-middle text-left'>" + value.distrito?.nombre + "</td>";
                    html += "<td class='align-middle text-left'>" + value.latitud + "</td>";
                    html += "<td class='align-middle text-left'>" + value.longitud + "</td>";
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
                    html += "<a href='sucursal/"+value.id+"' class='action-edit label text-primary' style='text-decoration: none; margin-left:15px;'  ><i class='ti-pencil'></i></a>"
                    html += "<a href='sucursal/"+value.id+"' class='action-delete label text-danger' style='text-decoration: none; margin-left:10px;'><i class='ti-close'></i></a>"
                    html += "</td>"
                    html += "</tr>"
                });

                $("#tbl-sucursales").find("tbody").html(html);
            });
          }

          {{-- Crear --}}
          $('.action-create').click(function ()
          {
              isEdit = false;

              $form.find('[name="_method"]').val('post');
              $form.find('.resetable').val('');
              $form.attr('action', '{{ route('sucursales.store') }}');
          });

          $( "#input-razon_social" ).focus(function() {
              let action = '{{ route('sucursales.sunat') }}';

              let numdocruc=$form.find('#input-numero_documento').val();
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
          });
          {{-- Editar --}}
          $('#tbl-sucursales').on('click', '.action-edit', function (e)
          {
              e.preventDefault();

              let $link = $(this);

              $.get($link.attr('href'), null, function (data)
              {
                  $form.find('#input-empresa_id').val(data.empresa_id);
                  $form.find('#input-nombre_comercial').val(data.nombre_comercial);
                  $form.find('#input-razon_social').val(data.razon_social);
                  $form.find('#input-tipo_documento').val(data.tipo_documento);
                  $form.find('#input-numero_documento').val(data.numero_documento);
                  $form.find('#input-direccion').val(data.direccion);
                  $form.find('#input-telefono').val(data.telefono);
                  $form.find('#input-email').val(data.email);
                  $form.find('#input-latitud').val(data.latitud);
                  $form.find('#input-longitud').val(data.longitud);

                  $form.find('#input-departamento').val(data.departamento_id);
                  $form.find('#input-departamento').trigger('change');
                  $form.find('#input-provincia').val(data.provincia_id);
                  $form.find('#input-provincia').trigger('change');
                  $form.find('#input-distrito').val(data.distrito_id);

                  $form.attr('action', 'sucursal/' + data.id);

                  isEdit = true;

                  $form.find('[name="_method"]').val('PUT');



                  $('#exampleModal-4').modal('show');
              });
          });

          {{-- Eliminar --}}
          $('#tbl-sucursales').on('click', '.action-delete', function (e)
          {
              e.preventDefault();

              let $link = $(this);

              swal({title: 'Eliminar', text: '¿Estás seguro de borrar esta sucursal?', icon: 'warning', buttons: ['No', 'Sí'], dangerMode: true})
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
                              } else
                                toastr.error('No se pudo eliminar la sucursal', 'Error');
                          });
                  });
          });

          {{-- Formulario --}}
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
                      $('div.modal .close').click();
                      toastr.success(data.message);
                      search();
                  }
                  else
                      toastr.warning(data.message, 'Error');
              });
          });

          {{-- Filtrar --}}
          $('.action-search').click(function ()
          {
            search();
          });

          $inputDepartamento = $('#input-departamento');
          $inputProvincia = $('#input-provincia');
          $inputDistrito = $('#input-distrito');

          $inputDepartamento.change(function(e){
            $inputProvincia.empty();
            $inputDistrito.empty();
            $inputProvincia.append('<option value="">Seleccionar</option>');
            $inputDistrito.append('<option value="">Seleccionar</option>');

            provincias.filter(i=>i.departamento_id==e.target.value).forEach(item=>{
              $inputProvincia.append('<option value="'+item.id+'">'+item.nombre+'</option>');
            });
          });

          $inputProvincia.change(function(e){
            $inputDistrito.empty();
            $inputDistrito.append('<option value="">Seleccionar</option>');

            distritos.filter(i=>i.provincia_id==e.target.value).forEach(item=>{
              $inputDistrito.append('<option value="'+item.id+'">'+item.nombre+'</option>');
            });
          });

          search();
      });
  </script>
  @stop

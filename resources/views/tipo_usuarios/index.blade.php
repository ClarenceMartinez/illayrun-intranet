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
          <div class="card shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title float-start mb-0">TIPOS DE USUARIOS</h5>
              <div class="float-end">
                <button type="button" class="btn btn-success text-white btn-sm action-create" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i>Crear Nuevo Tipo Usuario</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive bg-white">
                      <table id="tbl-tipousuario" class="table table-hover table-sm">
                        <thead>
                          <tr>
                              <th class="text-center align-middle">#</th>
                              <th class="text-start align-middle">TIPO USUARIO</th>
                              <th class="text-center align-middle">FECHA CREACIÓN</th>
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('layouts.app.derechos')
        @include('tipo_usuarios.nuevo')

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

            $.get('{{ route('tipo_usuarios.filter') }}', formData, function (data)
            {
                let html = '';

                $.each(data.LISTA, function (i, value)
                {
                    html += "<tr>";
                    html += "<td class='align-middle text-center' scope='col'>" + (i + 1) + "</td>";
                    html += "<td class='align-middle text-left'>" + value.tipousuario + "</td>";
                    html += "<td class='align-middle text-center'>"+dayjs(value.created_at).format('DD/MM/YYYY')+"</td>";
                    if (value.estado == 1)
                    {
                        estado_ = "Activo";
                        html += "<td class='text-center'>"
                        html += "<button class='btn btn-outline-success btn-sm align-middle text-center'>"+estado_+"</button>"
                        html += "</td>"
                    }
                    else
                    {
                        estado_ = "Inactivo";
                        html += "<td class='text-center'>"
                        html += "<button class='btn btn-outline-danger btn-sm align-middle text-center'>"+estado_+"</button>"
                        html += "</td>"
                    }
                    html += "<td class='align-middle text-center'>"
                    html += "<a href='tipo_usuario/"+value.id+"' class='action-edit label text-primary' style='text-decoration: none; margin-left:15px;'  ><i class='ti-pencil'></i></a>"
                    html += "<a href='tipo_usuario/"+value.id+"' class='action-delete label text-danger' style='text-decoration: none; margin-left:10px;'><i class='ti-close'></i></a>"
                    html += "</td>"
                    html += "</tr>"
                });

                $("#tbl-tipousuario").find("tbody").html(html);
            });
          }

          {{-- Crear --}}
          $('.action-create').click(function ()
          {
              isEdit = false;

              $form.find('[name="_method"]').val('post');
              $form.find('.resetable').val('');
              $form.attr('action', '{{ route('tipo_usuarios.store') }}');
          });

          {{-- Editar --}}
          $('#tbl-tipousuario').on('click', '.action-edit', function (e)
          {
              e.preventDefault();

              let $link = $(this);

              $.get($link.attr('href'), null, function (data)
              {
                  $form.find('#input-tipousuario').val(data.tipousuario);

                  $form.attr('action', 'tipo_usuario/' + data.id);

                  isEdit = true;

                  $form.find('[name="_method"]').val('PUT');        

                  $('#exampleModal-4').modal('show');
              });
          });

          {{-- Eliminar --}}
          $('#tbl-tipousuario').on('click', '.action-delete', function (e)
          {
              e.preventDefault();

              let $link = $(this);

              swal({title: 'Eliminar', text: '¿Estás seguro de borrar este tipo?', icon: 'warning', buttons: ['No', 'Sí'], dangerMode: true})
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
                                toastr.error('No se pudo eliminar el tipo', 'Error');
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

          search();
      });
  </script>
  @stop

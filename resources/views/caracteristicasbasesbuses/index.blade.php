@extends('layouts.app')
@section('title', 'panel')
@section('content')
 <div class="container-scroller">
    <div class="horizontal-menu">
      @include('layouts.app.nav')
      @include('layouts.app.menu')
    </div>

    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4 class="card-title mb-0">CARACTERISTICAS BUSES BASES</h4>
              <div>
                <button type="button" id="search_destinos" class="btn btn-primary btn-sm text-white"><i class="ti-search"></i> Buscar</button>
                <button type="button" class="btn btn-success text-white btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i>Crear Nueva Caracteristica Buses Bases</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive bg-white">
                      <table id="tbl-caracteristicasbusbase" class="table table-hover table-sm">
                        <thead>
                          <tr>
                              <th class="text-center align-middle">#</th>
                              <th class="text-center align-middle">NOMBRE CARACTERISTICA</th>
                              <th class="text-center align-middle">FECHA CREACION</th>
                              <th class="text-center align-middle">FECHA ELIMINACION</th>
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
        @include('layouts.app.derechos')
        @include('caracteristicasbasesbuses.nuevo')
      </div>
    </div>
  </div>
  @endsection
  @section('custom-js')
  <script>
      $(function ()
      {
          let isEdit = false;
          let $form = $('#exampleModal-4').find('form');

          {{-- Crear --}}
          $('.action-create').click(function ()
          {
              isEdit = false;

              $form.find('[name="_method"]').val('post');
              $form.find('.resetable').val('');
              $form.attr('action', '{{ route('caracteristicasbasesbuses.store') }}');
          });

          {{-- Editar --}}
          $("#tbl-caracteristicasbusbase").on('click', '.action-edit', function (e)
          {
              e.preventDefault();

              let $link = $(this);
              console.log($link.attr('href'));
              $.get($link.attr('href'), null, function (data)
              {
                  $form.find('#input-nombre_caracteristica').val(data.nombre_caracteristica);

                  $form.attr('action', 'caracteristicabasebus/' + data.id);

                  isEdit = true;

                  $form.find('[name="_method"]').val('put');

                  $('#exampleModal-4').modal('show');
              });
          });

          {{-- Eliminar --}}
          $("#tbl-caracteristicasbusbase").on('click', '.action-delete', function (e)
          {
              e.preventDefault();

              let $link = $(this);

              swal({title: 'Eliminar', text: '¿Estás seguro de borrar esta Caracteristica Base?', icon: 'warning', buttons: ['No', 'Sí'], dangerMode: true})
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
                                toastr.error('No se pudo eliminar la Caracteristica Base', 'Error');
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

        function search()
        {

            var form_data   = $("#frm_caracteristicasbusbase").serialize();

            $.ajax({
                url:"{{ route('caracteristicasbasesbuses.filter') }}",
                data:form_data,
                method:"GET",
                dataType:'json',
                success:function(response)
                {
                    var html  = '';
                    $.each(response.LISTA, function(idex, value)
                    {
                        html += "<tr>"
                        html += "<td class='align-middle text-center' scope='col'>"+(idex+1)+"</td>"
                        html += "<td class='align-middle text-left'>"+value.nombre_caracteristica+"</td>"
                        html += "<td class='align-middle text-center'>"+dayjs(value.created_at).format('DD/MM/YYYY')+"</td>"
                        html += "<td class='align-middle text-center'>"+dayjs(value.updated_at).format('DD/MM/YYYY')+"</td>"
                        if(value.estado == 1){
                            estado_ = "Activo";
                            html += "<td class='align-middle text-center'>"
                            html += "<button class='btn btn-outline-success btn-sm align-middle text-center'>"+estado_+"</button>"
                            html += "</td>"
                        }else{
                            estado_ = "Inactivo";
                            html += "<td class='align-middle text-center'>"
                            html += "<button class='btn btn-outline-danger btn-sm align-middle text-center'>"+estado_+"</button>"
                            html += "</td>"
                        }

                        html += "<td align-middle text-center>"
                        html += "<a href='caracteristicabasebus/"+value.id+"' class='action-edit label text-primary' style='text-decoration: none; margin-left:15px;'  ><i class='ti-pencil'></i></a>"
                        html += "<a href='caracteristicabasebus/"+value.id+"' class='action-delete label text-danger' style='text-decoration: none; margin-left:10px;'><i class='ti-close'></i></a>"
                        html += "</td>"
                        html += "</tr>"
                    })

                    $("#tbl-caracteristicasbusbase").find("tbody").html(html);
                }
            })
        }

        search();
      });
  </script>
  @stop

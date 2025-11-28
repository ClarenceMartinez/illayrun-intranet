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
        <div class="content-wrapper">
          <div class="card shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title float-start mb-0">CLIENTES</h5>
              <div class="float-end">
                <button type="button" class="btn btn-success text-white btn-sm action-create" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i>Crear Nuevo Cliente</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive bg-white">
                      <table id="tbl-clientes" class="table table-hover table-sm">
                        <thead>
                          <tr>
                              <th class="text-center align-middle">#</th>
                              <th class="text-center align-middle">EMPRESA</th>
                              <th class="text-center align-middle">SUCURSAL</th>
                              <th class="text-center align-middle">NOMBRE</th>
                              <th class="text-center align-middle">TIPO DOCUMENTO</th>
                              <th class="text-center align-middle">NUMERO DOCUMENTO</th>
                              <th class="text-center align-middle">TELEFONO</th>
                              <th class="text-center align-middle">NACIONALIDAD</th>
                              <th class="text-center align-middle">EMAIL</th>
                              <th class="text-center align-middle">FECHA NACIMIENTO</th>
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
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('layouts.app.derechos')
        @include('clientes.nuevo')

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
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
              $form.attr('action', '{{ route('clientes.store') }}');
          });
          $( "#input-nombre" ).focus(function() {
              let action = '{{ route('clientes.reniec') }}';

              let numdocruc=$form.find('#input-numero_documento').val();
              $.post(action,{numero:numdocruc,_token: '{{ csrf_token() }}'} , function (data)
              {
                  if (data.status){

                      $form.find('#input-nombre').val(data.data.nombre);
                      toastr.success(data.mesage);
                  }
                  else{
                      toastr.error(data.mesage, 'Error');
                  }
              });
          });
          {{-- Editar --}}
          $('#tbl-clientes').on('click', '.action-edit', function (e)
          {
              e.preventDefault();

              let $link = $(this);

              $.get($link.attr('href'), null, function (data)
              {
                  $form.find('#input-nombres').val(data.nombres);
                  $form.find('#input-paterno').val(data.paterno);
                  $form.find('#input-materno').val(data.materno);
                  $form.find('#input-tipo_documento').val(data.tipo_documento);
                  $form.find('#input-numero_documento').val(data.numero_documento);
                  $form.find('#input-telefono').val(data.telefono);
                  $form.find('#input-nacionalidad').val(data.nacionalidad);
                  $form.find('#input-email').val(data.email);
                  $form.find('#input-fecha_nacimiento').val(data.fecha_nacimiento);
                  $form.attr('action', 'cliente/' + data.id);
                  isEdit = true;

                  $form.find('[name="_method"]').val('PUT');
                  $('#exampleModal-4').modal('show');
              });
          });

          {{-- Eliminar --}}
          $('#tbl-clientes').on('click', '.action-delete', function (e)
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
                        }).done(function(data){
                            if (data.status){
                                toastr.success(data.message);
                                search();
                            } else
                                toastr.error('No se pudo eliminar la empresa', 'Error');
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

            var form_data   = $("#frm_clientes").serialize();

            $.ajax({
                url:"{{ route('clientes.filter') }}",
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
                        html += "<td class='align-middle text-left'>"+value.empresa_id+"</td>"
                        html += "<td class='align-middle text-left'>"+value.sucursal_id+"</td>"
                        html += "<td class='align-middle text-left'>"+value.nombres+"</td>"
                        html += "<td class='align-middle text-left'>"+value.tipo_documento+"</td>"
                        html += "<td class='align-middle text-left'>"+value.numero_documento+"</td>"
                        html += "<td class='align-middle text-left'>"+value.telefono+"</td>"
                        html += "<td class='align-middle text-left'>"+value.nacionalidad+"</td>"
                        html += "<td class='align-middle text-left'>"+value.email+"</td>"
                        html += "<td class='align-middle text-left'>"+dayjs(value.fecha_nacimiento).format('DD/MM/YYYY')+"</td>"
                        html += "<td class='align-middle text-center'>"+dayjs(value.created_at).format('DD/MM/YYYY')+"</td>"
                        html += "<td class='align-middle text-center'>"+dayjs(value.updated_at).format('DD/MM/YYYY')+"</td>"
                        if(value.estado == 1){
                            estado_ = "Activo";
                            html += "<td>"
                            html += "<button class='btn btn-outline-success btn-sm align-middle text-center'>"+estado_+"</button>"
                            html += "</td>"
                        }else{
                            estado_ = "Inactivo";
                            html += "<td>"
                            html += "<button class='btn btn-outline-danger btn-sm align-middle text-center'>"+estado_+"</button>"
                            html += "</td>"
                        }

                        html += "<td align-middle text-center>"
                        html += "<a href='cliente/"+value.id+"' class='action-edit label text-primary' style='text-decoration: none; margin-left:15px;'  ><i class='ti-pencil'></i></a>"
                        html += "<a href='cliente/"+value.id+"' class='action-delete label text-danger' style='text-decoration: none; margin-left:10px;'><i class='ti-close'></i></a>"
                        html += "</td>"
                        html += "</tr>"
                    })

                    $("#tbl-clientes").find("tbody").html(html);
                }
            })
        }

        search();

      });
  </script>
  @stop

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
          <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ASIENTOS</h4>
                  <p class="card-text">
{{--                    Click on any image to open in lightbox gallery--}}
                  </p>
                    <div id="" class="row">
                        <form id="form_empresa_filtros" action="">
                            <div class="row">
                                <div class="col-3">

                                </div>
                                <div class="col-3">

                                </div>
                                <div class="col-5">
                                    <div class="form-group mt-3" style="display: flex;width: 100%;justify-content: flex-end;">
{{--                                        <button type="button" id="search_asientos" class="btn btn-primary btn-sm text-white action-search"><i class="ti-search"></i> Buscar</button>--}}
                                        <!-- <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Nuevo</button> -->
                                        <button type="button" class="btn btn-success text-white btn-sm action-create" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i>Crear Nuevo Asientos</button>
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
                            <th class="text-center align-middle">BUS</th>
                            <th class="text-center align-middle">NÚMERO</th>


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
                              <td>{{ $row->bus_id }}</td>
                              <td>{{ $row->numero }}</td>

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
                                  <a href="{{ route('asientos.edit', $row->id) }}" class="label text-primary action-edit" style="text-decoration: none;"><i class="ti-pencil"></i></a>
                                  <a href="{{ route('asientos.destroy', $row->id) }}" class="label text-danger action-delete" style="text-decoration: none;"><i class="ti-close"></i></a>
                              </td>
                          </tr>
                      @endforeach
                        <!-- <tr>
                            <td>1</td>
                            <td>CRUZ DEL SUR</td>
                            <td>20602425123</td>
                            <td>LOS GERANIOS 476 SAN BORJA</td>
                            <td>30/10/2022</td>
                            <td>MENSUAL</td>
                            <td>60.00</td>
                            <td>
                              <button class="btn btn-outline-danger">Suspendido</button>
                            </td>
                        </tr> -->


                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('layouts.app.derechos')
        @include('asientos.nuevo')

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

            {{-- Crear --}}
            $('.action-create').click(function ()
            {
                isEdit = false;

                $form.find('[name="_method"]').val('post');
                $form.find('.resetable').val('');
                $form.attr('action', '{{ route('asientos.store') }}');
            });

            {{-- Editar --}}
            $('.action-edit').click(function (e)
            {
                e.preventDefault();

                let $link = $(this);

                $.get($link.attr('href'), null, function (data)
                {

                    $form.find('#filter-bus_id').val(data.asientos[0].bus_id);
                    $form.find('#input-numero').val(data.asientos[0].numero);


                    $form.attr('action', data.action);

                    isEdit = true;

                    $form.find('[name="_method"]').val('put');

                    $('#exampleModal-4').modal('show');
                });
            });

            {{-- Eliminar --}}
            $('.action-delete').click(function (e)
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
                                if (data.status)
                                    location.reload();
                                else
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
                        location.reload();
                    }
                    else
                        toastr.warning(data.message, 'Error');
                });
            });


        });
    </script>
@stop

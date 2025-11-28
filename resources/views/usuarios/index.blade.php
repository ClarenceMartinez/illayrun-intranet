@extends('layouts.app')
@section('title', 'panel')
@section('content')
    <style type="text/css">
        .form-control, .typeahead, .tt-query, .tt-hint, .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single, .jsgrid .jsgrid-table .jsgrid-filter-row input[type=number], .jsgrid .jsgrid-table .jsgrid-filter-row input[type=text], .jsgrid .jsgrid-table .jsgrid-filter-row select, .dataTables_wrapper select, .asColorPicker-input {
            height: 36px;
        }
    </style>

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
                        <h5 class="card-title float-start mb-0">USUARIOS</h5>
                        <div class="float-end">
                            <button type="button" class="btn btn-success text-white btn-sm action-create" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i> USUARIO</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive bg-white">
                                <table id="tbl-usuarios" class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th class="text-center align-middle">#</th>
                                        <th class="text-center align-middle">NOMBRE</th>
                                        <th class="text-center align-middle">APELLIDOS</th>
                                        <th class="text-center align-middle">CLAVE</th>
                                        <th class="text-center align-middle">TIPO USUARIO</th>
                                        <th class="text-center align-middle">EMAIL</th>
                                        <th class="text-center align-middle">FECHA EMAIL VERIFICADO</th>
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
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include('layouts.app.derechos')
            @include('usuarios.nuevo')

            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $(function ()
        {
            let isEdit = false;
            let $form = $('#exampleModal-4').find('form');

            $('#input-fecha_nacimiento').on('change', function(e){
            let value = e.target.value;
            let age = dayjs().diff( dayjs(value), 'years');

            if(age !== NaN)
                $('#input-edad').val( age );
        });

            {{-- Sucursales --}}
            $('#input-empresa').change(function ()
            {
                let idEmpresa = $(this).val();
                if (!idEmpresa)
                    return;

                $.get('{{ route('sucursales.filter') }}', {empresa_id: idEmpresa}, function (data)
                {
                    let html = '<option value="">Seleccionar &rarr;</option>';

                    for (let i in data.LISTA)
                    {
                        let item = data.LISTA[i];

                        html += '<option value="' + item.id + '">' + item.nombre_comercial + '</option>';
                    }

                    $('#input-sucursal').html(html);
                });
            });
            $( "#input-nombres" ).focus(function() {
                let action = '{{ route('clientes.reniec') }}';

                let numdocruc=$form.find('#input-numerodocumento').val();
                $.post(action,{numero:numdocruc,_token: '{{ csrf_token() }}'} , function (data)
                {
                    if (data.status){

                        $form.find('#input-nombres').val(data.data.nombres);
                        $form.find('#input-apellidos').val(data.data.apellidoPaterno+' '+data.data.apellidoMaterno);
                        toastr.success(data.mesage);
                    }
                    else{
                        toastr.error(data.mesage, 'Error');
                    }
                });
            });
            {{-- Crear --}}
            $('.action-create').click(function ()
            {
                isEdit = false;

                $form.find('[name="_method"]').val('post');
                $form.find('.resetable').val('');
                $form.attr('action', '{{ route('usuarios.store') }}');
            });

            {{-- Editar --}}
            $('#tbl-usuarios').on('click', '.action-edit', function (e)
            {
                e.preventDefault();

                let $link = $(this);

                $.get($link.attr('href'), null, function (data)
                {
                    let idEmpresa = data.empresa;
                    let idSucursal = data.codsucursal;

                    $form.find('#input-nombres').val(data.nombres);
                    $form.find('#input-apellidos').val(data.apellidos);
                    $form.find('#input-clave').val(data.clave);
                    $form.find('#input-tipousuario_id').val(data.tipousuario_id);
                    $form.find('#input-email').val(data.email);
                    $form.find('#input-numerodocumento').val(data.numerodocumento);
                    $form.find('#input-fecha_nacimiento').val(data.fecha_nacimiento);
                    $form.find('#input-telefono').val(data.telefono);
                    $form.find('#input-empresa').val(idEmpresa);

                    if(data.fecha_nacimiento !== null)
                        $('#input-fecha_nacimiento').trigger('change');

                    {{-- Cargar sucursal --}}
                    $.get('{{ route('sucursales.filter') }}', {empresa_id: idEmpresa}, function (data)
                    {
                        let html = '<option value="">Seleccionar &rarr;</option>';

                        for (let i in data.LISTA)
                        {
                            let item = data.LISTA[i];

                            if (item.id == idSucursal)
                                html += '<option value="' + item.id + '" selected="selected">' + item.nombre_comercial + '</option>';
                            else
                                html += '<option value="' + item.id + '">' + item.nombre_comercial + '</option>';
                        }

                        $('#input-sucursal').html(html);
                    });

                    $form.attr('action', 'usuario/' + data.id);

                    isEdit = true;

                    $form.find('[name="_method"]').val('PUT');

                    $('#exampleModal-4').modal('show');
                });
            });

            {{-- Eliminar --}}
            $('#tbl-usuarios').on('click', '.action-delete', function (e)
            {
                e.preventDefault();

                let $link = $(this);

                swal({title: 'Eliminar', text: '¿Estás seguro de borrar este usuario?', icon: 'warning', buttons: ['No', 'Sí'], dangerMode: true})
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
                                    toastr.error('No se pudo eliminar el usuario', 'Error');
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
        });

        function search()
        {

            var form_data   = $("#frm_usuarios").serialize();

            $.ajax({
                url:"{{ route('usuarios.filter') }}",
                data:form_data,
                method:"GET",
                dataType:'json',
                success:function(response)
                {
                    var html  = '';
                    $.each(response.LISTA, function(idex, value)
                    {

                        // console.log(value);

                        html += "<tr>"
                        html += "<td class='align-middle text-center' scope='col'>"+(idex+1)+"</td>"
                        html += "<td class='align-middle text-left'>"+value.nombres+"</td>"
                        html += "<td class='align-middle text-left'>"+value.apellidos+"</td>"
                        html += "<td class='align-middle text-left'>"+value.clave+"</td>"
                        html += "<td class='align-middle text-left'>"+value.tipousuario_id+"</td>"
                        html += "<td class='align-middle text-left'>"+value.email+"</td>"
                        html += "<td class='align-middle text-center'>"+value.email_verified_at+"</td>"
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
                        html += "<a href='usuario/"+value.id+"' class='action-edit label text-primary' style='text-decoration: none; margin-left:15px;'  ><i class='ti-pencil'></i></a>"
                        html += "<a href='usuario/"+value.id+"' class='action-delete label text-danger' style='text-decoration: none; margin-left:10px;'><i class='ti-close'></i></a>"
                        html += "</td>"
                        html += "</tr>"
                    })

                    $("#tbl-usuarios").find("tbody").html(html);
                }
            })
        }

        search();
    </script>
@stop

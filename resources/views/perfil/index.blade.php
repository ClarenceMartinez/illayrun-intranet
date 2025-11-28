@extends('layouts.app')
@section('title', 'Perfil')
@section('content')
    <div class="container-scroller">
        <div class="horizontal-menu">
            @include('layouts.app.nav')
            @include('layouts.app.menu')
        </div>
        <div class="container page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <h3>Perfil</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="card">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                          <a href="#cuser" class="nav-link active" id="cuser-tab" data-bs-toggle="tab" data-bs-target="#cuser"  role="tab" aria-controls="cuser" aria-selected="true">Editar mis datos</a>
                                        </li>
                                        <!--
                                        <li class="nav-item" role="presentation">
                                          <a href="#cpassword" class="nav-link" id="cpassword-tab" data-bs-toggle="tab" data-bs-target="#cpassword"  role="tab" aria-controls="cpassword" aria-selected="false">Cambiar contraseña</a>
                                        </li>
                                        -->
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="cuser" role="tabpanel" aria-labelledby="cuser-tab">
                                        <form id="frmPerfil" action="/perfil" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-12 mb-3">
                                                    <label for="input-numerodocumento">Nro. Documento</label>
                                                    <input type="text" class="form-control" id="input-numerodocumento" name="numerodocumento" value="{{ auth()->user()->numerodocumento }}" />
                                                </div>
                                                <div class="col-lg-4 col-sm-12 mb-3">
                                                    <label for="input-nombres">Nombres</label>
                                                    <input type="text" class="form-control" id="input-nombres" name="nombres" value="{{ auth()->user()->nombres }}" />
                                                </div>
                                                <div class="col-lg-4 col-sm-12 mb-3">
                                                    <label for="input-apellidos">Apellidos</label>
                                                    <input type="text" class="form-control" id="input-apellidos" name="apellidos" value="{{ auth()->user()->apellidos }}" />
                                                </div>
                                                <div class="col-lg-3 col-sm-12 mb-3">
                                                    <label for="input-email">Correo electrónico</label>
                                                    <input type="text" class="form-control" id="input-email" name="email" value="{{ auth()->user()->email }}"/>
                                                </div>
                                                <div class="col-lg-3 col-sm-12 mb-3">
                                                    <label for="input-telefono">Teléfono</label>
                                                    <input type="text" class="form-control" id="input-telefono" name="telefono" value="{{ auth()->user()->telefono }}"/>
                                                </div>
                                                <div class="col-lg-3 col-sm-12 mb-3">
                                                    <label for="input-fecha_nacimiento">Fecha de nacimiento</label>
                                                    <input type="date" class="form-control" id="input-fecha_nacimiento" name="fecha_nacimiento" value="{{ auth()->user()->fecha_nacimiento }}"/>
                                                </div>
                                                <div class="col-lg-3 col-sm-12 mb-3">
                                                    <label for="input-edad">Edad</label>
                                                    <input type="number" class="form-control" id="input-edad" readonly/>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-end">
                                                <button class="btn btn-primary">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--
                                    <div class="tab-pane fade" id="cpassword" role="tabpanel" aria-labelledby="cpassword-tab">
                                        <form action="/password" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT" />
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label for="currentPasswordInput">Contraseña actual</label>
                                                    <input type="password" class="form-control" id="currentPasswordInput" name="current_password" required/>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="newPasswordInput">Nueva contraseña</label>
                                                    <input type="password" class="form-control" id="newPasswordInput" name="new_password" required/>
                                                    <div class="text-danger d-none error-message"><small>Las contraseñas no coinciden</small></div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="repeatPasswordInput">Repetir contraseña</label>
                                                    <input type="password" class="form-control" id="repeatPasswordInput" name="repeat_password" required/>
                                                    <div class="text-danger d-none error-message"><small>Las contraseñas no coinciden</small></div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-right">
                                                <button class="btn btn-primary">Cambiar contraseña</button>
                                            </div>
                                        </form>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.app.derechos')
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
<script>
    (function($, dayjs){

        var user = {!! auth()->user() !!};

        $('#input-fecha_nacimiento').on('change', function(e){
            let value = e.target.value;
            let age = dayjs().diff( dayjs(value), 'years');

            if(age !== NaN)
                $('#input-edad').val( age );
        });

        if(user.fecha_nacimiento !== null){
            $('#input-fecha_nacimiento').trigger('change');
        }

        $('#frmPerfil').on('submit', function(e){
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
                }
                else
                    toastr.warning(data.message, 'Error');
            });

        });

    })($, dayjs);
</script>
@endsection

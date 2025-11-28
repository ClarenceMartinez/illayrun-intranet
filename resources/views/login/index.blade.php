<!DOCTYPE html>
<html lang="en">
<head>
    @if(env('APP_ENV')=='production')
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129913873-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-129913873-1');
    </script>
    @endif
    <meta name="env" content="{{env('APP_ENV')}}">
    <title>Illayrun :: Plataforma de Gestión y Compra de Pasajes en Bus en todo el Perú</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-dark/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>

<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex flex-row">
                <center>
                  <div class="logotipo">
                    <img src="../../../../images/logotipo.png" alt="logo" width="60%">
                  </div>
                </center>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="col-lg-11">
                <div class="col-lg-12 p-2 bg-grey border rounded-sm">
                  <div class="text-left">
                    <center class="pt-4">
                      <h2>Bienvenido de Vuelta</h2>
                      <h6 class="font-weight-light">Comencemos el día con el pie derecho :)</h6>

                    </center>
                    <form id="login-form" class="p-4 " method="post" action="{{ route('do-login') }}">
                      @csrf
                      <div class="form-group mb-2">
                          <div class="input-group mb-2">
                              <input type="text" class="form-control form-control-sm" name="empresa" id="empresa" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese RUC, DNI o ALIAS" <?php if (isset($reg[0]['id_cliente'])) { ?> value="<?php echo $reg[0]['rucsucursal']; ?>"<?php } ?>  required="" aria-required="true">
                              <input type="hidden" id="empresa_id" name="empresa_id">
                              <div class="input-group-prepend">
                                <button class="btn btn-info btn-sm validar-ruc-frmx" data-nombre="razonsocial" id="validar" data-direccion="direcsucursal" type="button">Validar</button>
                            </div>
                          </div>
                      </div>
                      <div class="content-login " style="display: none;">
                      <div class="form-group">
                        <select class="form-control" name="sucursal_id" id="sucursal_id">
                          <option value="0">Seleccione sede</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control form-control-lg" name="usuario" id="exampleInputEmail1" placeholder="Username" required="required" aria-label="Username">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password" required="required" aria-label="Password">
                      </div>
                      <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                          <label class="form-check-label text-muted">
                            <input type="checkbox" class="form-check-input">Recordar mi contraseña?</label>
                        </div>
                        <a href="#" class="auth-link text-black">Olvidaste tu contraseña</a>
                      </div>
                      <div class="mb-2 mb-4">
                        <button type="submit" class="w-100 btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Inicia Sesión</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
      $(function()
      {
          {{-- Login --}}
          $('#login-form').submit(function(e)
          {
              e.preventDefault();

              let $form = $(this);
              $.ajax({
                  url: $form.attr('action'),
                  data:$form.serialize(),
                  method:"post",
              }).done(function(data) {
                  if (data.status){
                      toastr.success(data.message);
                      location.href = '/';
                  }
                  else{
                      toastr.error(data.message, 'Error');
                  }
              });
          });
      });

      jQuery(document).on('click', '.validar-ruc-frmx',function(e)
      {
          var ruc_cliente=$('#empresa').val();

          $.ajax({
              url: '{{route('empresas.verifica')}}',
              data:{rucalias:ruc_cliente,_token: '{{ csrf_token() }}'},
              method:"post",
          }).done(function(data) {
              if (data.status){
                  $('#empresa_id').val(data.empresa_id);
                  $("#sucursal_id").empty();
                  $.each(data.sucursales.LISTA,function(key, registro) {
                      $("#sucursal_id").append('<option value='+registro.id+'>'+registro.nombre_comercial+'</option>');
                  });
                  $(".content-login").show()
                  toastr.success(data.message);
              }
              else{
                  toastr.error(data.message, 'Error');
              }
          });
      });
  </script>
</body>
</html>
<style type="text/css">
  .bg-grey{background-color: #4c4c4c; border-radius: 14px;}
  .logotipo{position: relative; top: 45%; left: 10%;}
  .form-control{font-size: 11px; min-height: 2rem !important; height: 14px; outline: none; appearance: auto; border: 1px solid #afafaf !important;}
</style>

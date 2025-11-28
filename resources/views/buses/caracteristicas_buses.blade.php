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
                  <h4 class="card-title">CARACTERISTICAS BUSES</h4>
                  <p class="card-text">
                    Click on any image to open in lightbox gallery
                  </p>
                  <div id="" class="row">
                    <form action="">
                      <div class="row">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="">Caracteristicas</label>
                            <select name="" id="" class="form-control form-control-md">
                              <option value="">SELECCIONE</option>
                            </select>
                          </div>                          
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label for="">Caracteristicas</label>
                            <select name="" id="" class="form-control form-control-md">
                              <option value="">SELECCIONE</option>
                            </select>
                          </div>                          
                        </div>
                        <div class="col-5">
                          <div class="form-group mt-3" style="display: flex;width: 100%;justify-content: flex-end;">
                            <button type="button" onclick="buscar_empresa()" class="btn btn-primary btn-sm text-white"><i class="ti-search"></i> Buscar</button>
                            <!-- <button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Nuevo</button> -->
                            <button type="button" class="btn btn-success text-white btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-4" data-whatever="@getbootstrap"><i class="ti-plus"></i> Nuevo</button>
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
                            <th class="text-center align-middle">CARACTERISTICAS</th>
                            <th class="text-center align-middle">FECHA CREACION</th>
                            <th class="text-center align-middle">FECHA ELIMINACION</th>
                            <th class="text-center align-middle">ESTADO</th>
                            <th class="text-center align-middle">ACCIONES</th>
                        </tr>                 
                      </thead>
                      <tbody>
                        <tr>
                            <td>1</td>
                            <td>CRUZ DEL SUR</td>
                            <td>MENDEZ LULOCE</td>
                            <td>12345</td>
                            <td><a href="">Ver Sucursales</a></td>
                            <td>
                              <button class="btn btn-outline-success btn-sm">Activo</button>
                            </td>
                            <td>
                              <a href="" class="label text-primary" style="text-decoration: none;"><i class="ti-pencil"></i></a>
                              <a href="" class="label text-danger" style="text-decoration: none;"><i class="ti-close"></i></a>
                            </td>
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
  @stop

  <!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script>
    // function buscar_empresa() {
    //   console.log('asdasd');
    // }

    // $.ajax({
    //         url: url+"encuesta",
    //         data:{
    //             "id":updateID,
    //             "nombre":$("#encuestaUPDATEnombre").val(),
    //             "estado":$("#encuestaUPDATEestado").val(),
    //             "finicio":$("#encuestaUPDATEfinicio").val(),
    //             "ffin":$("#encuestaUPDATEffin").val()
    //         },
    //         method:"PUT",
    //     }).done(function(data){
    //         example.clear().draw();
    //         search();
    //         $("#encuestaUPDATEnombre").val('');
    //         $("#encuestaUPDATEestado").val('');
    //         $("#encuestaUPDATEfinicio").val('');
    //         $("#encuestaUPDATEffin").val('');
    //         $('#modal-edit').modal('hide');
    //     });
  </script>
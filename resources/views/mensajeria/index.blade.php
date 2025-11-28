@extends('layouts.app')
@section('title', 'mensajes')
@section('styles')
<style type="text/css">
    .form-control,
    .typeahead,
    .tt-query,
    .tt-hint,
    .select2-container--default .select2-selection--single .select2-search__field,
    .select2-container--default .select2-selection--single,
    .jsgrid .jsgrid-table .jsgrid-filter-row input[type=number],
    .jsgrid .jsgrid-table .jsgrid-filter-row input[type=text],
    .jsgrid .jsgrid-table .jsgrid-filter-row select,
    .dataTables_wrapper select,
    .asColorPicker-input {
        height: 36px;
    }
</style>
@endsection
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
                    <div class="email-wrapper wrapper">
                        <div class="row ">
                            <!--align-items-stretch-->
                            <div class="mail-sidebar d-none d-lg-block col-md-3 pt-3  bg-white">
                                <div class="menu-bar">
                                    <div class="wrapper">
                                        <div class="online-status d-flex justify-content-between align-items-center">
                                            <p class="chat">Chats</p>
                                        </div>
                                    </div>
                                    <ul class="profile-list">
                                        <li class="profile-list-item">
                                            <a href="#">
                                                <span class="pro-pic">
                                                    <img src="../../../../images/faces/face1.jpg" alt="">
                                                </span>
                                                <div class="user">
                                                    <p class="u-name">Vicente Meza</p>
                                                    <p class="u-designation">En Línea</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="profile-list-item">
                                            <a href="#">
                                                <span class="pro-pic">
                                                    <img src="../../../../images/faces/face2.jpg" alt="">
                                                </span>
                                                <div class="user">
                                                    <p class="u-name">Stella Johnson</p>
                                                    <p class="u-designation">En Línea</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="profile-list-item">
                                            <a href="#">
                                                <span class="pro-pic">
                                                    <img src="../../../../images/faces/face20.jpg" alt="">
                                                </span>
                                                <div class="user">
                                                    <p class="u-name">Catherine Pinto</p>
                                                    <p class="u-designation">En Línea</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="profile-list-item">
                                            <a href="#">
                                                <span class="pro-pic">
                                                    <img src="../../../../images/faces/face12.jpg" alt="">
                                                </span>
                                                <div class="user">
                                                    <p class="u-name">John Doe</p>
                                                    <p class="u-designation">En Línea</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="profile-list-item">
                                            <a href="#">
                                                <span class="pro-pic">
                                                    <img src="../../../../images/faces/face25.jpg" alt="">
                                                </span>
                                                <div class="user">
                                                    <p class="u-name">Daniel Russell</p>
                                                    <p class="u-designation">En Línea</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="profile-list-item">
                                            <a href="#">
                                                <span class="pro-pic">
                                                    <img src="../../../../images/faces/face10.jpg" alt="">
                                                </span>
                                                <div class="user">
                                                    <p class="u-name">Sarah Graves</p>
                                                    <p class="u-designation">En Línea</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mail-list-container col-md-2 pt-4 pb-4 border-right bg-white">
                                <div class="card-body">
                                    <div class=" text-center pb-4">
                                        <img src="../../../../images/faces/face28.jpg" alt="profile"
                                            class="img-lg rounded-circle mb-3" />
                                        <div class="mb-3">
                                            <h3>Vicente Meza</h3>
                                        </div>
                                        <div class="text-left py-4">
                                            <p class="clearfix">
                                                <span class="float-left"> Edad: </span>
                                                <span class="float-right text-muted"> 25 años </span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left"> Celúlar: </span>
                                                <span class="float-right text-muted">
                                                    +51 006 3435 222 000
                                                </span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left"> Correo Electrónico: </span>
                                                <span class="float-right text-muted">
                                                    Jacod@testmail.com
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mail-view d-none d-md-block col-md-9 col-lg-7 border-left  border-right bg-white">
                                <div class="row">
                                    <div class="col-md-12 mb-4 mt-4 text-center text-success">
                                        <p><i class="ti-lock"></i> Cifrado de extremo a extremo</p>
                                        <p>La conversaciones de los chat cifrados de extremo a extremo. Estos chats y
                                            llamadas son privados entre tu y el destinatario, y nadie más puede leer o
                                            escuchar su contenido.</p>
                                    </div>
                                </div>
                                <div class="message-body overflow-auto">
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
                                            <img src="../../../../images/faces/face28.jpg" alt="profile"
                                                class="img-sm rounded-circle" />
                                            <div class="ms-4">
                                                <h6>
                                                    Vicente Meza
                                                </h6>
                                                <p>
                                                    There is no better advertisement campaign that is low cost and also
                                                    successful at the same time.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex justify-content-end profile-feed-item">
                                            <div class="me-4">
                                                <h6 class="text-end">
                                                    Yo
                                                </h6>
                                                <p class="text-end">
                                                    There is no better advertisement campaign that is low cost and also
                                                    successful at the same time. There is no better advertisement campaign that is low cost and also
                                                    successful at the same time
                                                </p>
                                            </div>
                                            <img src="../../../../images/faces/face12.jpg" alt="profile"
                                                class="img-sm rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
                                            <img src="../../../../images/faces/face28.jpg" alt="profile"
                                                class="img-sm rounded-circle" />
                                            <div class="ms-4">
                                                <h6>
                                                    Vicente Meza
                                                </h6>
                                                <p>
                                                    There is no better advertisement campaign that is low cost and also
                                                    successful at the same time.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex justify-content-end profile-feed-item">
                                            <div class="me-4">
                                                <h6 class="text-end">
                                                    Yo
                                                </h6>
                                                <p class="text-end">
                                                    There is no better advertisement campaign that is low cost and also
                                                    successful at the same time. There is no better advertisement campaign that is low cost and also
                                                    successful at the same time
                                                </p>
                                            </div>
                                            <img src="../../../../images/faces/face12.jpg" alt="profile"
                                                class="img-sm rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
                                            <img src="../../../../images/faces/face28.jpg" alt="profile"
                                                class="img-sm rounded-circle" />
                                            <div class="ms-4">
                                                <h6>
                                                    Vicente Meza
                                                </h6>
                                                <p>
                                                    There is no better advertisement campaign that is low cost and also
                                                    successful at the same time.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex justify-content-end profile-feed-item">
                                            <div class="me-4">
                                                <h6 class="text-end">
                                                    Yo
                                                </h6>
                                                <p class="text-end">
                                                    There is no better advertisement campaign that is low cost and also
                                                    successful at the same time. There is no better advertisement campaign that is low cost and also
                                                    successful at the same time
                                                </p>
                                            </div>
                                            <img src="../../../../images/faces/face12.jpg" alt="profile"
                                                class="img-sm rounded-circle" />
                                        </div>
                                    </div>
                                </div>
                                <div class="attachments-sections mt-3">
                                   <form action="">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-md " id="exampleInputName1" placeholder="Nombre">
                                                <div class="input-group-append">
                                                  <button class="btn btn-sm btn-primary " type="button">Enviar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    @include('layouts.app.derechos')
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
    @endsection
    @section('scripts')

    @endsection

<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation">
            @if(auth()->user()->tipousuario_id == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('ventas') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Ventas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('encomiendas') }}">
                    <i class="icon-cog menu-icon"></i>
                    <span class="menu-title">Encomiendas</span>
                </a>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link" href="{{ url('mensajeria/index') }}">
                    <i class="ti-comments menu-icon"></i>
                    <span class="menu-title">Mensajes</span>
                </a>
            </li>
            -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="ti-wallet menu-icon"></i>
                    <span class="menu-title">Caja</span>
                    <i class="menu-arrow"></i></a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item"><a class="nav-link" href="{{ url('caja') }}">Arqueo Caja</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Nueva Caja</a></li>
                    </ul>
                </div>
            </li>
            @endif
            <!--
            <li class="nav-item mega-menu">
                <a href="#" class="nav-link">
                    <i class="ti-files menu-icon"></i>
                    <span class="menu-title">Reportes</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <div class="col-group-wrapper row">
                        <div class="col-group col-md-4">
                            <div class="row">
                                <div class="col-12">
                                    <p class="category-heading">Advanced Elements</p>
                                    <div class="submenu-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ url('reportes/buscar-por-documento') }}">Buscar Documento</a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/buttons.html">Buttons</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/badges.html">Badges</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/dropdowns.html">Dropdown</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/modals.html">Modals</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/progress.html">Progress bar</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/pagination.html">Pagination</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/tabs.html">Tabs</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/typography.html">Typography</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/tooltips.html">Tooltip</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-group col-md-4">
                            <div class="row">
                                <div class="col-12">
                                    <p class="category-heading">Advanced Elements</p>
                                    <div class="submenu-item">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/dragula.html">Dragula</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/carousel.html">Carousel</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/clipboard.html">Clipboard</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/context-menu.html">Context Menu</a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/loaders.html">Loader</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/slider.html">Slider</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/popups.html">Popup</a></li>
                                                    <li class="nav-item"><a class="nav-link"
                                                            href="pages/ui-features/notifications.html">Notification</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-group col-md-4">
                            <p class="category-heading">Icons</p>
                            <ul class="submenu-item">
                                <li class="nav-item"><a class="nav-link" href="pages/icons/flag-icons.html">Flag
                                        Icons</a></li>
                                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="pages/icons/font-awesome.html">Font
                                        Awesome</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="pages/icons/simple-line-icon.html">Simple Line Icons</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/icons/themify.html">Themify
                                        Icons</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            -->
            <li class="nav-item">
                   <a href="#" class="nav-link">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Mantenimiento</span>
                    <i class="menu-arrow"></i></a>
                <div class="submenu">
                    <ul class="submenu-item">
                        @if(auth()->user()->tipousuario_id == 1)
                        <li class="nav-item"><a class="nav-link" href="{{ url('usuarios') }}">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('clientes') }}">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('buses') }}">Buses</a></li>
                        <!--
                        <li class="nav-item"><a class="nav-link" href="{{ url('buses/caracteristicas_buses') }}">Caracteristicas Buses</a></li>
                        -->
                        @endif

                        @if(auth()->user()->tipousuario_id == 1)
                        <li class="nav-item"><a class="nav-link" href="{{ url('caracteristicasbasesbuses') }}">Caracteristicas Bases Buses</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('destinos') }}">Destinos</a></li>
                        @endif
                        
                        @if(auth()->user()->tipousuario_id == 1)
                        <!--
                        <li class="nav-item"><a class="nav-link" href="{{ url('rutas') }}">Rutas</a></li>
                        -->
                        <li class="nav-item"><a class="nav-link" href="{{ url('sucursales') }}">Locales</a></li>
                        @endif

                        @if(auth()->user()->tipousuario_id == 1 || auth()->user()->tipousuario_id == 2)
                        <li class="nav-item"><a class="nav-link" href="{{ url('itinerarios') }}">Itinerarios</a>
                        </li>
                        @endif
                        
                        @if(auth()->user()->tipousuario_id == 1)
                        <li class="nav-item"><a class="nav-link" href="{{ url('tipo_usuarios') }}">Tipo Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('empresas') }}">Empresas</a></li>
                        @endif
                        <!-- <li class="nav-item"><a class="nav-link" href="empresas/index.blade.php">Empresas Asociadas</a></li> -->
                        <!--           <li class="nav-item"><a class="nav-link" href="pages/forms/text_editor.html">Text Editor</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages/forms/code_editor.html">Code Editor</a></li> -->
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

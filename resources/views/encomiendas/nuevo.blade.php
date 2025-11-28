<div class="modal fade" id="modal-encomienda-form" tabindex="-1" role="dialog" aria-labelledby="encomiendaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form_nueva_encomienda" action="javascript:void();"  novalidate="novalidate">
                <div class="modal-header p-3">
                    <h5 class="modal-title" id="encomiendaModalLabel">Registrar Encomienda</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="" class="row">
                        <h5 class="card-description">Datos del Remitente</h5>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="tipoDniR">Tipo</label>
                                    <select name="tipo" id="tipoDniR" required class="form-control form-control-md">
                                        <option value="">Seleccione...</option>
                                        <option value="">DNI</option>
                                        <option value="">Carnet Extranjero</option>
                                        <option value="">Pasaporte</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nroR">Nro.</label>
                                    <input type="text" name="" id="nroR" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nombresR">Nombres</label>
                                    <input type="text" name="" id="nombresR" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="paternosR">Paternos</label>
                                    <input type="text" name="" id="paternosR" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="maternosR">Maternos</label>
                                    <input type="text" name="" id="maternosR" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="celularR">Celular</label>
                                    <input type="text" name="" id="celularR" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="puntoVentaR">Punto de Venta</label>
                                    <select name="" id="puntoVentaR" required class="form-control form-control-md">
                                        <option value="">Seleccione...</option>
                                        <option value="">Ventanilla</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-description">Datos del Consignado</h5>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="tipoC">Tipo</label>
                                    <select name="" id="tipoC" required class="form-control form-control-md">
                                        <option value="">Seleccione...</option>
                                        <option value="">DNI</option>
                                        <option value="">Carnet Extranjero</option>
                                        <option value="">Pasaporte</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nroC">Nro.</label>
                                    <input type="text" name="" id="nroC" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nombresC">Nombres</label>
                                    <input type="text" name="" id="nombresC" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="paternosC">Paternos</label>
                                    <input type="text" name="" id="paternosC" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="maternosC">Maternos</label>
                                    <input type="text" name="" id="maternosC" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="celularC">Celular</label>
                                    <input type="text" name="" id="celularC" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="destinoC">Destino</label>
                                    <select name="" id="destinoC" required
                                        class="form-control form-control-md">
                                        <option value="">Seleccione...</option>
                                        <option value="">Lima</option>
                                        <option value="">Cajamarca</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-description">Datos de la Encomienda</h5>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="fechaEnvio">Fecha de Envío</label>
                                    <input type="date" name="" id="fechaEnvio" required
                                        class="form-control form-control-md">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="formaPago">Forma de Pago</label>
                                    <select name="" id="formaPago" required
                                        class="form-control form-control-md">
                                        <option value="">Seleccione...</option>
                                        <option value="">Efectivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="documento">Documento</label>
                                    <select name="" id="documento" required
                                        class="form-control form-control-md">
                                        <option value="">Seleccione...</option>
                                        <option value="">Boleta</option>
                                        <option value="">Factura</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="correlativo">Correlativo</label>
                                    <input type="text" class="form-control form-control-md" name=""
                                        id="correlativo" readonly value="BE11-00000592">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="contrasena">Contraseña</label>
                                    <input type="password" class="form-control form-control-md" name=""
                                        id="contrasena">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive bg-white">
                                    <table id="order-listing" class="table table-sm tableEncomienda">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle">Cantidad</th>
                                                <th class="text-center align-middle">Descripción</th>
                                                <th class="text-center align-middle">Peso</th>
                                                <th class="text-center align-middle">Total</th>
                                                <th class="text-center align-middle">
                                                    <button type="button" id="aggItemEncomienda"
                                                        class="btn btn-link p-1"><i class="ti-plus"></i> Agregar
                                                        item</button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr class="">
                                                <td colspan="3" class="text-end p-1 m-0">OP. GRAVADA</td>
                                                <td class="pt-1 pb-1"><input type="text"
                                                        class="form-control form-control-sm" name=""
                                                        id="" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end p-1 m-0">I.G.V</td>
                                                <td class="pt-1 pb-1"><input type="text"
                                                        class="form-control form-control-sm" name=""
                                                        id="" readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end p-1 m-0">TOTAL</td>
                                                <td class="pt-1 pb-1"><input type="text"
                                                        class="form-control form-control-sm" name=""
                                                        id="" readonly></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-3">
                    <button type="submit" id="registrarEncomienda" class="btn btn-success btn-sm">Registrar Encomienda</button>
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ends -->

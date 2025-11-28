<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nueva empresa</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud" method="post" action="empresas">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-tipo_documento" class="col-form-label">Tipo de documento:</label>
                        <select class="form-control form-control-sm resetable" id="input-tipo_documento" name="tipo_documento">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="1">DNI</option>
                            <option value="6">RUC</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-numero_documento" class="col-form-label">Número de documento:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-numero_documento" name="numero_documento">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="input-razon_social" class="col-form-label">Razón social:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-razon_social" name="razon_social">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-nombre_comercial" class="col-form-label">Nombre comercial:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-nombre_comercial" name="nombre_comercial">
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-direccion" class="col-form-label">Dirección:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-direccion" name="direccion">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-pais" class="col-form-label">País:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-pais" name="pais">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-telefono_1" class="col-form-label">Teléfono 1:</label>
                        <input type="tel" class="form-control form-control-sm resetable" id="input-telefono_1" name="telefono_1">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-telefono_2" class="col-form-label">Teléfono 2:</label>
                        <input type="tel" class="form-control form-control-sm resetable" id="input-telefono_2" name="telefono_2">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-email" class="col-form-label">E-mail:</label>
                        <input type="email" class="form-control form-control-sm resetable" id="input-email" name="email">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-tipo_membresia" class="col-form-label">Tipo de membresía:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-tipo_membresia" name="tipo_membresia">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input-monto_membresia" class="col-form-label">Monto de membresía:</label>
                        <input type="number" class="form-control form-control-sm resetable" id="input-monto_membresia" name="monto_membresia" min="0" value="0" step="0.01">
                    </div>
                </div>
            </div>
            <input type="hidden" name="estado" id="estado" value="1" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" form="form-crud">Guardar</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo cliente</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-2">
        <form id="form-crud" method="post" action="">
            @csrf
            @method('put')
            <input type="hidden" name="estado" id="estado" value="1" />
            <input type="hidden" name="empresa_id" value="{{ auth()->user()->empresa }}">
            <input type="hidden" name="sucursal_id" value="{{ auth()->user()->codsucursal }}">
            <div class="row">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-tipo_documento" class="col-form-label">Tipo de Documento:</label>
                    <select class="form-control form-control-sm resetable" name="tipo_documento" id="input-tipo_documento">
                        <option value="1">DNI</option>
                        <option value="2">Carnet de Extranjería</option>
                    </select>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-numero_documento" class="col-form-label">Nùmero de Documento:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-numero_documento" name="numero_documento">
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-paterno" class="col-form-label">Paterno:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-paterno" name="paterno">
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-materno" class="col-form-label">Materno:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-materno" name="materno">
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-nombres" class="col-form-label">Nombres:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-nombres" name="nombres">
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-telefono" class="col-form-label">Telefono:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-telefono" name="telefono">
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-nacionalidad" class="col-form-label">Nacionalidad:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-nacionalidad" name="nacionalidad">
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label for="input-email" class="col-form-label">Email:</label>
                    <input type="email" class="form-control form-control-sm resetable" id="input-email" name="email">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label for="input-fecha_nacimiento" class="col-form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_nacimiento" name="fecha_nacimiento">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" form="form-crud">Guardar</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

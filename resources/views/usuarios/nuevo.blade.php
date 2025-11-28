<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo usuario</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-2">
        <form id="form-crud" method="post" action="{{ route('usuarios.store') }}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-numerodocumento" class="col-form-label">Número de documento:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-numerodocumento" name="numerodocumento">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-nombres" class="col-form-label">Nombres:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-nombres" name="nombres">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-apellidos" class="col-form-label">Apellidos:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-apellidos" name="apellidos">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-email" class="col-form-label">Email:</label>
                    <input type="email" class="form-control form-control-sm resetable" id="input-email" name="email">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-telefono" class="col-form-label">Teléfono:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-telefono" name="telefono">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-fecha_nacimiento" class="col-form-label">Fecha de nacimiento:</label>
                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_nacimiento" name="fecha_nacimiento">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-edad" class="col-form-label">Edad:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-edad" readonly>
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-clave" class="col-form-label">Clave:</label>
                    <input type="text" class="form-control form-control-sm resetable" id="input-clave" name="clave">
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-tipousuario_id" class="col-form-label">Tipo de usuario:</label>
                    <select class="form-control form-control-sm resetable" id="input-tipousuario_id" name="tipousuario_id">
                        <option value="0">Seleccionar &rarr;</option>
                        @foreach($tiposUsuario as $tipoUsuario)
                            <option value="{{ $tipoUsuario->id }}">{{ $tipoUsuario->tipousuario }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-tipousuario_id" class="col-form-label">Empresa:</label>
                    <select class="form-control form-control-sm resetable" id="input-empresa" name="empresa">
                        <option value="">Seleccionar &rarr;</option>
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre_comercial }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-sm-12 mb-2">
                    <label for="input-sucursal" class="col-form-label">Sucursal:</label>
                    <select class="form-control form-control-sm resetable" id="input-sucursal" name="sucursal">
                        <option value="">Seleccionar &rarr;</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="estado" id="input-estado" value="1" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-save-modal" form="form-crud">Guardar</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

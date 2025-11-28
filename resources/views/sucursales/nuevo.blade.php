<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nueva sucursal</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud" method="post" action="">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-empresa_id" class="col-form-label">Empresa:</label>
                        <select class="form-control form-control-sm resetable" id="input-empresa_id" name="empresa_id">
                            <option value="">Seleccionar &rarr;</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre_comercial }}</option>
                            @endforeach
                        </select>
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
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-razon_social" class="col-form-label">Razón social:</label>
                        <input type="tel" class="form-control form-control-sm resetable" id="input-razon_social" name="razon_social">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-telefono" class="col-form-label">Teléfono:</label>
                        <input type="tel" class="form-control form-control-sm resetable" id="input-telefono" name="telefono">
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
                        <label for="input-email" class="col-form-label">E-mail:</label>
                        <input type="email" class="form-control form-control-sm resetable" id="input-email" name="email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-departamento" class="col-form-label">Departamento:</label>
                        <select class="form-control form-control-sm resetable" id="input-departamento" name="departamento">
                            <option value="">Seleccionar &rarr;</option>
                            @foreach($departamentos as $opt)
                            <option value="{{ $opt->id }}">{{ $opt->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-provincia" class="col-form-label">Provincia:</label>
                        <select class="form-control form-control-sm resetable" id="input-provincia" name="provincia">
                            <option value="">Seleccionar &rarr;</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-distrito" class="col-form-label">Distrito:</label>
                        <select class="form-control form-control-sm resetable" id="input-distrito" name="distrito">
                            <option value="">Seleccionar &rarr;</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-latitud" class="col-form-label">Latitud:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-latitud" name="latitud">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input-longitud" class="col-form-label">Longitud:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-longitud" name="longitud">
                    </div>
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

<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo Bus</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud" method="post" action="" style="font-size: 8px !important;">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-carroceria_original" class="col-form-label">CARROCERIA ORIGINAL:</label>
                        <select class="form-control form-control-sm resetable" id="input-carroceria_original" name="carroceria_original">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="YES">si</option>
                            <option value="NO">no</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-categoria" class="col-form-label">CATEGORIA:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-categoria" name="categoria">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="hidden" name="empresa_table" value="{{$empresa}}">
                        <input type="hidden" name="usuario" value="{{$usuario}}">
                        <input type="hidden" name="estado" value="1">
                        <label for="input-tuc" class="col-form-label">TARJETA UNICA DE CIRCULACION VEHICULAR (TUC):</label>
                        <select class="form-control form-control-sm resetable" id="input-tuc" name="tuc">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="yes">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-citv" class="col-form-label">CENTRO DE INSPECCION TECNICA VEHICULAR (CITV):</label>
                        <select class="form-control form-control-sm resetable" id="input-citv" name="citv">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="yes">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-fecha_vencimiento_tuc" class="col-form-label">FECHA VENCIMIENTO (TUC):</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-fecha_vencimiento_tuc" name="fecha_vencimiento_tuc">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-fecha_emision_tuc" class="col-form-label">FECHA EMISION (TUC):</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-fecha_emision_tuc" name="fecha_emision_tuc">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-soat" class="col-form-label">SOAT:</label>
                        <select class="form-control form-control-sm resetable" id="input-soat" name="soat">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="yes">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>



                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-ultimo_citv" class="col-form-label">FECHA ULTIMA (CITV):</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-ultimo_citv" name="ultimo_citv">
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-fecha_vencimiento_soat" class="col-form-label">FECHA VENCIMIENTO SOAT:</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-fecha_vencimiento_soat" name="fecha_vencimiento_soat">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-tarjeta_propiedad" class="col-form-label">TARJETA DE PROPIEDAD:</label>
                        <select class="form-control form-control-sm resetable" id="input-tarjeta_propiedad" name="tarjeta_propiedad">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="yes">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-tiv_electronica" class="col-form-label">TARJETA DE IDENTIFICACION VEHICULAR ELECTRONICA (TIVe):</label>

                        <select class="form-control form-control-sm resetable" id="input-tiv_electronica" name="tiv_electronica">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="yes">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-tiv_fisico" class="col-form-label">TARJETA DE IDENTIFICACION VEHICULAR FISICA (TIV):</label>
                        <select class="form-control form-control-sm resetable" id="input-tiv_fisico" name="tiv_fisico">
                            <option value="">Seleccionar &rarr;</option>
                            <option value="yes">si</option>
                            <option value="no">no</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-fecha_emision_tiv" class="col-form-label">FECHA EMISION (TIVe):</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-fecha_emision_tiv" name="fecha_emision_tiv">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-fecha_vencimiento_tiv" class="col-form-label">FECHA VENCIMIENTO (TIV):</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-fecha_vencimiento_tiv" name="fecha_vencimiento_tiv">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-marca" class="col-form-label">MARCA:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-marca" name="marca">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-placa" class="col-form-label">PLACA:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-placa" name="placa">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input-fecha_emision_soat" class="col-form-label">FECHA EMISION SOAT:</label>
                        <input type="date" class="form-control form-control-sm resetable" id="input-fecha_emision_soat" name="fecha_emision_soat">
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

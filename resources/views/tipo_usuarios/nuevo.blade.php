<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo tipo usuario</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud" method="post" action="">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="input-tipousuario" class="col-form-label">Tipo usuario:</label>
                <input type="text" class="form-control form-control-sm resetable" id="input-tipousuario" name="tipousuario">
            </div>
            <input type="hidden" id="input-estado" name="estado" value="1" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" form="form-crud">Guardar</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

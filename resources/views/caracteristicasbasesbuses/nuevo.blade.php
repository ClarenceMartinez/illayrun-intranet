<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nueva Caracteristica Buses Bases</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud" method="post" action="{{ route('caracteristicasbasesbuses.store') }}">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-nombre_caracteristica" class="col-form-label">Nombre Característica Buses Base:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-nombre_caracteristica" name="nombre_caracteristica">
                    </div>
                </div>
                <input type="hidden" name="estado" id="estado" value="1" />

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

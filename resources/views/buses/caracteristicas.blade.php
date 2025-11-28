<div class="modal fade" id="exampleModal-5" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo Bus</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud-caracteristicas" method="post" action="{{route('buses.save.caracteristicas')}}" style="font-size: 8px !important;">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <input type="hidden" id="id_buses" name="id_buses">
                        <label class="label-control">Caracteristicas de buses base</label>
                        <div class="form-control caracteristicas" style="display: flex;flex-wrap:wrap; align-content:center">
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" form="form-crud-caracteristicas">Guardar</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

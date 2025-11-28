<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo Asiento</h5>
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
                        <label for="input-bus_id">BUSES</label>
                        <input type="hidden" name="estado" value="1">
                        <select name="bus_id" id="filter-bus_id" class="form-control form-control-sm">
                            <option value="">SELECCIONE</option>
                            @foreach($tableRows2 as $row)
                                <option value="{{ $row->id }}">{{ $row->placa }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-numero">NÚMERO:</label>
                        <input type="text" class="form-control form-control-sm resetable" id="input-numero" name="numero">
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

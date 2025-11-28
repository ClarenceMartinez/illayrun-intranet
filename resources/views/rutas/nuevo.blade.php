<div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Nuevo Rutas</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-crud" method="post" style="font-size: 8px !important;">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-bus_id">BUSES</label>

                        <select name="buses_id" id="input-buses_id" class="form-control form-control-sm">
                            <option value="">SELECCIONE</option>
                            @foreach($tableRows2 as $row)
                                <option value="{{ $row->id }}">{{ $row->placa }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="input-bus_id">ORIGEN</label>

                        <select name="origen_id" id="input-origen_id" class="form-control form-control-sm">
                            <option value="">SELECCIONE</option>
                            @foreach($tableRows3 as $row)
                                <option value="{{ $row->id }}">{{ $row->nombre }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input-bus_id">DESTINO</label>
                        <input type="hidden" name="estado" value="1">
                        <select name="destino_id" id="filter-destino_id" class="form-control form-control-sm">
                            <option value="">SELECCIONE</option>
                            @foreach($tableRows3 as $row)
                                <option value="{{ $row->id }}">{{ $row->nombre }}</option>

                            @endforeach
                        </select>
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

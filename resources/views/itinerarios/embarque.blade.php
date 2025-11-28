<div class="modal fade" id="modal-itinerario-embarque" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Embarque</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <form id="form-embarque" method="post" action="">
          @csrf
          <div class="row row-cols-lg-auto align-items-end">
            <div class="col-4">
              <label for="">Sucursal</label>
              <select class="form-control form-control-sm">
                @foreach($tableRows5 as $row)
                <option value="{{ $row->id }}">{{ $row->nombre_comercial }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-4">
              <label>Hora</label>
              <input type="time" class="form-control form-control-sm">
            </div>
            <div class="col-4">
              <button class="btn btn-success btn-sm">Agregar</button>   
            </div>
          </div>
        </form>

        <table class="table">
          <thead>
            <tr>
              <th>Sucursal</th>
              <th>Hora</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

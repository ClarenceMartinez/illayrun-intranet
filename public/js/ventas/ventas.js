(function ($) {
    'use strict';

    $('#formNino').hide();

    $('#btnRegNino').click(function () {
        $('#formNino').show();
    });
    $('#deleteFormNino').click(function () {
        $('#formNino').hide();
    });
    $("#AggFormNino").click(function () {
        $("#formNino").append('<div id="FormCampos" class="row"><div class="col-md-3"><div class="form-group"><label for="documentoN">Documento</label><select name="" id="documentoN" required class="form-control form-control-md"><option value="">Seleccione...</option><option value="">DNI</option><option value="">Carnet Extranjero</option><option value="">Pasaporte</option></select></div></div><div class="col-md-3"><div class="form-group"><label for="nroC">Nro.</label><input type="text" name="" id="nroC" required class="form-control form-control-md"></div></div><div class="col-md-2"><div class="form-group"><label for="nombresC">Nombres</label><input type="text" name="" id="nombresC" required class="form-control form-control-md"></div></div><div class="col-md-2"><div class="form-group"><label for="paternosC">Paternos</label><input type="text" name="" id="paternosC" required class="form-control form-control-md"></div></div><div class="col-md-2"><div class="form-group"><label for="maternosC">Maternos</label><input type="text" name="" id="maternosC" required class="form-control form-control-md"></div></div><div class="col-md-3"><div class="form-group"><label for="fechaReservaLimite">Fecha Nac.</label><input type="date" name="" id="fechaNac" required class="form-control form-control-md"></div></div><div class="col-md-1"><div class="form-group"><label for="edad">Edad</label><input type="text" name="" id="edad" class="form-control form-control-md" readonly></div></div><div class="col-md-2"><div class="form-group"><label for="sexo">Sexo</label><select name="" id="sexo" required class="form-control form-control-md"><option value="">Seleccione...</option><option value="">Masculino</option><option value="">Femenino</option></select></div></div><div class="col-md-2"><div class="form-group"><label for="parentesco">Parentesco</label><select name="" id="parentesco" required class="form-control form-control-md"><option value="">Seleccione...</option><option value="">Padre</option><option value="">Madre</option><option value="">Tio (a)</option><option value="">Abuelo (a)</option><option value="">Hermano (a)</option></select></div></div><div class="col-md-3 " ><h5 class="card-description text-danger"><button type="button" id="deleteFormNinoCampos" class="btn btn-link text-danger mt-2"><i class="ti-trash"></i> Eliminar Campos</button></h5></div><div class="w-100"></div></div>');
    });

    $('#formNino').on('click', '#deleteFormNinoCampos', function () {
        $(this).parents('#FormCampos').eq(0).remove();
    });
})(jQuery);

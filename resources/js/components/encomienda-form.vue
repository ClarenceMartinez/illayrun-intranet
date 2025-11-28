<template>
    <form>
        <h5 class="card-description">Datos del Remitente</h5>
        <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
            <div class="col-12">
                <label for="tipoDniR">Tipo Doc.</label>
                <select name="tipo" id="tipoDniR" required class="form-control form-control-md">
                    <option value="">Seleccione...</option>
                    <option value="">DNI</option>
                    <option value="">Carnet Extranjero</option>
                    <option value="">Pasaporte</option>
                </select>
            </div>
            <div class="col-12">
                <label for="">Nro. Doc.</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Nombres</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Apellido Paterno</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Apellido Materno</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Celular</label>
                <input type="text" class="form-control form-control-md">
            </div>
        </div>
        <h5 class="card-description">Datos del Consignado</h5>
        <div class="row row-cols-lg-auto g-3 align-items-center mb-5">
            <div class="col-12">
                <label for="tipoDniR">Tipo Doc.</label>
                <select name="tipo" id="tipoDniR" required class="form-control form-control-md">
                    <option value="">Seleccione...</option>
                    <option value="">DNI</option>
                    <option value="">Carnet Extranjero</option>
                    <option value="">Pasaporte</option>
                </select>
            </div>
            <div class="col-12">
                <label for="">Nro. Doc.</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Nombres</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Apellido Paterno</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Apellido Materno</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label for="">Celular</label>
                <input type="text" class="form-control form-control-md">
            </div>
        </div>
        <h5 class="card-description">Datos de la encomienda</h5>
        <div class="row row-cols-lg-auto gy-3 gx-4 align-items-center mb-5">
            <div class="col-12">
                <label>Punto de Venta</label>
                <select class="form-control form-control-md">
                    <option value="">Seleccione...</option>
                    <option value="">Ventanilla</option>
                </select>
            </div>
            <div class="col-12">
                <label>Destino</label>
                <select class="form-control form-control-md">
                    <option value="">Seleccione...</option>
                </select>
            </div>
            <div class="col-12">
                <label>Fecha de Envío</label>
                <input type="date" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label>Forma de Pago</label>
                <select class="form-control form-control-md">
                    <option value="">Seleccione...</option>
                    <option value="efectivo">Efectivo</option>
                </select>
            </div>
            <div class="col-12">
                <label>Comprobante</label>
                <select class="form-control form-control-md">
                    <option value="">Seleccione...</option>
                    <option value="BOLETA">Boleta</option>
                    <option value="FACTURA">Factura</option>
                </select>
            </div>
            <div class="col-12">
                <label>Correlativo</label>
                <input type="text" class="form-control form-control-md">
            </div>
            <div class="col-12">
                <label>Contraseña</label>
                <input type="text" class="form-control form-control-md">
            </div>
        </div>
        <hr>
        <div class="table-responsive bg-white">
            <table id="order-listing" class="table table-sm tableEncomienda">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Cantidad</th>
                        <th class="text-center align-middle">Descripción</th>
                        <th class="text-center align-middle">Peso</th>
                        <th class="text-center align-middle">Total</th>
                        <th class="text-center align-middle">
                            <button type="button" id="aggItemEncomienda"
                                class="btn btn-link p-1"><i class="ti-plus"></i> Agregar
                                item</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr class="">
                        <td colspan="3" class="text-end p-1 m-0">OP. GRAVADA</td>
                        <td class="pt-1 pb-1"><input type="text"
                                class="form-control form-control-sm" name=""
                                id="" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end p-1 m-0">I.G.V</td>
                        <td class="pt-1 pb-1"><input type="text"
                                class="form-control form-control-sm" name=""
                                id="" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end p-1 m-0">TOTAL</td>
                        <td class="pt-1 pb-1"><input type="text"
                                class="form-control form-control-sm" name=""
                                id="" readonly></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </form>
</template>
<script>
import { required } from 'vuelidate/lib/validators'
export default {
    props: ['encomienda'],
    data(){
        return {
            encomiendaForm: {}
        }
    },
    validations: {
        encomiendaForm: {
            remitente_tipo_documento: {required},
            remitente_numero_documento: {required},
            remitente_nombres: {required},
            remitente_nombres: {required},
            remitente_paternos: {required},
            remitente_maternos: {required},
            remitente_celular: {required},
            consignado_tipo_documento: {required},
            consignado_numero_documento: {required},
            consignado_nombres: {required},
            consignado_nombres: {required},
            consignado_paternos: {required},
            consignado_maternos: {required},
            consignado_celular: {required},
            punto_venta: {required},
            empresa_id: {required},
            sucursal_id: {required},
            fecha_envio: {required},
            forma_pago: {required},
            tipo_comprobante: {required},
            correlativo: {required},
            contrasenia: {required}
        }
    },
    setup() {
        
    },
}
</script>
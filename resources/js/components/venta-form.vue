<template>
    <div class="pt-3">
        <h5>Información del Pasajero(a)</h5>
        <div class="row gx-2 mt-3 align-items-start">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tipoC">Tipo</label>
                    <select class="form-control form-control-sm" v-model="$v.ticket.tipo_documento.$model">
                        <option value="">Seleccione...</option>
                        <option v-for="(td, index) in tipo_docs" :key="'td_'+index" :value="index">{{ td }}</option>
                    </select>
                    <small class="text-danger" v-if="$v.ticket.tipo_documento.$dirty && !$v.ticket.tipo_documento.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="nroC">Nro.</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.numero_documento.$model" v-on:blur="getCliente()" v-on:keyup.enter="getCliente()">
                    <small class="text-danger" v-if="$v.ticket.numero_documento.$dirty &&  !$v.ticket.numero_documento.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="nombresC">Nombres</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.nombres.$model">
                    <small class="text-danger" v-if="$v.ticket.nombres.$dirty &&  !$v.ticket.nombres.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="paternosC">Paternos</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.paterno.$model">
                    <small class="text-danger" v-if="$v.ticket.paterno.$dirty &&  !$v.ticket.paterno.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="maternosC">Maternos</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.materno.$model">
                    <small class="text-danger" v-if="$v.ticket.materno.$dirty &&  !$v.ticket.materno.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="fechaReservaLimite">Fecha Nac.</label>
                    <input type="date" class="form-control form-control-sm" v-model="$v.ticket.fecha_nacimiento.$model">
                    <small class="text-danger" v-if="$v.ticket.fecha_nacimiento.$dirty &&  !$v.ticket.fecha_nacimiento.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="number" class="form-control form-control-sm" :value="edad" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select class="form-control form-control-sm" v-model="$v.ticket.sexo.$model">
                        <option value="">Seleccione...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <small class="text-danger" v-if="$v.ticket.sexo.$dirty &&  !$v.ticket.sexo.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.telefono.$model">
                    <small class="text-danger" v-if="$v.ticket.telefono.$dirty &&  !$v.ticket.telefono.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control form-control-sm" v-model="$v.ticket.email.$model">
                    <small class="text-danger" v-if="$v.ticket.email.$dirty &&  !$v.ticket.email.required">Es obligatorio</small>
                    <small class="text-danger" v-if="$v.ticket.email.$dirty &&  !$v.ticket.email.email">Debes ingresar un correo</small>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.nacionalidad.$model">
                    <small class="text-danger" v-if="$v.ticket.nacionalidad.$dirty &&  !$v.ticket.nacionalidad.required">Es obligatorio</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" v-model="ticket.es_nino" true-value="1" false-value="0">
                            ¿Es niño/niña?
                        <i class="input-helper"></i></label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-md-12">
                <h5 class="card-description">Información de Venta</h5>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="embarque">Embarque</label>
                    <select class="form-control form-control-sm" v-model="$v.ticket.embarque_origen_id.$model">
                        <option value="0">Seleccione...</option>
                        <option v-for="s in sucursales" :key="'slcsuc1_' + s.id" :value="s.id">{{ s.nombre_comercial }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fechaEnvio">Fecha Venta</label>
                    <input type="text" class="form-control form-control-sm" v-model="$v.ticket.fecha_venta.$model" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="documento">Comprobante</label>
                    <select class="form-control form-control-sm" v-model="$v.ticket.comprobante.$model">
                        <option value="">Seleccione...</option>
                        <option value="BOLETA">Boleta</option>
                        <option value="FACTURA">Factura</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="correlativo">Correlativo</label>
                    <input type="text" readonly class="form-control form-control-sm" v-model="$v.ticket.correlativo.$model">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="desembarque">Desembarque</label>
                    <select class="form-control form-control-sm" v-model="$v.ticket.embarque_destino_id.$model">
                        <option value="">Seleccione...</option>
                        <option v-for="s in sucursales" :key="'slcsuc2_' + s.id" :value="s.id">{{ s.nombre_comercial }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select class="form-control form-control-sm" v-model="$v.ticket.tipo.$model">
                        <option value="">Seleccione...</option>
                        <option value="V">Venta</option>
                        <option value="R">Reserva</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3" v-if="ticket.tipo == 'R'">
                <div class="form-group">
                    <label for="fechaReservaLimite">Fecha Reserva Límite</label>
                    <input type="date" class="form-control form-control-sm" v-model="$v.ticket.fecha_reserva.$model">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="fechaReservaLimite">Importe</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">S/</span>
                        <input type="text" class="form-control" v-model="$v.ticket.totalpago.$model">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-end">
            <button class="btn btn-text" @click="$emit('on-close')">CANCELAR</button>
            <button class="btn btn-primary" @click="enviar()">REGISTRAR VENTA</button>
        </div>
    </div>
</template>
<script>
import {required, email} from 'vuelidate/lib/validators';
export default {
    props: ['itinerario', 'ticket', 'sucursales', 'usuario'],
    data(){
        return {
            tipo_docs: ['Seleccione', 'DNI', 'Carnet Extranjeria', 'Pasaporte'],
            asientos: []
        }
    },
    validations: {
        ticket: {
            'tipo_documento': {required},
            'numero_documento': {required},
            'nombres': {required},
            'paterno': {required},
            'materno': {required},
            'fecha_nacimiento': {required},
            'sexo': {required},
            'telefono': {required},
            'email': {required, email},
            'nacionalidad': {required},
            embarque_origen_id: {required},
            embarque_destino_id: {required},
            fecha_venta: {required},
            tipo: {required},
            fecha_reserva: '',
            n_asiento: {required},
            comprobante: {required},
            correlativo: {required},
            totalpago: {required}
        }
    },
    computed: {
        edad(){
            if(this.ticket.fecha_nacimiento === '') return 0;

            var now = dayjs();
            var fecnac = dayjs(this.ticket.fecha_nacimiento);

            return now.diff(fecnac, 'year');
        }
    },
    watch: {
        itinerario: function(newVal, oldVal){
            if(newVal.id > 0 || newVal?.id !== oldVal?.id)
                this.getAsientos();
        }
    },
    methods: {
        getAsientos(){
            axios.get(`/itinerario/${this.itinerario.id}/asientos`).then(response=>{
                this.asientos = response.data;
            });
        },
        getCliente(){
            axios.get('/clientes/find', {params:{tipo_documento:this.ticket.tipo_documento, numero_documento: this.ticket.numero_documento, empresa_id: this.usuario.empresa}}).then(response=>{
                this.ticket.nombres = response.data.nombres;
                this.ticket.paterno = response.data.paterno;
                this.ticket.materno = response.data.materno;
                this.ticket.telefono = response.data.telefono;
                this.ticket.email = response.data.email;
                this.ticket.es_nino = response.data.es_nino;
                this.ticket.fecha_nacimiento = response.data.fecha_nacimiento;
                this.ticket.nacionalidad = response.data.nacionalidad;
                this.ticket.sexo = response.data.sexo;
            });
        },
        enviar(){
            this.$v.ticket.$touch();
            var params = {...this.ticket, itinerario_id: this.itinerario.id, empresa_id: this.usuario.empresa, sucursal_id: this.usuario.codsucursal};
            axios.post('/ventas', params).then(response=>{
                swal({title: 'Éxito', text: 'Venta registrada', icon: 'success'});
                this.$emit('on-success', response.data);
            }, (httpErr=>{
                swal({title: 'Error', text: httpErr.response.data.error, icon: 'error'});
            }));
        }
    }
}
</script>
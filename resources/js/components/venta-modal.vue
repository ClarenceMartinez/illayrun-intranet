<template>
    <div>
        <div class="row">
            <div class="col-6 d-flex flex-row align-items-center">
                <div class="px-1">{{ itinerario.bus_placa }}</div><span>|</span>
                <div class="px-1">{{ itinerario.origen_nombre }}</div><span>|</span>
                <div class="px-1">{{ itinerario.destino_nombre }}</div><span>|</span>
                <div class="px-1">{{ itinerario.fecha_partida }}</div><span>|</span>
                <div class="px-1">{{ itinerario.hora_partida }}</div>
            </div>
            <div class="col-6 d-flex flex-row justify-content-end">
                <h5 class="me-1"><span class="badge bg-primary">Capacidad: {{ asientos.length }}</span></h5>
                <h5 class="me-1"><span class="badge bg-info">Vendidos: {{ asientos_vendidos }}</span></h5>
                <h5 class="me-1"><span class="badge bg-warning">Reservados: {{ asientos_reservados }}</span></h5>
                <h5 class="me-1"><span class="badge bg-danger">Bloqueados: 0</span></h5>
                <h5 class="me-1"><span class="badge bg-secondary">Disponibles: {{ asientos.length - asientos_vendidos - asientos_reservados }}</span></h5>
            </div>
        </div>
        <div class="py-2">
            <div class="fs-3 fw-bold text-center text-primary">Conductores</div>
            <div class="d-flex flex-row align-items-center justify-content-center fs-6">
                <div v-if="itinerario.chofer_id > 0"><span class="text-primary">Conductor 1: </span> {{ itinerario.chofer1_nombres }}</div>
                <div v-if="itinerario.chofer2_id > 0"><span class="text-primary">Conductor 2: </span> {{ itinerario.chofer2_nombres }}</div>
            </div>
        </div>
        <v-venta-bus :itinerario="itinerario" :asientos="asientos"></v-venta-bus>
        <div class="py-2">&nbsp;</div>
        <div class="row">
            <div class="col-3">
                <div class="table-responsive bg-white">
                    <table id="order-listing" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Punto de V.</th>
                                <th class="text-center align-middle">Abrev.</th>
                                <th class="text-center align-middle">Cant.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="caja in pto_ventas" :key="'ptoventa_' + caja.id">
                                <td class="text-truncate">{{ caja.nombre_comercial }}</td>
                                <td></td>
                                <td>{{ caja.conteo_ventas }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-9">
                <div>
                    <ul class="nav nav-pills" style="font-size: 12px; padding-bottom: .6rem;">
                        <li class="nav-item">
                            <a class="nav-link bg-secondary text-white" href="#" @click="openModal()" style="border-top-left-radius: 50px;"><i class="fa fa-plus-square"></i> Añadir</a>
                        </li>
                        <li class="nav-item" v-for="(ticket, index) in tickets" :key="'ticket_' + index">
                            <a class="nav-link" :class="{'active': index==currentTicketIndex}" href="#" @click="changeTicket(index)">Asiento {{ ticket.asiento_numero }}</a>
                        </li>
                    </ul>
                    <div id="venta-form-container" v-if="currentTicket !== null">
                        <v-venta-form 
                            :itinerario="itinerario" 
                            :ticket="currentTicket"
                            :sucursales="sucursales"
                            :usuario="usuario"
                            v-on:on-close="closeTicket()" v-on:on-success="onRegisteredVenta($event)"></v-venta-form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-asientos-disponibles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selecciona el asiento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="d-grid mb-2" v-for="(asiento, index) in asientos_disponibles" :key="index">
                            <button class="btn btn-primary btn-sm" @click="addTicket(asiento)">Asiento {{  asiento.numero }} - Piso {{ asiento.piso + 1}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['itinerario', 'usuario', 'sucursales'],
    data(){
        return {
            tickets: [],
            asientos: [],
            modalInstance: null,
            currentTicket: null,
            currentTicketIndex: -1,
            asientos_vendidos: 0,
            asientos_reservados: 0,
            asientos_bloqueados: 0,
            pto_ventas: [],
            formTemplate: {
                'cliente_id': 0,
                'tipo_documento': 1,
                'numero_documento': '',
                'nombres': '',
                'paterno': '',
                'materno': '',
                'fecha_nacimiento': '',
                'sexo': '',
                'telefono': '',
                'email': '',
                'nacionalidad': '',
                'es_nino': 0,
                'embarque_origen_id': 0,
                'embarque_destino_id': 0,
                'fecha_venta': dayjs().format('DD/MM/YYYY'),
                'tipo': '1',
                'fecha_reserva': '',
                'n_asiento': 0,
                'comprobante': 'BOLETA',
                'correlativo': 'FP11-00000093',
                'totalpago': 0
            }
        }
    },
    watch: {
        itinerario: function(newVal, oldVal){
            if(newVal.id > 0){
                this.obtenerAsientos();
                this.obtenerPtoVentas();
            }
        }
    },
    setup() {
        
    },
    computed: {
        asientos_disponibles(){
            return this.asientos.filter(i=>i.venta_id==null).filter(j=>this.tickets.find(i=>i.n_asiento==j.asiento_id) == undefined );
        }
    },
    methods: {
        addTicket(asiento){
            this.tickets.push({...this.formTemplate, n_asiento:asiento.asiento_id, asiento_numero:asiento.numero});
            this.currentTicketIndex = this.tickets.length - 1;
            this.currentTicket = this.tickets[this.tickets.length - 1];

            this.modalInstance.hide();
        },
        changeTicket(index){
            this.currentTicketIndex = index;
            this.currentTicket = this.tickets[index];
        },
        closeTicket(){
            this.tickets.splice(this.currentTicketIndex, 1);
            if(this.tickets.length > 1)
                this.changeTicket(this.currentTicketIndex - 1);
            else if(this.tickets.length == 1){
                this.changeTicket(0);
            } else {
                this.currentTicket = null;
            }
        },
        obtenerAsientos(){
            axios.get('/itinerario/'+this.itinerario.id+'/asientos').then(response=>{
                this.asientos = response.data;
                this.recalcularAsientos();
            });
        },
        obtenerPtoVentas(){
            axios.get('/ventas/ptoventas', {params:{itinerario_id: this.itinerario.id}}).then(response=>{
                this.pto_ventas = response.data;
            })
        },
        openModal(){
            this.modalInstance = new bootstrap.Modal(document.getElementById('modal-asientos-disponibles'), {backdrop: 'static', keyboard: false});
            this.modalInstance.show();
        },
        onRegisteredVenta(){
            this.closeTicket();
            this.obtenerAsientos();
            this.obtenerPtoVentas();
        },
        recalcularAsientos(){
            setTimeout(()=>{
                this.asientos_vendidos = this.asientos.filter(i=>{return i.venta_id>0 && i.venta_tipo=='V' && Number(i.venta_estado)==1;}).length;
                this.asientos_reservados = this.asientos.filter(i=>{return i.venta_id>0 && i.venta_tipo=='R' && Number(i.venta_estado)==1;}).length;
            },500);
        }
    }
}
</script>
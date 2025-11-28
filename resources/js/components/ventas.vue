<template>
    <div class="content-wrapper">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">LISTA DE BUSES</h3>
                <hr>
                <div class="row row-cols-lg-auto g-3 align-items-end">
                    <div class="col-12">
                        <label for="">Origen</label>
                        <select class="form-control form-control-md" v-model="frmSearch.origen_id">
                            <option value="0">SELECCIONE</option>
                            <option v-for="r in destinos" :key="r.id" :value="r.id">{{ r.nombre }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Destino</label>
                        <select class="form-control form-control-md" v-model="frmSearch.destino_id">
                            <option value="0">SELECCIONE</option>
                            <option v-for="r in destinos" :key="r.id" :value="r.id">{{ r.nombre }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control form-control-md" v-model="frmSearch.fecha">
                    </div>
                    <div class="col-12">
                        <label for="">Punto de Venta</label>
                        <select class="form-control form-control-md" v-model="frmSearch.sucursal_id">
                            <option value="0">SELECCIONE</option>
                            <option v-for="r in sucursales" :key="r.id" :value="r.id">{{ r.nombre_comercial }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm" @click="search()"><i class="ti-reload me-1"></i>Actualizar</button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive bg-white">
                            <table id="order-listing" class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">#</th>
                                        <th class="text-center align-middle">FECHA</th>
                                        <th class="text-center align-middle">HORA</th>
                                        <th class="text-center align-middle">PAD</th>
                                        <th class="text-center align-middle">PLACA</th>
                                        <th class="text-center align-middle">RUTA</th>
                                        <th class="text-center align-middle">CAPACIDAD</th>
                                        <th class="text-center align-middle">PASAJES VEND.</th>
                                        <th class="text-center align-middle">PASAJES DISP.</th>
                                        <th class="text-center align-middle">ENCOMIENDAS</th>
                                        <th class="text-center align-middle">MANIF. PUNTOVTA</th>
                                        <th class="text-center align-middle">MANIF. PASAJ</th>
                                        <th class="text-center align-middle">MANIF. ENCOM.</th>
                                        <th class="text-center align-middle">CROQUIS</th>
                                        <th class="text-center align-middle">DETALLE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="loading">
                                        <td colspan="15" class="text-center"><i class="fa fa-circle-o-notch fa-spin me-1"></i> Cargando información</td>
                                    </tr>
                                    <tr v-if="!loading && rows.length < 1">
                                        <td colspan="15" class="text-center"><i class="fa fa-exclamation-circle me-1"></i>No se registraron ventas</td>
                                    </tr>
                                    <template v-if="!loading && rows.length > 0">
                                        <tr v-for="(row, index) in rows" :key="index">
                                            <td>{{ row.id }}</td>
                                            <td>{{ row.fecha_partida }}</td>
                                            <td>
                                                <button type="button" class="btn btn-link" @click="openModal(row)">{{ row.hora_partida }}</button>
                                            </td>
                                            <td>{{ row.bus_placa }}</td>
                                            <td>{{ row.bus_placa }}</td>
                                            <td>{{ row.origen_nombre }} - {{ row.destino_nombre }}</td>
                                            <td>{{ row.capacidad }}</td>
                                            <td>{{ row.vendidos }}</td>
                                            <td>{{ row.capacidad - row.vendidos }}</td>
                                            <td>{{ row.encomiendas }}</td>    
                                            <td><a :href="'/itinerario/'+row.id+'/reporte/manifiesto_ptoventa'"  target="_blank" class="btn btn-link">Revisar</a></td>
                                            <td><a :href="'/itinerario/'+row.id+'/reporte/manifiesto_pasajeros'"  target="_blank" class="btn btn-link">Revisar</a></td>
                                            <td><a :href="'/itinerario/'+row.id+'/reporte/manifiesto_encomiendas'"  target="_blank" class="btn btn-link">Revisar</a></td>
                                            <td><a :href="'/itinerario/'+row.id+'/reporte/croquis'"  target="_blank" class="btn btn-link">Revisar</a></td>
                                            <td><a href="javascript:void(0)" @click="openDetalleModal(row)" class="btn btn-link">Revisar</a></td>
                                        </tr>
                                    </template>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-itinerario-venta" tabindex="-1" role="dialog" aria-labelledby="ventasModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Venta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <v-venta-modal :itinerario="itinerario" :usuario="usuario" :sucursales="sucursales"></v-venta-modal>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-venta-detalle" tabindex="-1" role="dialog" aria-labelledby="ventaDetalleModal"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="form_nueva_ventas" action="javascript:void();" novalidate="novalidate">
                        <div class="modal-header p-3">
                            <h4 class="modal-title" id="ventaDetalleModal">Detalles de Viaje</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-md-6">
                                    <h5>Detalles Horas llegadas de Bus</h5>
                                    <div class="table-responsive bg-white">
                                        <table id="order-listing" class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">#</th>
                                                    <th class="text-start align-middle">Punto de V.</th>
                                                    <th class="text-center align-middle">Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>{{ itinerario.sucursal_destino_nombre }}</td>
                                                    <td class="text-center">{{ itinerario.fecha_llegada }} {{ itinerario.hora_llegada }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Ventas</h5>
                                    <div class="table-responsive bg-white">
                                        <table id="order-listing" class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">#</th>
                                                    <th class="text-start align-middle">Punto de V.</th>
                                                    <th class="text-center align-middle">Cantidad</th>
                                                    <th class="text-center align-middle">Importe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(row, index) in detalle_ptoventas">
                                                    <td  class="text-center">{{ index + 1 }}</td>
                                                    <td>{{ row.nombre_comercial }}</td>
                                                    <td class="text-center">{{ row.conteo_ventas }}</td>
                                                    <td class="text-center">{{ row.suma_ventas }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['usuario', 'sucursales'],
    data(){
        return {
            frmSearch: {
                origen_id: 0,
                destino_id: 0,
                fecha: dayjs().format('YYYY-MM-DD'),
                sucursal_id: 0
            },
            itinerario: {},
            rows: [],
            destinos: [],
            loading:false,
            modalInstance:null,
            detalle_ptoventas: []
        }
    },
    created(){
        this.obtenerDestinos();
        this.search();
    },
    methods: {
        search(){
            this.loading = true;
            axios.get("/ventas/filter", {params: this.frmSearch}).then((response)=>{
                this.rows = response.data.LISTA;
            }).finally(()=>{
                this.loading = false;
            });
        },
        obtenerDestinos(){
            axios.get('/destinos/filter').then((response)=>{
                this.destinos = response.data.LISTA;
            })
        },
        obtenerSucursales(){
            axios.get('/sucursales/filter').then((response)=>{
                this.sucursales = response.data.LISTA;
            })
        },
        async obtenerAsientos(){
            return await axios.get('/asientos/search', {params: {bus_id: this.itinerario.bus_id}});
        },
        openDetalleModal(itinerario){
            $('#modal-venta-detalle').modal('show');
            this.itinerario = {...itinerario};
            axios.get('/ventas/ptoventas', {params: {itinerario_id: itinerario.itinerario_id, empresa_id: itinerario.empresa_id}}).then(response=>{
                this.detalle_ptoventas = response.data;
            });
        },
        async openModal(itinerario){
            this.itinerario = {...itinerario};
            var el = document.getElementById("modal-itinerario-venta");
            
            if(bootstrap.Modal.getInstance(el) == null){
                this.modalInstance = new bootstrap.Modal(el, {backdrop: 'static', keyboard: false});
                el.addEventListener('hidden.bs.modal', (event)=>{
                    this.search();
                });
            } else {
                this.modalInstance = bootstrap.Modal.getInstance(el);
            }
            this.modalInstance.show();
        }
    }
}
</script>
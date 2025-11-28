<template>
    <div class="content-wrapper">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">ITINERARIOS</h3>
                <hr>
                <div class="row row-cols-lg-auto g-3 align-items-end">
                    <div class="col-12">
                        <label for="">Empresa</label>
                        <select class="form-control form-control-sm" v-model="frmSearch.empresa_id">
                            <option value="0">SELECCIONE</option>
                            <option v-for="empresa in empresas" :key="'emp_'+empresa.id" :value="empresa.id">{{ empresa.nombre_comercial }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Sucursal</label>
                        <select class="form-control form-control-sm" v-model="frmSearch.sucursal_id">
                            <option value="0">SELECCIONE</option>
                            <option v-for="row in sucursales" :key="'suc_'+row.id" :value="row.id">{{ row.nombre_comercial }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Desde</label>
                        <input type="date" class="form-control  form-control-sm" v-model="frmSearch.desde">
                    </div>
                    <div class="col-12">
                        <label for="">Hasta</label>
                        <input type="date" class="form-control  form-control-sm" v-model="frmSearch.hasta">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm" @click="search()"><i class="ti-search me-1"></i>Buscar</button>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success btn-sm" @click="openCreateModal()"><i class="ti-plus me-1"></i>Crear</button>
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
                                        <th class="text-center align-middle">EMPRESA</th>
                                        <th class="text-center align-middle">SUCURSAL</th>
                                        <th class="text-center align-middle">BUS</th>
                                        <th class="text-center align-middle">ASIENTO</th>
                                        <th class="text-center align-middle">CLIENTE</th>
                                        <th class="text-center align-middle">CHOFER</th>
                                        <th class="text-center align-middle">CHOFER 2</th>
                                        <th class="text-center align-middle">TERRAMOZA</th>
                                        <th class="text-center align-middle">FECHA SALIDA</th>
                                        <th class="text-center align-middle">FECHA LLEGADA</th>
                                        <th class="text-center align-middle">MODALIDAD</th>
                                        <th class="text-center align-middle">USUARIO</th>
                                        <th class="text-center align-middle">FECHA CREACION</th>
                                        <th class="text-center align-middle">FECHA ACTUALIZACION</th>
                                        <th class="text-center align-middle">ESTADO</th>
                                        <th class="text-center align-middle">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="loading">
                                        <td colspan="17" class="text-center"><i class="fa fa-circle-o-notch fa-spin me-1"></i> Cargando información</td>
                                    </tr>
                                    <tr v-if="!loading && rows.length < 1">
                                        <td colspan="17" class="text-center"><i class="fa fa-exclamation-circle me-1"></i>No se registraron itinerarios</td>
                                    </tr>
                                    <template v-if="!loading && rows.length > 0">
                                        <tr v-for="(row, index) in rows" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ row.empresa_id }}</td>
                                            <td>{{ row.sucursal_id }}</td>
                                            <td>{{ row.bus_id }}</td>
                                            <td>{{ row.chofer_id }}</td>
                                            <td>{{ row.chofer2_id }}</td>
                                            <td>{{ row.terramoza_id }}</td>
                                            <td>{{ row.terramoza2_id }}</td>
                                            <td>{{ row.fecha_partida }}</td>
                                            <td>{{ row.fecha_llegada }}</td>
                                            <td>{{ row.destino_id }}</td>
                                            <td>{{ row.usuario_id }}</td>

                                            <td>{{ row.sucursal_partida }}</td>
                                            <td>{{ row.sucursal_destino }}</td>
                                            <td>{{ row.created_at }}</td>
                                            <td>{{ row.updated_at }}</td>
                                            <td>
                                                <button v-if="row.estado" class='btn btn-outline-success btn-sm align-middle text-center'>Activo</button>
                                                <button v-if="!row.estado" class='btn btn-outline-danger btn-sm align-middle text-center'>Inactivo</button>
                                            </td>
                                            <td>
                                                <a v-if="row.estado == 1" href="javascript:void(0)" @click="openEditModal(row)" class="label text-primary action-edit me-1" style="text-decoration: none;"><i class="ti-pencil"></i></a>
                                                <a v-if="row.estado == 1" href="javascript:void(0)" @click="openDeleteModal(row)" class="label text-danger action-delete me-1" style="text-decoration: none;"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                    </template>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-itinerario-form" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-side modal-top-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Nueva Itinerario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-2">
                        <form id="form-crud" @submit.prevent="save">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="input-bus_id" class="col-form-label">Bus:</label>
                                    <select name="bus_id" id="input-bus_id" class="form-control form-control-sm" v-model="frmItinerario.bus_id">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in buses" :value="s.id" :key="'slcbus_' + s.id">{{ s.placa }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-chofer_id" class="col-form-label">Chofer 1:</label>
                                    <select name="chofer_id" id="input-chofer_id" class="form-control form-control-sm" v-model="frmItinerario.chofer_id" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in choferes" :value="s.id" :key="'slcuser1_' + s.id">{{ s.nombres }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-chofer2_id" class="col-form-label">Chofer 2:</label>
                                    <select name="chofer2_id" id="input-chofer2_id" class="form-control form-control-sm"  v-model="frmItinerario.chofer2_id" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in choferes" :value="s.id" :key="'slcuser2_' + s.id">{{ s.nombres }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-terramoza_id" class="col-form-label">Terramoza 1:</label>
                                    <select name="terramoza_id" id="input-terramoza_id" class="form-control form-control-sm"  v-model="frmItinerario.terramoza_id" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in choferes" :value="s.id" :key="'slcterr1_' + s.id">{{ s.nombres }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-terramoza2_id" class="col-form-label">Terramoza 2:</label>
                                    <select name="terramoza2_id" id="input-terramoza2_id" class="form-control form-control-sm"  v-model="frmItinerario.terramoza2_id" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in choferes" :value="s.id" :key="'slcterr2_' + s.id">{{ s.nombres }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-origen_id" class="col-form-label">Origen:</label>
                                    <select name="origen_id" id="input-origen_id" class="form-control form-control-sm" v-model="frmItinerario.origen_id" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in destinos" :value="s.id" :key="'slcorig_' + s.id">{{ s.nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-destino_id" class="col-form-label">Destino:</label>
                                    <select name="destino_id" id="input-destino_id" class="form-control form-control-sm" v-model="frmItinerario.destino_id" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in destinos" :value="s.id" :key="'slcdest_' + s.id">{{ s.nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_partida" class="col-form-label">Fecha partida:</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_partida" name="fecha_partida"  v-model="frmItinerario.fecha_partida" :disabled="saving">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-hora_partida" class="col-form-label">Hora partida:</label>
                                    <input type="time" class="form-control form-control-sm resetable" id="input-hora_partida" name="hora_partida"  v-model="frmItinerario.hora_partida" :disabled="saving">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_llegada" class="col-form-label">Fecha llegada:</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_llegada" name="fecha_llegada"  v-model="frmItinerario.fecha_llegada" :disabled="saving">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-hora_llegada" class="col-form-label">Hora llegada:</label>
                                    <input type="time" class="form-control form-control-sm resetable" id="input-hora_llegada" name="hora_llegada"  v-model="frmItinerario.hora_llegada" :disabled="saving">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-sucursal_partida" class="col-form-label">Sucursal Partida:</label>
                                    <select name="sucursal_partida" id="input-sucursal_partida" class="form-control form-control-sm"  v-model="frmItinerario.sucursal_partida" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in sucursales" :value="s.id" :key="'slcsuc1' + s.id">{{ s.nombre_comercial }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-sucursal_destino" class="col-form-label">Sucursal Destino:</label>
                                    <select name="sucursal_destino" id="input-sucursal_destino" class="form-control form-control-sm"  v-model="frmItinerario.sucursal_destino" :disabled="saving">
                                        <option value="0">SELECCIONE</option>
                                        <option v-for="s in sucursales" :value="s.id" :key="'slcsuc2' + s.id">{{ s.nombre_comercial }}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" form="form-crud" :disabled="saving">Guardar</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" :disabled="saving">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['empresas', 'sucursales', 'buses', 'choferes', 'destinos', 'user'],
    data(){
        return {
            frmSearch: {
                empresa_id: 0,
                sucursal_id: 0,
                desde: dayjs().subtract(1, 'day').format('YYYY-MM-DD'),
                hasta: dayjs().add(1, 'day').format('YYYY-MM-DD')
            },
            frmItinerario: {
                id: 0,
                bus_id: 0,
                chofer2_id: 0,
                chofer_id: 0,
                origen_id: 0,
                destino_id: 0,
                empresa_id: 0,
                fecha_llegada: '',
                fecha_partida: '',
                hora_partida: '',
                hora_llegada: '',
                sucursal_destino: 0,
                sucursal_partida: 0,
                terramoza2_id: 0,
                terramoza_id: 0,
            },
            rows: [],
            loading: false,
            saving: false
        }
    },
    setup() {
        
    },
    mounted(){
        this.search();

        $('#modal-itinerario-form').on('hidden.bs.modal', (event)=>{
            this.frmItinerario = {
                id: 0,
                bus_id: 0,
                chofer2_id: 0,
                chofer_id: 0,
                origen_id: 0,
                destino_id: 0,
                empresa_id: 0,
                fecha_llegada: '',
                fecha_partida: '',
                hora_partida: '',
                hora_llegada: '',
                sucursal_destino: 0,
                sucursal_partida: 0,
                terramoza2_id: 0,
                terramoza_id: 0,
            };
        });
    },
    methods: {
        search(){
            axios.get('/itinerarios/filter', {params: this.frmSearch}).then(response=>{
                this.rows = response.data.LISTA;
            })
        },
        openCreateModal(){
            $('#modal-itinerario-form').modal('show');
        },
        openDeleteModal(itinerario){
            swal({
                title: "¿Estás seguro?",
                text: "¿Deseas " + (itinerario.estado == 1 ? 'eliminar' : 'activar') +" este itinerario?",
                icon: "warning",
                buttons: ['No', 'Sí'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/itinerario/' + itinerario.id).then(response=>{
                        if(response.status){
                            toastr.success(response.data.message);
                            this.search();
                        }
                    })
                }
            });
        },
        openEditModal(itinerario){
            this.frmItinerario.id = itinerario.id;
            this.frmItinerario.bus_id = itinerario.bus_id;
            this.frmItinerario.chofer2_id = itinerario.chofer2_id;
            this.frmItinerario.chofer_id = itinerario.chofer_id;
            this.frmItinerario.origen_id = itinerario.origen_id;
            this.frmItinerario.destino_id = itinerario.destino_id;
            this.frmItinerario.empresa_id = itinerario.empresa_id;
            this.frmItinerario.fecha_llegada = itinerario.fecha_llegada;
            this.frmItinerario.fecha_partida = itinerario.fecha_partida;
            this.frmItinerario.hora_partida = itinerario.hora_partida;
            this.frmItinerario.hora_llegada = itinerario.hora_llegada;
            this.frmItinerario.sucursal_destino = itinerario.sucursal_destino;
            this.frmItinerario.sucursal_partida = itinerario.sucursal_partida;
            this.frmItinerario.terramoza2_id = itinerario.terramoza2_id;
            this.frmItinerario.terramoza_id = itinerario.terramoza_id;

            $('#modal-itinerario-form').modal('show');
        },
        save(){
            this.saving = true;
            var params = {...this.frmItinerario};

            params.usuario_id = this.user.id;
            params.empresa_id = this.user.empresa;
            params.sucursal_id = this.user.codsucursal;

            var promise = this.frmItinerario.id > 0 ? axios.put('/itinerario/' + this.frmItinerario.id, params) : axios.post('/itinerarios', params);
            promise.then(response=>{
                if(response.data.status){
                    toastr.success(response.data.message);
                    $('#modal-itinerario-form').modal('hide');
                }
                else
                    toastr.error(response.data.message);
                
                this.search();
                this.saving = false;
            }, httpErr=>{
                this.saving = false;
            })
        }
    }
}
</script>
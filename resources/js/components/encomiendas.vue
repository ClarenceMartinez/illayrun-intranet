<template>
    <div class="content-wrapper">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title">Encomiendas</h3>
                <hr>
                <div class="row row-cols-lg-auto g-3 align-items-end">
                    <div class="col-12">
                        <label for="">Punto de venta Destino</label>
                        <select class="form-control form-control-sm" v-model="frmSearch.sucursal_destino">
                            <option value="0">SELECCIONE</option>
                            <option v-for="row in sucursales" :key="'suc_'+row.id" :value="row.id">{{ row.nombre_comercial }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control  form-control-sm" v-model="frmSearch.fecha_envio">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control  form-control-sm" placeholder="Buscar por nombre, apellido, nro doc" v-model="frmSearch.keyword">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm" @click="search()"><i class="ti-search me-1"></i>Buscar</button>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success btn-sm" @click="openCreateModal()"><i class="ti-plus me-1"></i>Registrar</button>
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
                                        <th class="text-center align-middle">REMITENTE</th>
                                        <th class="text-center align-middle">CONSIGNADO</th>
                                        <th class="text-center align-middle">DESTINO</th>
                                        <th class="text-center align-middle">FECHA ENVIO</th>
                                        <th class="text-center align-middle">ITINERARIO</th>
                                        <th class="text-center align-middle">GRAVADO</th>
                                        <th class="text-center align-middle">IGV</th>
                                        <th class="text-center align-middle">TOTAL</th>
                                        <th class="text-center align-middle">ESTADO</th>
                                        <th class="text-center align-middle">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="loading">
                                        <td colspan="10" class="text-center"><i class="fa fa-circle-o-notch fa-spin me-1"></i> Cargando información</td>
                                    </tr>
                                    <tr v-if="!loading && rows.length < 1">
                                        <td colspan="10" class="text-center"><i class="fa fa-exclamation-circle me-1"></i>No se registraron encomiendas</td>
                                    </tr>
                                    <template v-if="!loading && rows.length > 0">
                                        <tr v-for="(row, index) in rows" :key="index">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <div class="fw-bold">{{ row.remitente_paternos }} {{ row.remitente_maternos }}, {{ row.remitente_nombres }}</div>
                                                <div>Doc: {{ row.remitente_tidodoc.nombre }} {{ row.remitente_numero_documento }}</div>
                                                <div>Telf: {{ row.remitente_celular }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ row.consignado_paternos }} {{ row.consignado_maternos }}, {{ row.consignado_nombres }}</div>
                                                <div>Doc: {{ row.consignado_tidodoc.nombre }} {{ row.consignado_numero_documento }}</div>
                                                <div>Telf: {{ row.consignado_celular }}</div>
                                            </td>
                                            <td>{{ row.sucursaldestino.nombre_comercial }}</td>
                                            <td class="text-center">{{ row.fecha_envio }}</td>
                                            <td class="text-start">
                                                <div>Bus: {{  row.itinerario.bus.placa }}</div>
                                                <div>Partida: {{  row.itinerario.fecha_partida | dateFormat('DD/MM/YY') }} {{ (row.itinerario.fecha_partida + ' ' + row.itinerario.hora_partida) | dateFormat('hh:mm a') }}</div>
                                                <div>Llegada: {{  row.itinerario.fecha_llegada | dateFormat('DD/MM/YY') }} {{ (row.itinerario.fecha_llegada + ' ' + row.itinerario.hora_llegada) | dateFormat('hh:mm a') }}</div>
                                            </td>
                                            <td class="text-end">{{ row.totalgravada }}</td>
                                            <td class="text-end">{{ row.totaligv }}</td>
                                            <td class="text-end">{{ row.totalventa }}</td>
                                            <td class="text-center">
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

        <div class="modal fade" id="modal-encomienda-form" tabindex="-1" role="dialog" aria-labelledby="encomiendaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form @submit.prevent="save()">
                        <div class="modal-header p-3">
                            <h5 class="modal-title" id="encomiendaModalLabel">Registrar Encomienda</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-description">Datos del Remitente</h5>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <label>Tipo Doc.</label>
                                    <select name="tipo" class="form-control form-control-sm" v-model="frmEncomienda.remitente_tipo_documento">
                                        <option value="0">Seleccione...</option>
                                        <option v-for="td in tipodocumentos" :key="'tipodocs1_'+td.id" :value="td.id">{{ td.nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Nro.</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.remitente_numero_documento" @blur="getPersonaData('remitente')">
                                </div>
                                <div class="col-lg-2">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.remitente_nombres">
                                </div>
                                <div class="col-lg-2">
                                    <label>Paterno</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.remitente_paternos">
                                </div>
                                <div class="col-lg-2">
                                    <label>Materno</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.remitente_maternos">
                                </div>
                                <div class="col-lg-2">
                                    <label>Teléfono/Celular</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.remitente_celular">
                                </div>
                            </div>
                            <h5 class="card-description">Datos del Consignado</h5>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <label>Tipo Doc.</label>
                                    <select name="tipo" class="form-control form-control-sm" v-model="frmEncomienda.consignado_tipo_documento">
                                        <option value="0">Seleccione...</option>
                                        <option v-for="td in tipodocumentos" :key="'tipodocs2_'+td.id" :value="td.id">{{ td.nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>Nro.</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.consignado_numero_documento" @blur="getPersonaData('consignado')">
                                </div>
                                <div class="col-lg-2">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.consignado_nombres">
                                </div>
                                <div class="col-lg-2">
                                    <label>Paterno</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.consignado_paternos">
                                </div>
                                <div class="col-lg-2">
                                    <label>Materno</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.consignado_maternos">
                                </div>
                                <div class="col-lg-2">
                                    <label>Teléfono/Celular</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.consignado_celular">
                                </div>
                            </div>
                            <h5 class="card-description">Datos de la Encomienda</h5>
                            <div id="" class="row mb-4">
                                <div class="col-lg-2">
                                    <label for="">Sucursal Destino</label>
                                    <select class="form-control form-control-sm" v-model="frmEncomienda.sucursal_destino" @change="obtenerItinerarios()">
                                        <option value="0">Seleccione...</option>
                                        <option v-for="s in sucursales" :key="'slcsuc_'+s.id" :value="s.id">{{ s.nombre_comercial }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Fecha de envio</label>
                                    <input type="date" class="form-control form-control-sm" v-model="frmEncomienda.fecha_envio" @change="obtenerItinerarios()">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Itinerario</label>
                                    <select class="form-control form-control-sm" v-model="frmEncomienda.itinerario_id">
                                        <option value="0">Seleccione...</option>
                                        <option v-for="s in itinerarios" :key="'slciti_'+s.id" :value="s.id">{{ s.bus.placa }} {{ s.origen.abrev }}-{{ s.destino.abrev }}: {{ s.fecha_partida | dateFormat('DD/MM/YY') }} {{ ('1970-01-01 ' +  s.hora_partida) | dateFormat('HH:mm a') }} - {{ s.fecha_llegada | dateFormat('DD/MM/YY') }} {{ ('1970-01-01 ' + s.hora_llegada) | dateFormat('hh:mm a') }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Encomienda contraseña</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.contrasenia">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2">
                                    <label for="">Forma de pago</label>
                                    <select class="form-control form-control-sm" v-model="frmEncomienda.forma_pago">
                                        <option value="0">Seleccione...</option>
                                        <option value="efectivo">Efectivo</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Comprobante</label>
                                    <select class="form-control form-control-sm" v-model="frmEncomienda.comprobante">
                                        <option value="BOLETA">Boleta</option>
                                        <option value="FACTURA">Factura</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Correlativo</label>
                                    <input type="text" class="form-control form-control-sm" v-model="frmEncomienda.correlativo" readonly>
                                </div>
                            </div>
                            <h5 class="card-description">Detalle de la Encomienda</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>Peso (Kg.)</th>
                                        <th>Precio</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(d, index) in detalle" :key="'det_' + index">
                                        <td>
                                            <input type="number" class="form-control form-control-sm" v-model="d.cantidad">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" v-model="d.descripcion">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" v-model="d.peso">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" v-model="d.precio">
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" >
                                                <button type="button" class="btn btn-success btn-sm" @click="addItem(index)"><i class="ti ti-plus"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" @click="removeItem(index)"><i class="ti ti-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">OP. GRAVADA</td>
                                        <td>{{ gravada }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">IGV</td>
                                        <td>{{ igv }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">TOTAL</td>
                                        <td>{{ total }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" id="registrarEncomienda" class="btn btn-success btn-sm">Registrar Encomienda</button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['sucursales', 'tipodocumentos', 'usuario'],
    data(){
        return {
            frmSearch: {
                sucursal_destino: 0,
                fecha_envio: dayjs().format('YYYY-MM-DD'),
                keyword: ''
            },
            frmEncomienda: {
                id: 0,
                'remitente_tipo_documento': 1, 
                'remitente_numero_documento': '', 
                'remitente_nombres': '', 
                'remitente_paternos': '', 
                'remitente_maternos': '', 
                'remitente_celular': '', 
                'consignado_tipo_documento': 1, 
                'consignado_numero_documento': '', 
                'consignado_nombres': '', 
                'consignado_paternos': '', 
                'consignado_maternos': '', 
                'consignado_celular': '', 
                'sucursal_destino': 0, 
                'itinerario_id': 0,
                'contrasenia': '', 
                'fecha_envio': dayjs().format('YYYY-MM-DD'), 
                'forma_pago': 'efectivo', 
                'comprobante': 'BOLETA', 
                'correlativo': 'B001-0000001'
            },
            detalleTpl: {
                id: 0,
                cantidad: 0,
                descripcion: '',
                peso: 0,
                precio: 0
            },
            trashItems: [],
            detalle: [],
            rows: [],
            itinerarios: [],
            loading: false,
            saving: false
        }
    },
    mounted(){
        this.search();

        $('#modal-encomienda-form').on('hidden.bs.modal', (event)=>{
            this.frmEncomienda = {
                id: 0,
                'remitente_tipo_documento': 1, 
                'remitente_numero_documento': '', 
                'remitente_nombres': '', 
                'remitente_paternos': '', 
                'remitente_maternos': '', 
                'remitente_celular': '', 
                'consignado_tipo_documento': 1, 
                'consignado_numero_documento': '', 
                'consignado_nombres': '', 
                'consignado_paternos': '', 
                'consignado_maternos': '', 
                'consignado_celular': '', 
                'sucursal_destino': 0, 
                'itinerario_id': 0, 
                'contrasenia': '', 
                'fecha_envio': dayjs().format('YYYY-MM-DD'), 
                'forma_pago': 'efectivo', 
                'comprobante': 'BOLETA', 
                'correlativo': ''
            };
        });
    },
    computed: {
        gravada(){
            return (this.total - this.igv).toFixed(2);
        },
        igv(){
            return (this.total * 0.18).toFixed(2)
        },
        total(){
            return this.detalle.reduce((acu, item) => acu + Number(item.precio), 0).toFixed(2);
        }
    },
    filters: {
        dateFormat: function(value, format){
            return dayjs(value).format(format);
        }
    },
    methods: {
        addItem(index){
            this.detalle.splice(index+1, 0, {...this.detalleTpl});
        },
        removeItem(index){
            let item = this.detalle[index];
            if(item.id > 0)
                this.trashItems.push(item);

            this.detalle.splice(index, 1);
        },
        search(){
            this.loading = true;
            axios.get('/encomiendas/filter', {params: this.frmSearch}).then(response=>{
                if(response.data.status)
                    this.rows = response.data.data;
                else
                    toastr.error(response.data.message);
                //this.rows = response.data.LISTA.data;
            }).finally(()=>{
                this.loading = false;
            })
        },
        obtenerItinerarios(){
            if(this.frmEncomienda.sucursal_destino > 0 && this.frmEncomienda.fecha_envio !== ''){
                axios.get('/itinerarios/filter', {params: {empresa_id: this.usuario.empresa, sucursal_partida: this.usuario.codsucursal, sucursal_destino: this.frmEncomienda.sucursal_destino, desde: this.frmEncomienda.fecha_envio}}).then(response=>{
                    this.itinerarios = response.data.LISTA;
                });
            }
        },
        openCreateModal(){
            this.detalle = [{...this.detalleTpl}];
            $('#modal-encomienda-form').modal('show');
        },
        openDeleteModal(encomienda){
            swal({
                title: "¿Estás seguro?",
                text: "¿Deseas " + (encomienda.estado == 1 ? 'eliminar' : 'activar') +" esta encomienda?",
                icon: "warning",
                buttons: ['No', 'Sí'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/encomienda/' + encomienda.id).then(response=>{
                        if(response.status){
                            toastr.success(response.data.message);
                            this.search();
                        }
                    })
                }
            });
        },
        openEditModal(encomienda){
            this.frmEncomienda = {
                'id': encomienda.id,
                'remitente_tipo_documento': encomienda.remitente_tipo_documento, 
                'remitente_numero_documento': encomienda.remitente_numero_documento, 
                'remitente_nombres': encomienda.remitente_nombres, 
                'remitente_paternos': encomienda.remitente_paternos, 
                'remitente_maternos': encomienda.remitente_maternos, 
                'remitente_celular': encomienda.remitente_celular, 
                'consignado_tipo_documento': encomienda.consignado_tipo_documento,
                'consignado_numero_documento': encomienda.consignado_numero_documento,
                'consignado_nombres': encomienda.consignado_nombres,
                'consignado_paternos': encomienda.consignado_paternos,
                'consignado_maternos': encomienda.consignado_maternos,
                'consignado_celular': encomienda.consignado_celular,
                'sucursal_destino': encomienda.sucursal_destino, 
                'itinerario_id': encomienda.itinerario_id, 
                'contrasenia': encomienda.contrasenia, 
                'fecha_envio': encomienda.fecha_envio, 
                'forma_pago': encomienda.forma_pago, 
                'comprobante': encomienda.comprobante, 
                'correlativo': encomienda.correlativo
            }

            this.detalle = [...encomienda.detalle];

            $('#modal-encomienda-form').modal('show');
        },
        save(){
            this.saving = true;
            let params = {...this.frmEncomienda};

            params.empresa_id = this.usuario.empresa;
            params.sucursal_id = this.usuario.codsucursal;
            params.detalle = [...this.detalle];
            params.trashItems = [...this.trashItems.map(i=>i.id)];

            var promise = this.frmEncomienda.id > 0 ? axios.put('/encomienda/' + this.frmEncomienda.id, params) : axios.post('/encomiendas', params);
            promise.then(response=>{
                if(response.data.status){
                    toastr.success(response.data.message);
                    $('#modal-encomienda-form').modal('hide');
                }
                else
                    toastr.error(response.data.message);
                
                this.search();
                this.saving = false;
            }, httpErr=>{
                this.saving = false;
            })
        },
        getPersonaData(prefix){
            if(this.frmEncomienda[prefix+'_tipo_documento'] == 1){
                axios.post('/reniec/consulta?numero=' + this.frmEncomienda[prefix+'_numero_documento']).then(response=>{
                    if(response.data.status){
                        this.frmEncomienda[prefix+'_nombres'] = response.data.data.nombres;
                        this.frmEncomienda[prefix+'_paternos'] = response.data.data.apellidoPaterno;
                        this.frmEncomienda[prefix+'_maternos'] = response.data.data.apellidoMaterno;
                    }
                });
            }
        }
    }
}
</script>
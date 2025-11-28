<template>
    <div class="content-wrapper">
        <div class="card shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title float-start mb-0">BUSES</h5>
                <div class="float-end">
                    <button class="text-white btn btn-success btn-sm" @click="openCreateModal()"><i class="ti-plus me-1"></i> BUS</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive bg-white">
                        <table id="order-listing" class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">EMPRESA</th>
                                    <th class="text-center align-middle">USUARIO</th>
                                    <th class="text-center align-middle">TARJETA UNICA DE <br>CIRCULACION VEHICULAR<br>(TUC)</th>
                                    <th class="text-center align-middle">FECHA EMISION <br> (TUC)</th>
                                    <th class="text-center align-middle">FECHA VENCIMIENTO   <br>(TUC)</th>
                                    <th class="text-center align-middle">CENTRO DE INSPECCION<br> TECNICA VEHICULAR  <br>(CITV)</th>
                                    <th class="text-center align-middle">FECHA ULTIMA  <br>(CITV)</th>
                                    <th class="text-center align-middle">SOAT</th>
                                    <th class="text-center align-middle">FECHA EMISION <br>SOAT</th>
                                    <th class="text-center align-middle">FECHA VENCIMIENTO   <br>SOAT</th>
                                    <th class="text-center align-middle">TARJETA DE PROPIEDAD</th>
                                    <th class="text-center align-middle">TARJETA DE IDENTIFICACION  <br> VEHICULAR ELECTRONICA  <br> (TIVe)</th>
                                    <th class="text-center align-middle">TARJETA DE IDENTIFICACION  <br> VEHICULAR FISICA  <br> (TIV)</th>
                                    <th class="text-center align-middle">FECHA EMISION <br>(TIVe)</th>
                                    <th class="text-center align-middle">FECHA VENCIMIENTO   <br>(TIV)</th>
                                    <th class="text-center align-middle">MARCA</th>
                                    <th class="text-center align-middle">PLACA</th>
                                    <th class="text-center align-middle">CARROCERIA ORIGINAL</th>
                                    <th class="text-center align-middle">CATEGORIA</th>
                                    <th class="text-center align-middle">FECHA CREACION</th>
                                    <th class="text-center align-middle">FECHA ACTUALIZACION</th>
                                    <th class="text-center align-middle">ESTADO</th>
                                    <th class="text-center align-middle">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading">
                                    <td colspan="10" class="text-center"><i class="fa fa-circle-o-notch fa-spin me-1"></i> Cargando información</td>
                                </tr>
                                <tr v-if="!loading && rows.length < 1">
                                    <td colspan="10" class="text-center"><i class="fa fa-exclamation-circle me-1"></i>No se registraron buses</td>
                                </tr>
                                <template v-if="!loading && rows.length > 0">
                                    <tr v-for="(row, index) in rows" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ row.empresa_id }}</td>
                                        <td>{{ row.usuario }}</td>
                                        <td>{{ row.tuc }}</td>
                                        <td>{{ row.fecha_emision_tuc }}</td>
                                        <td>{{ row.fecha_vencimiento_tuc }}</td>
                                        <td>{{ row.citv }}</td>
                                        <td>{{ row.ultimo_citv }}</td>
                                        <td>{{ row.soat }}</td>
                                        <td>{{ row.fecha_emision_soat }}</td>
                                        <td>{{ row.fecha_vencimiento_soat }}</td>
                                        <td>{{ row.tarjeta_propiedad }}</td>
                                        <td>{{ row.tiv_fisico }}</td>
                                        <td>{{ row.tiv_electronica }}</td>
                                        <td>{{ row.fecha_emision_tiv }}</td>
                                        <td>{{ row.fecha_vencimiento_tiv }}</td>
                                        <td>{{ row.marca }}</td>
                                        <td>{{ row.placa }}</td>
                                        <td>{{ row.carroceria_original }}</td>
                                        <td>{{ row.categoria }}</td>
                                        <td>{{ row.created_at }}</td>
                                        <td>{{ row.updated_at }}</td>
                                        <td class="text-center">
                                            <button v-if="row.estado" class='btn btn-outline-success btn-sm align-middle text-center'>Activo</button>
                                            <button v-if="!row.estado" class='btn btn-outline-danger btn-sm align-middle text-center'>Inactivo</button>
                                        </td>
                                        <td>
                                            <a v-if="row.estado == 1" href="javascript:void(0)" @click="openEditModal(row)" class="label text-primary me-1" style="text-decoration: none;"><i class="ti-pencil"></i></a>
                                            <a v-if="row.estado == 1" href="javascript:void(0)" @click="openDeleteModal(row)" class="label text-danger me-1" style="text-decoration: none;"><i class="ti-close"></i></a>
                                            <a v-if="row.estado == 1" href="javascript:void(0)" @click="openAsientoModal(row)" class="label text-success me-1" style="text-decoration: none;"><i class="ti-user"></i></a>
                                        </td>
                                    </tr>
                                </template>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-bus-form" tabindex="-1" role="dialog" aria-labelledby="busModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form @submit.prevent="save()">
                        <input type="hidden" name="usuario" :value="usuario">   
                        <div class="modal-header p-3">
                            <h5 class="modal-title" id="busModalLabel">Registrar Bus</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body py-2">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="input-empresa_id" class="col-form-label">EMPRESA:</label>
                                    <select class="form-control form-control-sm resetable" id="input-empresa_id" name="empresa_id" v-model="frmBus.empresa_id">
                                        <option :value="0">Seleccionar &rarr;</option>
                                        <option v-for="(emp,i) in empresas" :key="'emp_'+i" :value="emp.id">{{ emp.nombre_comercial }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-carroceria_original" class="col-form-label">CARROCERIA ORIGINAL:</label>
                                    <select class="form-control form-control-sm resetable" id="input-carroceria_original" name="carroceria_original" v-model="frmBus.carroceria_original">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">                                    
                                    <label for="input-categoria" class="col-form-label">CATEGORIA:</label>
                                    <input type="text" class="form-control form-control-sm resetable" id="input-categoria" name="categoria" v-model="frmBus.categoria">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-tuc" class="col-form-label">TARJETA UNICA DE CIRCULACION VEHICULAR (TUC):</label>
                                    <select class="form-control form-control-sm resetable" id="input-tuc" name="tuc" v-model="frmBus.tuc">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-citv" class="col-form-label">CENTRO DE INSPECCION TECNICA VEHICULAR (CITV):</label>
                                    <select class="form-control form-control-sm resetable" id="input-citv" name="citv" v-model="frmBus.citv">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_vencimiento_tuc" class="col-form-label">FECHA VENCIMIENTO (TUC):</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_vencimiento_tuc" name="fecha_vencimiento_tuc" v-model="frmBus.fecha_vencimiento_tuc">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_emision_tuc" class="col-form-label">FECHA EMISION (TUC):</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_emision_tuc" name="fecha_emision_tuc" v-model="frmBus.fecha_emision_tuc">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-soat" class="col-form-label">SOAT:</label>
                                    <select class="form-control form-control-sm resetable" id="input-soat" name="soat" v-model="frmBus.soat">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-ultimo_citv" class="col-form-label">FECHA ULTIMA (CITV):</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-ultimo_citv" name="ultimo_citv" v-model="frmBus.ultimo_citv">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_vencimiento_soat" class="col-form-label">FECHA VENCIMIENTO SOAT:</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_vencimiento_soat" name="fecha_vencimiento_soat" v-model="frmBus.fecha_vencimiento_soat">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-tarjeta_propiedad" class="col-form-label">TARJETA DE PROPIEDAD:</label>
                                    <select class="form-control form-control-sm resetable" id="input-tarjeta_propiedad" name="tarjeta_propiedad" v-model="frmBus.tarjeta_propiedad">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-tiv_electronica" class="col-form-label">TARJETA DE IDENTIFICACION VEHICULAR ELECTRONICA (TIVe):</label>
                                    <select class="form-control form-control-sm resetable" id="input-tiv_electronica" name="tiv_electronica" v-model="frmBus.tiv_electronica">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-tiv_fisico" class="col-form-label">TARJETA DE IDENTIFICACION VEHICULAR FISICA (TIV):</label>
                                    <select class="form-control form-control-sm resetable" id="input-tiv_fisico" name="tiv_fisico" v-model="frmBus.tiv_fisico">
                                        <option value="">Seleccionar &rarr;</option>
                                        <option value="yes">si</option>
                                        <option value="no">no</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_emision_tiv" class="col-form-label">FECHA EMISION (TIVe):</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_emision_tiv" name="fecha_emision_tiv" v-model="frmBus.fecha_emision_tiv">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_vencimiento_tiv" class="col-form-label">FECHA VENCIMIENTO (TIV):</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_vencimiento_tiv" name="fecha_vencimiento_tiv" v-model="frmBus.fecha_vencimiento_tiv">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-marca" class="col-form-label">MARCA:</label>
                                    <input type="text" class="form-control form-control-sm resetable" id="input-marca" name="marca" v-model="frmBus.marca">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-placa" class="col-form-label">PLACA:</label>
                                    <input type="text" class="form-control form-control-sm resetable" id="input-placa" name="placa" v-model="frmBus.placa">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-pad" class="col-form-label">PAD:</label>
                                    <input type="text" class="form-control form-control-sm resetable" id="input-pad" name="pad" v-model="frmBus.pad">
                                </div>
                                <div class="col-lg-3">
                                    <label for="input-fecha_emision_soat" class="col-form-label">FECHA EMISION SOAT:</label>
                                    <input type="date" class="form-control form-control-sm resetable" id="input-fecha_emision_soat" name="fecha_emision_soat" v-model="frmBus.fecha_emision_soat">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="">Caracteristicas</label>
                                    <div>
                                        <div class="form-check form-check-inline" v-for="c in frmBus.caracteristicas" :key="'carac_' + c.id">
                                            <input class="form-check-input" type="checkbox" :id="'carac_' + c.id" v-model="c.checked">
                                            <label class="form-check-label" :for="'carac_' + c.id">{{ c.nombre }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" id="registrarBus" class="btn btn-success btn-sm">Registrar Bus</button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-asiento-form" tabindex="-1" role="dialog" aria-labelledby="asientoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form @submit.prevent="saveAsientos()">
                        <div class="modal-header p-3">
                            <h5 class="modal-title" id="asientoModalLabel">Registrar Asientos</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body py-2">
                            <div class="row">
                                <div class="col-lg-4">
                                    <v-bus :asientos="asientos"></v-bus>
                                </div>
                                <div class="col-lg-8">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Número</th>
                                                <th>Fila</th>
                                                <th>Columna</th>
                                                <th>Piso</th>
                                                <th>Estado</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(a, index) in asientos" :key="'asiento_'+index">
                                                <td class="py-1" style="width: 16.66%;">
                                                    <input type="number" class="form-control form-control-sm" v-model="a.numero">
                                                </td>
                                                <td class="py-1" style="width: 16.66%;">
                                                    <select class="form-control form-control-sm" v-model="a.fila">
                                                        <option v-for="n in 13" :value="n - 1">Fila {{ n }}</option>
                                                    </select>
                                                </td>
                                                <td class="py-1" style="width: 16.66%;">
                                                    <select class="form-control form-control-sm" v-model="a.columna">
                                                        <option :value="0">Columna 1</option>
                                                        <option :value="1">Columna 2</option>
                                                        <option :value="3">Columna 4</option>
                                                        <option :value="4">Columna 5</option>
                                                    </select>
                                                </td>
                                                <td class="py-1" style="width: 16.66%;">
                                                    <select class="form-control form-control-sm" v-model="a.piso">
                                                        <option :value="0">Piso 1</option>
                                                        <option :value="1">Piso 2</option>
                                                    </select>
                                                </td>
                                                <td class="py-1 text-center">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" :id="'astatus_'+index"   true-value="1" false-value="0" v-model="a.estado">
                                                        <label class="form-check-label" :for="'astatus_'+index">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td class="py-1">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-success btn-sm text-white" @click="addAsiento(index)"><i class="ti-plus"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm text-white" @click="removeAsiento(index)"><i class="ti-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p-3">
                            <button type="submit" id="registrarBus" class="btn btn-success btn-sm">Registrar Asientos</button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="display: none">Build By KbaylonH</div>
    </div>
</template>
<script>
export default {
    props: ['empresas', 'sucursales', 'buses', 'choferes', 'destinos', 'caracteristicas_base', 'usuario'],
    data(){
        return {
            frmSearch: {
                sucursal_destino: 0,
                fecha_envio: '',
                keyword: ''
            },
            frmBus: {
                id: 0,
                empresa_id: 0,
                tuc: '',
                fecha_emision_tuc: '',
                fecha_vencimiento_tuc: '',
                citv: '',
                ultimo_citv: '',
                soat: '',
                fecha_emision_soat: '',
                fecha_vencimiento_soat: '',
                tarjeta_propiedad: '',
                tiv_fisico: '',
                tiv_electronica: '',
                fecha_emision_tiv: '',
                fecha_vencimiento_tiv: '',
                marca: '',
                placa: '',
                carroceria_original: '',
                categoria: '',
                pad: '',
                caracteristicas: []
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
            loading: false,
            saving: false,
            asientos: [],
            selectedBus: null,
            removedPots: []
        }
    },
    mounted(){
        this.search();
        $('#modal-bus-form').on('hidden.bs.modal', (event)=>{
            this.frmBus = {
                id: 0,
                empresa_id: '',
                tuc: '',
                fecha_emision_tuc: '',
                fecha_vencimiento_tuc: '',
                citv: '',
                ultimo_citv: '',
                soat: '',
                fecha_emision_soat: '',
                fecha_vencimiento_soat: '',
                tarjeta_propiedad: '',
                tiv_fisico: '',
                tiv_electronica: '',
                fecha_emision_tiv: '',
                fecha_vencimiento_tiv: '',
                marca: '',
                placa: '',
                carroceria_original: '',
                categoria: '',
                pad: '',
                caracteristicas: []
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
    methods: {
        handleChange(newVal){
            this.estructurar([...this.asientos]);
        },
        addItem(index){
            this.detalle.splice(index+1, 0, {...this.detalleTpl});
        },
        removeItem(index){
            let item = this.detalle[index];
            if(item.id > 0)
                this.trashItems.push(item);

            this.detalle.splice(index, 1);
        },
        addAsiento(index){
            this.asientos.splice(index + 1, 0, {id:0, fila:0, columna: 0, piso:1, numero: 99, estado: 1});
        },
        removeAsiento(index){
            if(this.asientos[index]?.id > 0)
                this.removedPots.push( this.asientos[index].id );
            
            this.asientos.splice(index, 1);
        },
        search(){
            this.loading = true;
            axios.get('/buses/filter', {params: this.frmSearch}).then(response=>{
                this.rows = response.data.LISTA.map(item=>{
                    var c = item.caracteristicas;
                    var nc = this.caracteristicas_base.map(i=>{
                        return {id: i.id, nombre: i.nombre_caracteristica, checked: c.find(j=>j.id_caracteristicas_base==i.id) !== undefined };
                    });
                    item.caracteristicas = nc;
                    return item;
                });

            }).finally(()=>{
                this.loading = false;
            })
        },
        openAsientoModal(bus){
            if(bus.asientos.length < 1)
                bus.asientos.push({id:0,fila:0,columna:0,piso:0,numero:1});

            this.selectedBus = {...bus};
            this.asientos = [...bus.asientos];
            $('#modal-asiento-form').modal('show');
        },
        openCreateModal(){
            this.frmBus.caracteristicas = this.caracteristicas_base.map(i=>{
                return {id: i.id, nombre: i.nombre_caracteristica, checked: false};
            });
            $('#modal-bus-form').modal('show');
        },
        openDeleteModal(bus){
            swal({
                title: "¿Estás seguro?",
                text: "¿Deseas " + (bus.estado == 1 ? 'eliminar' : 'activar') +" este bus?",
                icon: "warning",
                buttons: ['No', 'Sí'],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/bus/' + bus.id).then(response=>{
                        if(response.status){
                            toastr.success(response.data.message);
                            this.search();
                        }
                    })
                }
            });
        },
        openEditModal(bus){
            this.frmBus = {
                id: bus.id,
                empresa_id: bus.empresa_id,
                tuc: bus.tuc,
                fecha_emision_tuc: bus.fecha_emision_tuc,
                fecha_vencimiento_tuc: bus.fecha_vencimiento_tuc,
                citv: bus.citv,
                ultimo_citv: bus.ultimo_citv,
                soat: bus.soat,
                fecha_emision_soat: bus.fecha_emision_soat,
                fecha_vencimiento_soat: bus.fecha_vencimiento_soat,
                tarjeta_propiedad: bus.tarjeta_propiedad,
                tiv_fisico: bus.tiv_fisico,
                tiv_electronica: bus.tiv_electronica,
                fecha_emision_tiv: bus.fecha_emision_tiv,
                fecha_vencimiento_tiv: bus.fecha_vencimiento_tiv,
                marca: bus.marca,
                placa: bus.placa,
                carroceria_original: bus.carroceria_original,
                categoria: bus.categoria,
                pad: bus.pad,
                caracteristicas: bus.caracteristicas
            }

            $('#modal-bus-form').modal('show');
        },
        save(){
            this.saving = true;
            let params = {...this.frmBus};
            params.caracteristicas = params.caracteristicas.filter(i=>i.checked);
            var promise = this.frmBus.id > 0 ? axios.put('/bus/' + this.frmBus.id, params) : axios.post('/buses', params);
            promise.then(response=>{
                if(response.data.status){
                    toastr.success(response.data.message);
                    $('#modal-bus-form').modal('hide');
                }
                else
                    toastr.error(response.data.message);
                
                this.search();
                this.saving = false;
            }, httpErr=>{
                this.saving = false;
            })
        },
        saveAsientos(){
            axios.post('/bus/' + this.selectedBus.id + '/asientos', {asientos: this.asientos, removedPots: this.removedPots}).then(response=>{
                if(response.data.status){
                    this.removedPots = [];
                    toastr.success(response.data.message);
                    this.search();
                } else {
                    toastr.error(response.data.message);
                }
            });
        }
    }
}
</script>
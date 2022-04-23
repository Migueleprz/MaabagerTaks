<template>
    <div class="row justify-content-center mb-2">
        <div class="col-sm-12 col-md-6">
            <h3>Task Manager</h3>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-4">

                    <button
                            class="btn btn-outline-secondary w-100 mb-1"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDependecia"
                    >
                        Nueva dependencia
                    </button>

                </div>
                <div class="col-sm-12 col-md-4">
                    <button
                            class="btn btn-outline-secondary w-100 mb-1"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTrabajador"
                    >Nuevo trabajador</button>
                </div>
                <div class="col-sm-12 col-md-3">
                    <button
                            class="btn btn-outline-secondary w-100 mb-1"
                            data-bs-toggle="modal"
                            data-bs-target="#modalTarea"
                    >Nueva tarea</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <button class="btn btn-outline-secondary w-100 mb-1" @click="setStatus('pendiente')">Pendiente</button>
                        <button class="btn btn-outline-secondary w-100 mb-1" @click="setStatus('cumplida')" >Completas</button>
                        <button class="btn btn-outline-secondary w-100" @click="setStatus('no cumplida')">Incompletas</button>
                    </div>
                    <div class=" col-sm-12 col-md-10">
                        <div class="card">
                            <div class="row m-5">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card mb-3" v-for="item in tareas.data" :key="item.id">
                                        <div class="card-header">
                                            {{ item.title }} - {{ item.name +' '+item.surname }}
                                            <CambiarEstadoComponent :id-tarea="item.id" />
                                        </div>
                                        <div class="card-body">
                                            {{ item.description }}
                                        </div>
                                        <div class="card-footer bg-white border-0 text-end">
                                            {{ item.delivery_date }}
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-sm-5">
                                            <pagination :data="tareas" @pagination-change-page="getResults">
                                                <template #prev-nav>
                                                    <span><i class="bi bi-skip-backward-fill"></i>  </span>
                                                </template>
                                                <template #next-nav>
                                                    <span><i class="bi bi-skip-forward-fill"></i> </span>
                                                </template>
                                            </pagination>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <modal-component id="modalDependecia">
        <template #titulo>Nueva Dependencia</template>
        <template #formulario>
            <DependenciaFormComponent />
        </template>
    </modal-component>
    <modal-component id="modalTrabajador">
        <template #titulo>Nuevo Trabajador</template>
        <template #formulario>
            <TrabajadorFormComponen />
        </template>
    </modal-component>
    <modal-component id="modalTarea">
        <template #titulo>Nueva Tarea</template>
        <template #formulario>
            <TareaFormComponen />
        </template>
    </modal-component>

</template>

<script lang="js">
    import CardComponent from "@/components/Card";
    import ModalComponent from "@/components/Modal";
    import DependenciaFormComponent from "@/components/Forms/DependenciaForm";
    import TrabajadorFormComponen from "@/components/Forms/TrabajadorForm";
    import TareaFormComponen from "@/components/Forms/TareaForm";
    import axios from "axios";
    import LaravelVuePagination from 'laravel-vue-pagination';
    import CambiarEstadoComponent from "@/components/Forms/CambiarEstado";

    export default {
        name: "Tareas-component",
        components: {
            CambiarEstadoComponent,
            TareaFormComponen,
            TrabajadorFormComponen,
            DependenciaFormComponent,
            ModalComponent,
            'Pagination': LaravelVuePagination
        },
        mounted() {
            this.getResults();
            this.setStatus('pendiente');
        },
        data(){
            return{
                token: sessionStorage.getItem('token'),
                url: 'http://127.0.0.1:8000/api/',
                tareas: {},
                idTarea:0,
                status:'pendiente'
            }
        },
        methods:{
            async getResults(page = 1) {
              await axios.get(`${this.url}tareas/${this.status}?page=${page}`,{headers: {'Authorization': `${this.token}`}})
                    .then(response => {
                        this.tareas = response.data;
                    });
            },
            setStatus(status) {
               this.status = status;
               this.getResults()
            }
        },


    }
</script>
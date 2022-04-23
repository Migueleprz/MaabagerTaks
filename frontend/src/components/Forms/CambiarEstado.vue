<template>
    <button
            class="btn btn-outline-secondary
            float-end"
            data-bs-toggle="modal"
            data-bs-target="#modalCambiarEstado"
    >
        Cambiar estado
    </button>
    <modal-component id="modalCambiarEstado">
        <template #titulo>Cambiar Estado</template>
        <template #formulario>
            <form>
                <div class="mb-3 row">
                    <label for="observation" class="col-sm-3 label-form">Observasión {{idTarea}}</label>
                    <div class="col-sm-9">
                        <textarea
                                class="form-control"
                                name="observation"
                                id="observation"
                                rows="10"
                        ></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="observation_date" class="col-sm-3 label-form">Fecha Observasión</label>
                    <div class="col-sm-9">
                        <input
                                type="datetime-local"
                                class="form-control"
                                name="observation_date"
                                id="observation_date"
                                rows="10"
                        />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="status" class="col-sm-3 label-form">Estado</label>
                    <div class="col-sm-9">
                        <select
                                class="form-control"
                                name="status"
                                id="status"
                        >
                            <option value="pendiente">Pendiente</option>
                            <option value="no cumplida">No Cumplida</option>
                            <option value="cumplida">Cumplida</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-2">
                        <button class="btn btn-primary w-100 float-end" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
        </template>
    </modal-component>

</template>

<script lang="js">
    import ModalComponent from "@/components/Modal";
    export default {
        name: "CambiarEstado-component",
        components: {ModalComponent},
        data(){
            return{

            }
        },
        props:{
            idTarea: Number
        }
    }
</script>

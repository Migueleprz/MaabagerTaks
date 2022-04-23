<template>
    <div class="card mb-3">
        <div class="card-header">
            <slot name="titulo"></slot>
            <button
                    class="btn btn-outline-secondary float-end"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCambiarEstado"
            >
                <slot name="accion"></slot>

            </button>
        </div>
        <div class="card-body">
            <p class="card-text"><slot name="descripcion"></slot></p>
            <p class="text-end"><slot name="fecha"></slot></p>
        </div>
    </div>

</template>

<script lang="js">
    export default {
        name: "Card-component",
        data(){
            return{

            }
        },
        props: {
            idTarea: Number
        }
    }
</script>

<style scoped>

</style>
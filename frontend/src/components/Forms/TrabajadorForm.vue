<template>
    <form
            autocomplete="off"
            id="form"
            @submit.prevent="submit"
    >
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombres</label>
                    <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Nombres"
                            v-model="trabajador.name"
                    >
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Apellidos</label>
                    <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                            placeholder="Apellidos"
                            v-model="trabajador.surname"
                    >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="dni" class="form-label">Número de identificación</label>
                    <input
                            type="text"
                            class="form-control"
                            id="dni"
                            placeholder="Dni"
                            v-model="trabajador.dni"
                    >
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="dependency" class="form-label">Dependencia</label>
                    <select name="dependency" id="dependency" class="form-control" v-model="trabajador.dependency">
                        <option v-for="item in dependencies" :key="item.id" :value="item.id">{{ item.name }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <button class="btn btn-primary w-100" type="submit">Guardar</button>
            </div>
        </div>


    </form>

</template>

<script lang="js">
    //2da forma de hacer un crud
    import axios from "axios";
    import Swal from 'sweetalert2'

    export default {
        name: "TrabajadorForm-componen",
        async created() {
            await this.getDependencies();
        },
        data() {
            return {
                token: sessionStorage.getItem('token'),
                url: 'http://127.0.0.1:8000/api/',
                dependencies: [],
                trabajador: {
                    name: '',
                    surname: '',
                    dni: '',
                    dependency: 1
                }
            }
        },
        methods: {
            async getDependencies() {
                const resp = await axios.get(
                    `${this.url}dependencia`,
                    {headers: {'Authorization': `${this.token}`}}
                );
                this.dependencies = resp.data;
            },

            async submit() {
                await axios.post(
                    `${this.url}trabajador`, this.trabajador,
                    {headers: {'Authorization': `${this.token}`}}
                )
                    .then(resp => {
                        this.limpiar();
                        Swal.fire({
                            icon: 'success',
                            text: resp.data.name + ' ' + resp.data.surname + ' registrado correctamente'
                        });
                    })
                    .catch(err => {
                        let arr = err.response.data.error;
                        if (Object.prototype.hasOwnProperty.call(arr,'name')) {
                            Swal.fire({
                                icon: 'error',
                                text: err.response.data.error.name
                            });
                        }
                        if (Object.prototype.hasOwnProperty.call(arr,'surname')) {
                            Swal.fire({
                                icon: 'error',
                                text: err.response.data.error.surname
                            });
                        }
                        if (Object.prototype.hasOwnProperty.call(arr,'dni')) {
                            Swal.fire({
                                icon: 'error',
                                text: err.response.data.error.dni
                            });
                        }
                    });


            },

            limpiar() {
                this.trabajador = {
                    name: '',
                    surname: '',
                    dni: '',
                    dependency: 1
                }
            }

        }

    }
</script>

<style scoped>

</style>
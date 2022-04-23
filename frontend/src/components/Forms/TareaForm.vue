<template>
    <form
            id="form"
            autocomplete="off"
            @submit.prevent="submit"

    >
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="mb-3  row">
                    <label for="title" class="col-sm-3 col-form-label">Titulo</label>
                    <div class="col-sm-9">
                        <input
                                type="text"
                                class="form-control"
                                id="title"
                                placeholder="Titulo"
                                v-model="tarea.title"
                        >
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="mb-3 row">
                    <label for="description" class="col-sm-3 col-form-label">Descripción</label>
                    <div class="col-sm-9">
                        <textarea
                                class="form-control"
                                id="description"
                                rows="10"
                                v-model="tarea.description"
                        ></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="mb-3 row">
                    <label for="fecha" class="col-sm-3 col-form-label">Fecha de entrega</label>
                    <div class="col-sm-9">
                        <input
                                type="date"
                                class="form-control"
                                id="fecha"
                                maxlength="500"
                                required
                                v-model="tarea.delivery_date"

                        >
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="mb-3 row">
                    <label for="trabajadorId" class="col-sm-3 col-form-label">Trabajador</label>
                    <div class="col-sm-9">
                        <select
                                name="trabajadorId"
                                id="trabajadorId"
                                class="form-control"
                                v-model="tarea.trabajadorId"
                        >
                            <option v-for="item in trabajadores" :key="item.id" :value="item.id">{{ item.name + ' ' + item.surname }}</option>
                        </select>
                    </div>

                </div>



            </div>
            <div class="col-sm-12 col-md-12">
                <button class="btn btn-primary float-end" type="submit">Guardar</button>
            </div>
        </div>

    </form>
</template>

<script lang="js">
    import axios from "axios";
    import Swal from 'sweetalert2'

    export default {
        name: "TareaForm-componen",
        created(){
            this.getTareas();
            this.getTrabajadores();
        },
        data(){
            return{
                token: sessionStorage.getItem('token'),
                url: 'http://127.0.0.1:8000/api/',
                trabajadores: [],
                tarea: {
                    trabajadorId: 1,
                    title: '',
                    description: '',
                    delivery_date: ''
                }
            }
        },
        methods:{
            async getTrabajadores() {
             await axios.get(
                    `${this.url}trabajador`,
                    {headers: {'Authorization': `${this.token}`}}
                ).then(resp=>{
                 this.trabajadores = resp.data
             });
            },
            async getTareas() {
                let x;
            },
            async submit() {
                await axios.post(
                    `${this.url}tarea`,this.tarea,
                    {headers: {'Authorization': `${this.token}`}}
                )
                    .then(res=>{
                        console.log(res.data)
                        this.limpiar();
                        Swal.fire({
                            icon:'success',
                            text:'La tarea '+res.data.tarea.title+' fue asignada a '+ res.data.trabajador.name + ' '+res.data.trabajador.surname
                        })
                    })
                    .catch(err=>{
                        let message= '';
                       message = err.response.data.message;
                       if(message)
                       {
                           Swal.fire({
                               icon:'error',
                               text:message
                           })
                       }
                       let error = err.response.data.error;
                        if(Object.prototype.hasOwnProperty.call(error,'title'))
                        {
                            Swal.fire({
                                icon:'error',
                                text: err.response.data.error.title
                            })
                        }
                        if(Object.prototype.hasOwnProperty.call(error,'description'))
                        {
                            Swal.fire({
                                icon:'error',
                                text: err.response.data.error.description
                            })
                        }

                    })
            },

            limpiar() {
                this.tarea = {
                    trabajadorId: 1,
                    title: '',
                    description: '',
                    delivery_date: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>
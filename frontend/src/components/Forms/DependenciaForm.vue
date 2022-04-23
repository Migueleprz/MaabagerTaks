<template>
    <form
            autocomplete="off"
            @submit.prevent="submit"
            id="form"
    >
        <div class="form-floating mb-3">
            <input
                    type="text"
                    class="form-control"
                    id="name"
                    required
                    v-model="data.name"
            >
            <label for="name">Nombre</label>
        </div>
        <div class="form-floating">
            <textarea
                    class="form-control"
                    placeholder="Leave a comment here"
                    id="description"
                    style="height: 100px"
                    v-model="data.description"
            ></textarea>
            <label
                    for="description">
                Descripción
            </label>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-2">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from "axios";
    import Swal from 'sweetalert2'
    import {reactive} from "vue";

    export default {
        name: "DependenciaForm-component",
        setup() {
            const data = reactive ({
                name:'',
                description: ''
            });


            const token = sessionStorage.getItem('token');
            const submit = async ()=>{
                await axios.post('http://127.0.0.1:8000/api/dependencia',{
                    name:data.name,
                    description: data.description
                },{headers:{Authorization:token}}).then(
                    res=>{
                        document.querySelector('form').reset();
                        Swal.fire({
                            icon:'success',
                            text:'La Depndencia: '+ res.data.name + ' se guardo correctamente'
                        });
                }).catch(
                    err=>{
                        console.log(err.response.data)
                    }
                );
            }
            return {
                data,
                submit,
            }
        }
    }
</script>

<style scoped>

</style>
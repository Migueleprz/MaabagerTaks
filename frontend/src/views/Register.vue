<template>
    <div class="form-signin card">
        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input
                        type="text"
                        class="form-control"
                        id="name"
                        placeholder="Nombre"
                        v-model="data.name"
                >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input
                        type="email"
                        class="form-control"
                        id="email"
                        placeholder="name@example.com"
                        v-model="data.email"
                >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contrasaeña</label>
                <input
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="******"
                        v-model="data.password"
                >
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>

        </form>
    </div>

</template>

<script lang="ts">
    import {reactive} from 'vue';
    import axios from "axios";
    import Swal from 'sweetalert2'
    import { useRouter } from 'vue-router';

    export default {
        name: "Register-component",
        setup(){
            const data = reactive({
                name:'',
                email:'',
                password:''
            });
            const route = useRouter();

            const submit = async ()=>{

                await axios.post('http://127.0.0.1:8000/api/register',{
                    name: data.name,
                    email: data.email,
                    password: data.password
                })
                .then(resp=>{
                    Swal.fire(resp.data.message);
                    route.push('/login');
                })
                .catch(err=>{
                    let error = err.response.data.error;
                    let message ='Error server !';

                    // eslint-disable-next-line no-prototype-builtins
                    if(error.hasOwnProperty('name'))
                    {
                        message = error.email[0];
                        Swal.fire(message);
                    }
                    // eslint-disable-next-line no-prototype-builtins
                    if(error.hasOwnProperty('email'))
                    {
                        message = error.email[0];
                        Swal.fire(message);
                    }
                    // eslint-disable-next-line no-prototype-builtins
                    if(error.hasOwnProperty('password'))
                    {
                        message = error.email[0];
                        Swal.fire(message);
                    }

                    });
            }

            return {
                data,
                submit
            }
        },

    }
</script>

<style scoped>

</style>
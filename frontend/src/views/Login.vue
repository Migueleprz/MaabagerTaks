<template>
   <div class="form-signin card">
       <form @submit.prevent="submit">
           <div class="row justify-content-center">
               <div class="col-md-8">
                   <p class="text-center"><i class="bi bi-person-fill h1"></i></p>
                   <h1 class="h3 mb-3 fw-normal text-center">Iniciar sesión</h1>
               </div>
           </div>

           <div class="form-floating">
               <input
                       type="email"
                       class="form-control"
                       id="floatingInput"
                       placeholder="name@example.com"
                       v-model="data.email"
               >
               <label for="floatingInput">Correo</label>
           </div>
           <div class="form-floating">
               <input
                       type="password"
                       class="form-control"
                       id="floatingPassword"
                       placeholder="Password"
                       v-model="data.password"
               >
               <label for="floatingPassword">Contraseña</label>
           </div>

           <div class="checkbox mb-3">
               <label>
                   <input type="checkbox" value="remember-me"> Recordarme
               </label>
           </div>
           <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>

       </form>
   </div>
</template>

<script lang="ts">
    import {onMounted, ref} from 'vue';
    import {reactive} from 'vue';
    import axios from "axios";
    import Swal from 'sweetalert2'
    import { useRouter } from 'vue-router';
    export default {
        name: "Login-components",
        setup() {
            const data = reactive({
                email:'',
                password:''
            });
            const route = useRouter();
            onMounted( async ()=>{
                let token =  sessionStorage.getItem('token');
                if(token !== null) {
                    await route.push('/')
                }
            });
            const submit = async ()=>{
                await axios.post('http://127.0.0.1:8000/api/login',{
                    email: data.email,
                    password: data.password
                },{headers:{'Content-Type':'application/json'}}).then(
                    resp=>{
                        let user = JSON.stringify(resp.data.user);
                        sessionStorage.setItem('token', resp.data.token);
                        sessionStorage.setItem('user', user);
                        if(sessionStorage.getItem('token')) {
                            route.push('/');
                        }
                    }
                ).catch(
                    err=>{
                        /*Swal.fire({
                            icon: 'error',
                            text: err.response.data.message
                        });*/
                        console.log(err)
                    }
                )
            }

            return {
                data,
                submit
            }
        }
    }
</script>

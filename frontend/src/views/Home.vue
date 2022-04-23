<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <TareasComponent></TareasComponent>
        </div>
    </div>
</template>

<script>
    import {onMounted, ref} from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router';
    import {useStore} from 'vuex';
    import TareasComponent from "@/views/Tareas";
    export default {
        name: "Home-component",
        components: {TareasComponent},
        setup() {

            const route = useRouter();
            const store = useStore();


            onMounted( async ()=>{
              let token =  sessionStorage.getItem('token');
              if(token === null || token === undefined) {
                  await store.dispatch('setAuth', false);
                  await route.push('/login');
                }
              await store.dispatch('setAuth', true);
            });

            return {

            }
        }
    }
</script>


<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Prueba Técnica</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <router-link
                                class="nav-link active"
                                aria-current="page"
                                to="/"
                                v-if="auth"
                        >
                            Inicio
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                                class="nav-link"
                                to="/login"
                                v-if="!auth"
                        >
                            Iniciar sesion
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                                class="nav-link"
                                to="/register"
                                v-if="!auth"
                        >
                            Registro
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a
                                class="nav-link pointer"
                                v-if="auth"
                                @click="salir"
                        >
                            Salir
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
    import {computed} from 'vue';
    import {useStore} from 'vuex';
    import { useRouter } from 'vue-router';
    export default {
        name: "Nav-component",
        setup() {
            const route = useRouter();
            const store = useStore();
            const auth = computed(()=>store.state.auth);
            const salir = () => {
                sessionStorage.clear();
                store.dispatch('setAuth', false);
                route.push('/login');
            }
            return {
                auth,
                salir
            }

        }
    }
</script>
<style>
    .pointer{
        cursor: pointer;
    }
</style>


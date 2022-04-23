import {Commit, createStore} from 'vuex'

export default createStore({
  state: {
    auth:false
  },
  getters: {
  },
  mutations: {
    SET_AUTH:(state:{auth:boolean}, auth:boolean)=> state.auth = auth
  },
  actions: {
    setAuth: ({commit}: { commit: Commit }, auth: boolean) => commit('SET_AUTH', auth)
  }
  ,
  modules: {
  }
})

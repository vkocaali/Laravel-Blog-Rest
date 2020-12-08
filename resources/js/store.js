import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
    plugins : [createPersistedState()],
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        userData : {},
        sideBarOpen: false,
        testName : 'Volkan',
        recendPost : {},
    },
    mutations: {
        changeName(state, payload){
            state.testName = payload;
        },
        auth_request(state){
            state.status = 'loading'
        },
        auth_user_data(state , data){
            state.userData = data;
        },
        auth_success(state, token){
            state.status = 'success';
            state.token = token;
        },
        auth_error(state){
            state.status = 'error';
        },
        logout(state){
            state.status = '';
            state.token = '';
        },
        toggleSidebar (state) {
            state.sideBarOpen = !state.sideBarOpen
        }

    },
    actions: {
        changeName ({commit},payload){
            commit('changeName',payload);
        },
        login({commit}, user){
            return new Promise((resolve, reject) => {
                commit('auth_request');
                axios({url: '/login', data: user, method: 'POST' })
                    .then(resp => {
                        const token = resp.data.token;
                        const authData = resp.data.user;
                        localStorage.setItem('token', token);
                        axios.defaults.headers.common['Authorization'] = token;
                        commit('auth_success', token);
                        commit('auth_user_data', authData);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit('auth_error');
                        localStorage.removeItem('token');
                        reject({
                            errors : err.response.data.errors,
                            status : err.response.status
                        });
                    })
            })
        },
        logout({commit}){
            return new Promise((resolve, reject) => {
                commit('logout');
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization'];
                resolve();
            })
        },
        setLoggedUser({commit},user){
            commit('auth_user_data',user);
        },
        toggleSidebar({commit}) {
            commit('toggleSidebar')
        }

    },
    getters : {
        getRecentPost : state => {
          return state;
        },
        sayHello : state => {
            return `Hoşgeldiniz , ${state.firstName}`;
        },
        isLoggedIn: state => {
            return !!state.token
        },
        authStatus: state => {
            return state.status
        },
        loggedUser : state => {
            return state.userData
        },
        sideBarOpen: state => {
            return state.sideBarOpen
        }
    }
})

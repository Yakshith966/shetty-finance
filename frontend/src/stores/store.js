import { createStore } from "vuex";
import createPersistedState from 'vuex-persistedstate';

const store = createStore({
    state() {
        return {
            token:null,
            user:null,
            subMenus: null,
            submenuPermissions: null,
        };
    },
    actions: {
        loadSelectedTrial({ commit }) {
          const storedTrial = localStorage.getItem('selectedTrial');
          if (storedTrial) {
            commit('setSelectedTrial', JSON.parse(storedTrial));
          }
        },
      },
    mutations: {
        setSelectedTrial(state, trial) {
            state.selectedTrial = trial;
            localStorage.setItem('selectedTrial', JSON.stringify(trial));
          },
        setToken: (state, token) => {
            state.token = token;
        },
        setUser:(state,user)=>
        {
            state.user = user
        },
        setSubMenus:(state, submenus) =>
        {
            state.subMenus = submenus;
        },
        setsubmenuPermissions:(state, submenuPermissions) =>
        {
            state.submenuPermissions = submenuPermissions;
        },
        clearAuth:(state)=>
        {
           state.user = null;
           state.token = null;
           state.subMenus = null;
           state.submenuPermissions = null;
        }
    
    },
    getters: {
        getSelectedTrial(state) { 
            return state.selectedTrial;
        },
        getToken(state) {
            return state.token;
        },
        getUser(state) {
            return state.user;
        },
        isAuthenticated(state) {
            return !!state.token;
        },
        getSubMenus(state) {
            return state.subMenus;
        },
        getSubmenuPermissions(state) {
            return state.submenuPermissions;
        },
        getActiveSideBar(state) {
            return state.activeSideBar;
        },

    },
    plugins: [createPersistedState()],
});

export default store;

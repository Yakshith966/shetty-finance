import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import store  from './stores/store';

import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'
import DocsComponents from '@/components/DocsComponents'
import DocsExample from '@/components/DocsExample'
import DocsIcons from '@/components/DocsIcons'
import axios from 'axios';
import "toastify-js/src/toastify.css";
import '@coreui/icons/css/all.min.css';
import '@mdi/font/css/materialdesignicons.css';


function getToken() {
  return store.getters.getToken; 
}


const axiosInstance = axios.create({
     baseURL: import.meta.env.VITE_VUE_APP_ROOT_PATH_API,
     headers: {
       'Content-Type': 'application/json',
     },
   });
 
   axiosInstance.interceptors.request.use(
    config => {
      config.headers.Authorization = `Bearer ${getToken()}`;
      return config;
    },
    error => Promise.reject(error)
  );
  
  axiosInstance.interceptors.response.use(response => {
    return response;
  }, error => {
    const isAuthenticated = store.getters.isAuthenticated;
    if (error.response && error.response.status === 401 && isAuthenticated ) {
        store.commit('clearAuth'); 
        alert('Session timed out');
        routerExport.push('/login'); 
    }
    return Promise.reject(error);
  });
  
const app = createApp(App)
window.axios = axiosInstance;
app.use(createPinia())
app.use(router)
app.use(vuetify);
app.use(CoreuiVue)
app.provide('icons', icons)
app.component('CIcon', CIcon)
app.component('DocsComponents', DocsComponents)
app.component('DocsExample', DocsExample)
app.component('DocsIcons', DocsIcons)
app.use(store)

app.mount('#app')

router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters.isAuthenticated; // Get the authentication state

  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Redirect to login if not authenticated
    if (!isAuthenticated) {
      next({ name: 'Login' });
      return;
    }
  }
  if (to.name === 'Login' && isAuthenticated) {
    next({ name: 'Dashboard' }); 
    return;
  }

  // Allow navigation
  next();
});
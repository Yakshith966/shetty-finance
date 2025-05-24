import { createApp } from 'vue';
import App from './App.vue';
import { router } from './router';
import vuetify from './plugins/vuetify';
import '@/scss/style.scss';
import PerfectScrollbar from 'vue3-perfect-scrollbar';
import VueApexCharts from 'vue3-apexcharts';
import VueTablerIcons from 'vue-tabler-icons';
import Antd from 'ant-design-vue';
import axios from 'axios';
import store  from './stores/store';
const app = createApp(App);

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



window.axios = axiosInstance;
app.use(router);
app.use(axios);
app.use(store);
app.use(Antd);
app.use(PerfectScrollbar);
app.use(VueTablerIcons);
app.use(VueApexCharts);
app.use(vuetify).mount('#app');

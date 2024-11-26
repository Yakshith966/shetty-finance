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



const axiosInstance = axios.create({
     baseURL: import.meta.env.VITE_VUE_APP_ROOT_PATH_API,
     headers: {
       'Content-Type': 'application/json',
     },
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

// router.beforeEach((to, from, next) => {
//   const isAuthenticated = store.getters.isAuthenticated;
//   // console.log(isAuthenticated);
//   console.log(to.name);
  
  
//   if(isAuthenticated && to.name == 'Login' || (isAuthenticated && from.name !='Login')) {
//     next({path :'/dashboard'})
//     return;
//   }
//   if (to.name !== 'Login' && !isAuthenticated) {
//     next({ name: 'Login' })
//     return ;
//   } 
//     next();
// });
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

  // Prevent authenticated users from accessing the Login route
  if (to.name === 'Login' && isAuthenticated) {
    next({ name: 'Dashboard' }); // Redirect to the dashboard or any default page
    return;
  }

  // Allow navigation
  next();
});
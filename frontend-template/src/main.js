import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';

import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'
import DocsComponents from '@/components/DocsComponents'
import DocsExample from '@/components/DocsExample'
import DocsIcons from '@/components/DocsIcons'
import axios from 'axios';

const axiosInstance = axios.create({
     baseURL: import.meta.env.VITE_APP_ROOT_PATH_API, // For Vue 3 with Vite
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

app.mount('#app')

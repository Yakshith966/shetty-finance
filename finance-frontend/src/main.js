// main.js
import { createApp } from 'vue';
import App from './App.vue';
import router from './router/routes'; // Ensure this path is correct

// Import Vuetify
import { createVuetify } from 'vuetify';
import 'vuetify/styles';  // Ensure Vuetify styles are imported

// Vuetify components and directives
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

// Create Vuetify instance
const vuetify = createVuetify({
  components,
  directives,
});

// Create Vue app
const app = createApp(App);

// Register Vuetify and router separately
app.use(vuetify);
app.use(router); // Use the router here

app.mount('#app');

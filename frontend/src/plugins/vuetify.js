import { createVuetify } from 'vuetify'; // Import Vuetify for Vue 3
import 'vuetify/styles'; // Import Vuetify styles
import '@mdi/font/css/materialdesignicons.css'; // Import Material Design Icons
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

// Optional: Define a theme
const customTheme = {
  dark: false,
  colors: {
    primary: '#6200EE',
    secondary: '#03DAC6',
    accent: '#FF5722',
    error: '#B00020',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FB8C00',
  },
};

// Create a Vuetify instance
const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'mdi', // Use Material Design Icons
  },
  theme: {
    defaultTheme: 'customTheme',
    themes: {
      customTheme,
    },
  },
});

export default vuetify; // Export the instance

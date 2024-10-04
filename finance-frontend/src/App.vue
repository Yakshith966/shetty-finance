<template>
  <v-app>
    <SidebarPage />
    <v-app-bar app color="indigo" dark>
      <v-toolbar-title>Shetty Finance</v-toolbar-title>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import SidebarPage from "./components/SidebarPage.vue";

export default {
  name: "App",
  components: {
    SidebarPage,
  },
};
</script>

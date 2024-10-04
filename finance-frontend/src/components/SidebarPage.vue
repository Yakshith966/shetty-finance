<template>
  <v-navigation-drawer
    app
    v-model="drawer"
    class="sidebar"
    :style="{ backgroundColor: '#f5f5f5', color: '#333' }"
  >
    <v-toolbar flat>
      <v-toolbar-title>Shetty Finance</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon @click="toggleDrawer">
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </v-toolbar>

    <v-list dense>
      <v-list-item-group v-model="selectedItem" active-class="primary--text">
        <v-list-item @click="$router.push('/dashboard')" :key="'dashboard'">
          <v-list-item-icon>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="$router.push('/checklist')" :key="'checklist'">
          <v-list-item-icon>
            <v-icon>mdi-check-circle</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Monthly Checklist</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="$router.push('/reports')" :key="'reports'">
          <v-list-item-icon>
            <v-icon>mdi-chart-line</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Reports</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>

  <!-- Button to open the drawer when it's closed -->
  <v-btn v-if="!drawer" icon @click="toggleDrawer">
    <v-icon>mdi-menu</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "SidebarPage",
  data() {
    return {
      drawer: true, // controls the visibility of the drawer
      selectedItem: null, // to highlight the selected item
    };
  },
  methods: {
    toggleDrawer() {
      this.drawer = !this.drawer; // Toggle the drawer
    },
  },
};
</script>

<style scoped>
.sidebar {
  min-width: 250px; /* Set the width of the sidebar */
}

.v-list-item {
  transition: background-color 0.3s; /* Smooth background color transition */
}

.v-list-item:hover {
  background-color: #e0e0e0; /* Change background color on hover */
}
</style>

<template>

  <div>
    <v-data-table :headers="headers" :items="storedrecords" item-value="id" class="elevation-1" :search="searchQuery">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Customer Details</v-toolbar-title>

          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>

        </v-toolbar>
        <v-card-title class="d-flex align-center pe-2" v-if="!isLoading">
          <v-btn color="primary" @click="exportCustomerDetails">
            Export to Excel
            <v-icon right>mdi-download</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-spacer></v-spacer>
          <v-text-field v-model="searchQuery" label="Search" prepend-inner-icon="mdi-magnify" outlined density="compact"
            variant="solo-filled" flat hide-details single-line></v-text-field>
        </v-card-title>
      </template>

      <!-- Loading State -->
      <template v-slot:body="{ items }">
        <tr v-if="isLoading">
          <td :colspan="headers.length" class="text-center">
            <v-progress-circular indeterminate color="primary" />
          </td>
        </tr>
        <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
          <td>{{ index + 1 }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.phone_number }}</td>
          <td>{{ item.email || 'N/A' }}</td>
          <td>{{ item.alternate_phone_number || 'N/A' }}</td>
          <td>
            <v-icon small @click="editCustomer(item)">mdi-pencil</v-icon>
          </td>
        </tr>
        <tr v-else>
          <td :colspan="headers.length" class="text-center">
            No data available
          </td>
        </tr>
      </template>

      <!-- No Data Alert -->
      <template v-slot:no-data>
        <v-alert>No customer data available.</v-alert>
      </template>
    </v-data-table>

    <!-- Edit Customer Dialog -->
    <v-dialog v-model="dialog" max-width="700px">
      <v-card>
        <v-card-title>
          <span class="text-h6">Edit Customer</span>
        </v-card-title>
        <v-card-text>
          <v-form ref="editForm">
            <v-text-field v-model="editItem.name" label="Customer Name" required></v-text-field>
            <v-text-field v-model="editItem.phone_number" label="Phone Number" required></v-text-field>
            <v-text-field v-model="editItem.email" label="Email"></v-text-field>
            <v-text-field v-model="editItem.alternate_phone_number" label="Alternate Mobile"></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text :disabled="isDisable" @click="saveCustomer">
            Save
          </v-btn>
          <v-btn color="red darken-1" text @click="closeDialog">
            Cancel
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import Toastify from 'toastify-js';
import "toastify-js/src/toastify.css";

export default {
  data: () => ({
    isDisable: false,
    isLoading: false,
    headers: [
      { title: 'Customer ID', value: 'id' },
      { title: 'Customer Name', value: 'name', sortable: true },
      { title: 'Phone Number', value: 'phone_number' },
      { title: 'Email', value: 'email' },
      { title: 'Alternate Mobile', value: 'alternate_phone_number' },
      { title: 'Actions', value: 'actions' },
    ],
    storedrecords: [],
    dialog: false,
    editItem: {},
    searchQuery: '',
  }),
  computed: {
    sortedAndFilteredRecords() {
      // Filter customers by name based on search query and then sort them
      const filtered = this.storedrecords.filter((item) =>
        item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
      return filtered.sort((a, b) => a.name.localeCompare(b.name)); // Sorting in ascending order
    },
  },
  mounted() {
    this.fetchCustomers();

  },
  methods: {
    async fetchCustomers() {
      this.isLoading = true;
      setTimeout(() => {
        if (this.isLoading) {
          this.isLoading = false;
        }
      }, 1000);
      try {
        const response = await axios.get('/customers');
        this.storedrecords = response.data.data;
      } catch (error) {
        this.isLoading = false;
      }
    },
    editCustomer(item) {
      this.editItem = { ...item };
      this.dialog = true;
      // Here, you can navigate to an edit page or open a dialog box
      // Example: this.$router.push(`/edit-customer/${customer.id}`);
    },
    closeDialog() {
      // Close dialog and reset editedItem
      this.dialog = false;
      this.editItem = {};
    },
    async saveCustomer() {

      this.isDisable = true; // Disable buttons to prevent multiple submissions
      const payload = {
        name: this.editItem.name,
        phone_number: this.editItem.phone_number,
        email: this.editItem.email,
        alternate_phone_number: this.editItem.alternate_phone_number,
      };

      try {
        // Send update request to backend
        const response = await axios.put(`/customers/${this.editItem.id}`, payload);

        // Update the local records
        const index = this.storedrecords.findIndex(
          (customer) => customer.id === this.editItem.id
        );
        if (index !== -1) {
          this.storedrecords[index] = { ...response.data.data };
        }
        // Display success message
        Toastify({
          text: response.data.message || "Customer updated successfully!",
          backgroundColor: "green",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
        }).showToast();

        // Close the dialog and reset state
        this.closeDialog();

      } catch (error) {
        // Handle validation errors
        if (error.response && error.response.status === 422) {
          const errors = error.response.data.errors;
          const firstErrorKey = Object.keys(errors)[0];
          const firstErrorMessage = errors[firstErrorKey][0];

          Toastify({
            text: firstErrorMessage,
            backgroundColor: "red",
            className: "text-light",
            duration: 3000,
            gravity: "top",
            position: "right",
          }).showToast();
        } else {
          // Handle other errors
          Toastify({
            text: "Failed to update customer. Please try again.",
            backgroundColor: "red",
            className: "text-light",
            duration: 3000,
            gravity: "top",
            position: "right",
          }).showToast();
        }
      } finally {
        this.isDisable = false; // Re-enable buttons
      }
    },
    exportCustomerDetails() {
      axios
        .post(
          "/download-customer-details",  // Route for the customer details export
          {},
          {
            responseType: "blob",
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then((response) => {
          // Create a URL for the blob response
          const url = window.URL.createObjectURL(
            new Blob([response.data], {
              type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            })
          );
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", "customer_details.xlsx");  // Name of the downloaded file
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);

          // Cleanup: Revoke the object URL after download
          window.URL.revokeObjectURL(url);
        })
        .catch((error) => {
          alert("There was an error generating the report. Please try again later.");
        });
    },
  },
}
</script>

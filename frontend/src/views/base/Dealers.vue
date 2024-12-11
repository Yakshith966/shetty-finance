<template>
     <v-data-table :headers="headers" :items="dealers" :items-per-page="5" class="elevation-1" :search="search">
          <template v-slot:top>
               <v-toolbar flat>
                    <v-toolbar-title>Dealer Details</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" variant="tonal" @click="openDialog()">Add Dealer</v-btn>
               </v-toolbar>
               <v-card-title class="d-flex align-center pe-2">
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" label="Search" prepend-inner-icon="mdi-magnify" outlined
                         density="compact" variant="solo-filled" flat hide-details single-line>
                    </v-text-field>
               </v-card-title>
          </template>
          <template v-slot:body="{ items }">
               <!-- Show Spinner when Loading -->
               <tr v-if="isLoading">
                    <td :colspan="headers.length" class="text-center">
                         <CSpinner color="primary" />
                    </td>
               </tr>

               <!-- Display Items if Available -->
               <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
                    <td>{{ index + 1 }}</td> <!-- Index column -->
                    <td>{{ item.name }}</td>
                    <td>{{ item.phone_number }}</td>
                    <td>{{ item.email || 'N/A' }}</td>
                    <td>{{ item.alternative_phone_number || 'N/A' }}</td>
                    <td>{{ item.address || 'N/A' }}</td>
                    <td>
                         <!-- Action Buttons -->
                         <v-icon small class="mr-2" @click="editDealer(item)">mdi-pencil</v-icon>
                         <v-icon color="red darken-1" small @click="openDeleteDialog(item.id)">mdi-delete</v-icon>
                    </td>
               </tr>

               <!-- No Data Available -->
               <tr v-else>
                    <td :colspan="headers.length" class="text-center">No data available</td>
               </tr>
          </template>
     </v-data-table>
     <v-dialog v-model="deleteDialogVisible" max-width="400">
          <v-card>
               <v-card-title class="text-h5">Confirm Deletion</v-card-title>
               <v-card-text>Are you sure you want to delete this dealer?</v-card-text>
               <v-card-actions>
                    <v-btn text color="red darken-1" @click="confirmDelete">
                         OK
                    </v-btn>
                    <v-btn text @click="deleteDialogVisible = false">Cancel</v-btn>
               </v-card-actions>
          </v-card>
     </v-dialog>



     <!-- Dealer Form Dialog -->
     <v-dialog v-model="dialog" max-width="600px">
          <v-card>
               <v-card-title class="d-flex justify-space-between align-center py-2">
                    <span class="headline">{{ dialogTitle }}</span>
                    <v-btn icon="mdi-close" variant="text" @click="closeDialog"></v-btn>
               </v-card-title>
               <v-card-text>
                    <v-container>
                         <v-row>
                              <v-col cols="12" sm="6">
                                   <v-text-field v-model="form.name" label="Name" required></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6">
                                   <v-text-field v-model="form.phone_number" label="Phone Number"
                                        required></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6">
                                   <v-text-field v-model="form.email" label="Email" type="email"></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6">
                                   <v-text-field v-model="form.alternative_phone_number"
                                        label="Alternative Phone Number"></v-text-field>
                              </v-col>
                              <v-col cols="12">
                                   <v-textarea v-model="form.address" label="Address"></v-textarea>
                              </v-col>
                         </v-row>
                    </v-container>
               </v-card-text>
               <v-card-actions>
                    <v-btn color="blue darken-1" text @click="closeDialog()" :disabled="isDisable">Cancel</v-btn>
                    <v-btn color="green darken-1" text @click="saveDealer()" :disabled="isDisable">Save</v-btn>
               </v-card-actions>
          </v-card>
     </v-dialog>

</template>
<script>
import Toastify from "toastify-js";
export default {
     data() {
          return {
               dialog: false,
               deleteDialogVisible: false,
               dealerToDelete: null,
               isLoading: false,
               dialogTitle: "Add Dealer",
               isDisable: false,
               search: "",
               headers: [
                    { title: "Sl no", key: "index" },
                    { title: "Name", key: "name" },
                    { title: "Phone Number", key: "phone_number" },
                    { title: "Email", key: "email" },
                    { title: "Alternative Phone", key: "alternative_phone_number" },
                    { title: "Address", key: "address" },
                    { title: "Actions", key: "actions", sortable: false },
               ],
               dealers: [], // Data from the API
               form: {
                    id: null,
                    name: "",
                    phone_number: "",
                    email: "",
                    alternative_phone_number: "",
                    address: "",
               },
          };
     },
     mounted() {
          this.fetchDealers();
     },
     methods: {
          openDeleteDialog(dealerId) {
               this.dealerToDelete = dealerId; 
               this.deleteDialogVisible = true; 
          },
          confirmDelete() {
               if (this.dealerToDelete) {
                    this.deleteDealer(this.dealerToDelete);
                    this.deleteDialogVisible = false; 
                    this.dealerToDelete = null; 
               }
          },
          // Fetch all dealers from the API
          async fetchDealers() {
               this.isLoading = true;
               try {
                    const response = await axios.get("/dealers"); // Replace with your API endpoint
                    this.dealers = response.data;
                    this.isLoading = false;
               } catch (error) {
                    this.isLoading = false;
                    console.error("Error fetching dealers:", error);
               }
          },
          // Open the dialog to add or edit a dealer
          openDialog(dealer = null) {
               if (dealer) {
                    this.dialogTitle = "Edit Dealer";
                    this.form = { ...dealer }; // Populate form with selected dealer data
               } else {
                    this.dialogTitle = "Add Dealer";
                    this.resetForm();
               }
               this.dialog = true;
          },
          // Close the dialog
          closeDialog() {
               this.dialog = false;
          },
          // Save dealer (add or update)
          async saveDealer() {
               this.isDisable = true;
               try {
                    if (this.form.id) {

                         // Edit logic
                         const response = await axios.put(`/dealers/${this.form.id}`, this.form); // Update API endpoint
                         const index = this.dealers.findIndex((d) => d.id === this.form.id);
                         if (index !== -1) {
                              this.dealers.splice(index, 1, response.data.dealer);
                         }
                         this.isDisable = false;
                         Toastify({
                              text: "Dealer updated successfully!",
                              backgroundColor: "green",
                              className: "text-light",
                              duration: 3000,
                              gravity: "top",
                              position: "right",
                              close: true,
                         }).showToast();
                    } else {
                         // Add logic
                         const response = await axios.post("/dealers", this.form); // Add API endpoint
                         this.dealers.push(response.data.dealer);
                         this.isDisable = false;
                         Toastify({
                              text: "Dealer added successfully!",
                              backgroundColor: "green",
                              className: "text-light",
                              duration: 3000,
                              gravity: "top",
                              position: "right",
                              close: true,
                         }).showToast();
                    }
                    this.closeDialog();
               } catch (error) {
                    this.isDisable = false;
                    if (error.response && error.response.data) {
                         const responseError = error.response.data;

                         // If validation errors exist, display the first error message
                         if (responseError.errors) {
                              const firstErrorKey = Object.keys(responseError.errors)[0];
                              Toastify({
                                   text: responseError.errors[firstErrorKey][0],
                                   backgroundColor: "red",
                                   className: "text-light",
                                   duration: 3000,
                                   gravity: "top",
                                   position: "right",
                                   close: true,
                              }).showToast();
                         } else if (responseError.message) {
                              // General error message
                              Toastify({
                                   text: responseError.message,
                                   backgroundColor: "red",
                                   className: "text-light",
                                   duration: 3000,
                                   gravity: "top",
                                   position: "right",
                                   close: true,
                              }).showToast();
                         } else {
                              // Fallback for unexpected errors
                              Toastify({
                                   text: "An unexpected error occurred!",
                                   backgroundColor: "red",
                                   className: "text-light",
                                   duration: 3000,
                                   gravity: "top",
                                   position: "right",
                                   close: true,
                              }).showToast();
                         }
                    } else {
                         // Fallback for network or server errors
                         Toastify({
                              text: "Unable to connect to the server.",
                              backgroundColor: "red",
                              className: "text-light",
                              duration: 3000,
                              gravity: "top",
                              position: "right",
                              close: true,
                         }).showToast();
                    }
               }
          },

          // Edit dealer logic
          editDealer(dealer) {
               this.openDialog(dealer);
          },
          // Delete a dealer
          async deleteDealer(id) {
               try {
                    await axios.delete(`/dealers/${id}`); // Delete API endpoint
                    this.dealers = this.dealers.filter((dealer) => dealer.id !== id);

                    // Show success Toast
                    Toastify({
                         text: "Dealer deleted successfully!",
                         backgroundColor: "green",
                         className: "text-light",
                         duration: 3000,
                         gravity: "top",
                         position: "right",
                         close: true,
                    }).showToast();
               } catch (error) {
                    // Handle error response and show the error Toast
                    const errorMessage =
                         error.response && error.response.data && error.response.data.message
                              ? error.response.data.message
                              : "An error occurred while deleting the dealer.";

                    Toastify({
                         text: errorMessage,
                         backgroundColor: "red",
                         className: "text-light",
                         duration: 3000,
                         gravity: "top",
                         position: "right",
                         close: true,
                    }).showToast();

                    console.error("Error deleting dealer:", error);
               }
          },

          // Reset the form
          resetForm() {
               this.form = {
                    id: null,
                    name: "",
                    phone_number: "",
                    email: "",
                    alternative_phone_number: "",
                    address: "",
               };
          },
     },

};
</script>

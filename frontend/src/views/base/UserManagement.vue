<template>
     <v-container>
          <v-data-table :headers="headers" :items="users" class="elevation-1" dense>
               <template v-slot:top>
                    <v-toolbar flat>
                         <v-toolbar-title>User Management</v-toolbar-title>
                         <v-spacer></v-spacer>
                         <v-btn class="mb-2" color="primary" @click="openCreateItemDialog">
                              <v-icon left>mdi-plus</v-icon>Create User
                         </v-btn>
                    </v-toolbar>
               </template>
               <template v-slot:body="{ items }">
                    <tr v-if="isLoading">
                         <td :colspan="headers.length" class="text-center">
                              <CSpinner color="primary" />
                         </td>
                    </tr>
                    <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
                         <td>{{ index + 1 }}</td>
                         <td>{{ item.user_name }}</td>
                         <td>{{ item.email }}</td>
                         <td> {{ getRoleName(item.role_id) }}</td>
                         <td> <v-btn color="warning" small @click="resetPassword(item.id)">
                                   <v-icon left>mdi-key</v-icon>Reset
                              </v-btn></td>
                         <td> <v-btn color="info" small @click="openEditDialog(item)">
                                   <v-icon left>mdi-pencil</v-icon>Edit
                              </v-btn></td>
                    </tr>
               </template>
          </v-data-table>

          <!-- Edit User Dialog -->
          <v-dialog v-model="editDialog" max-width="500px">
               <v-card>
                    <v-card-title class="d-flex justify-space-between align-center">
                         <div class="text-h5 text-medium-emphasis ps-2">Edit User</div>
                         <v-btn icon="mdi-close" variant="text" @click="closeEditDialog"></v-btn>
                    </v-card-title>
                    <v-card-text>
                         <v-form ref="editForm" lazy-validation>
                              <v-text-field label="User Name" v-model="editUser.user_name" />
                              <v-text-field label="Email" v-model="editUser.email" />
                              <v-select label="Role" :items="roles" item-title="role_name" item-value="id"
                                   v-model="editUser.role_id" />
                         </v-form>
                    </v-card-text>
                    <v-card-actions>
                         <v-btn color="primary" :disabled="disableButton" @click="saveEditUser">Save</v-btn>
                         <v-btn color="secondary" :disabled="disableButton" @click="closeEditDialog">Cancel</v-btn>
                    </v-card-actions>
               </v-card>
          </v-dialog>

          <!-- Create User Dialog -->
          <v-dialog v-model="createDialog" max-width="500px">
               <v-card>
                    <v-card-title class="d-flex justify-space-between align-center">
                         <div class="text-h5 text-medium-emphasis ps-2">Create User</div>
                         <v-btn icon="mdi-close" variant="text" @click="closeCreateDialog"></v-btn>
                    </v-card-title>
                    <v-card-text>
                         <v-form ref="createForm">
                              <v-text-field label="User Name*" v-model="newUser.user_name" />
                              <v-text-field label="Email*" v-model="newUser.email" />
                              <v-select label="Role*" :items="roles" item-title="role_name" item-value="id"
                                   v-model="newUser.role_id" />
                              <v-text-field label="Password*" v-model="newUser.password" type="password" />
                              <v-text-field label="Confirm Password*" v-model="newUser.confirmPassword"
                                   type="password" />
                         </v-form>
                    </v-card-text>
                    <v-card-actions>
                         <v-btn color="primary" :disabled="disableButton" @click="saveNewUser">Save</v-btn>
                         <v-btn color="secondary" :disabled="disableButton" @click="closeCreateDialog">Cancel</v-btn>
                    </v-card-actions>
               </v-card>
          </v-dialog>
          <v-dialog v-model="resetDialog" max-width="500px">
               <v-card>
                    <v-card-title class="d-flex justify-space-between align-center">
                         <div class="text-h5 text-medium-emphasis">Reset Password</div>
                         <v-btn icon="mdi-close" variant="text" @click="closeResetDialog"></v-btn>
                    </v-card-title>
                    <v-card-text>
                         <v-form ref="resetForm" lazy-validation>
                              <v-text-field v-model="resetPasswordForm.password" label="New Password" type="password" />
                              <v-text-field v-model="resetPasswordForm.confirmPassword" label="Confirm Password"
                                   type="password" />
                         </v-form>
                    </v-card-text>
                    <v-card-actions>
                         <v-btn color="primary" :disabled="disableButton" @click="saveResetPassword">Save</v-btn>
                         <v-btn color="secondary" :disabled="disableButton" @click="closeResetDialog">Cancel</v-btn>
                    </v-card-actions>
               </v-card>
          </v-dialog>
     </v-container>
</template>

<script>
import Toastify from "toastify-js";
export default {
     data() {
          return {
               editDialog: false,
               disableButton: false,
               resetDialog: false,
               resetPasswordForm: {
                    id: null,
                    password: '',
                    confirmPassword: '',
               },
               createDialog: false,
               roles: [],
               users: [],
               isLoading: false,
               headers: [
                    { title: "Sl No", key: "slNo", align: "start" },
                    { title: "Name", key: "user_name" },
                    { title: "Email", key: "email" },
                    { title: "Role", key: "role_id" },
                    { title: "Reset Password", key: "reset_password", align: "center" },
                    { title: "Action", key: "actions", align: "center" },
               ],
               editUser: {
                    id: null,
                    user_name: "",
                    email: "",
                    role_id: null,
                    password: "",
                    confirmPassword: "",
               },
               newUser: {
                    user_name: "",
                    email: "",
                    role_id: null,
                    password: "",
                    confirmPassword: "",
               },
          };
     },
     mounted() {
          this.fetchUsers();
          this.fetchRoles();
     },
     methods: {
          getRoleName(roleId) {
               const role = this.roles.find((r) => r.id === roleId);
               return role ? role.role_name : "Unknown Role";
          },
          resetPassword(userId) {
               this.resetPasswordForm.id = userId; 
               this.resetPasswordForm.password = '';
               this.resetPasswordForm.confirmPassword = '';
               this.resetDialog = true; 
          },
          closeResetDialog() {
               this.resetDialog = false;
          },
          async saveResetPassword() {
               if (this.resetPasswordForm.password !== this.resetPasswordForm.confirmPassword) {
                    Toastify({
                         text: 'Password and Confirm Password do not match',
                         backgroundColor: 'red',
                         className: 'text-light',
                         duration: 3000,
                         gravity: 'top',
                         position: 'right',
                    }).showToast();
                    return;
               }
               this.disableButton = true;
               try {
                    const response = await axios.put('/reset-password', {
                         id: this.resetPasswordForm.id,
                         password: this.resetPasswordForm.password,
                    });
                    Toastify({
                         text: response.data.message,
                         backgroundColor: 'green',
                         className: 'text-light',
                         duration: 3000,
                         gravity: 'top',
                         position: 'right',
                    }).showToast();
                    this.disableButton = false;
                    this.closeResetDialog(); 
               } catch (error) {
                    this.disableButton = false;
                    Toastify({
                         text: error.response?.data?.message || 'An error occurred',
                         backgroundColor: 'red',
                         className: 'text-light',
                         duration: 3000,
                         gravity: 'top',
                         position: 'right',
                    }).showToast();
               }
          },
          openEditDialog(user) {
               this.editUser = { ...user, password: "", confirmPassword: "" };
               this.editDialog = true;
          },
          closeEditDialog() {
               this.editDialog = false;
          },
          openCreateItemDialog() {
               this.newUser = {
                    user_name: "",
                    email: "",
                    role_id: null,
                    password: "",
                    confirmPassword: "",
               };
               this.createDialog = true;
          },
          closeCreateDialog() {
               this.createDialog = false;
          },
          async saveEditUser() {
               this.disableButton = true;
               try {
                    const response = await axios.put(`/update-user/${this.editUser.id}`, this.editUser);
                    Toastify({
                         text: response.data.message,
                         backgroundColor: "green",
                         className: "text-light",
                         duration: 3000,
                         gravity: "top",
                         position: "right",
                    }).showToast();
                    this.disableButton = false;
                    this.fetchUsers(); 
                    this.closeEditDialog();
               } catch (error) {
                    Toastify({
                         text: error.response?.data?.message || "An error occurred",
                         backgroundColor: "red",
                         className: "text-light",
                         duration: 3000,
                         gravity: "top",
                         position: "right",
                    }).showToast();
                    this.disableButton = false;
               }
          },

          async saveNewUser() {
               if (this.newUser.password !== this.newUser.confirmPassword) {
                    Toastify({
                         text: "Password and Confirm Password do not match",
                         backgroundColor: "red",
                         className: "text-light",
                         duration: 3000,
                         gravity: "top",
                         position: "right",
                    }).showToast();
                    return;
               }
               this.disableButton = true;

               try {
                    const response = await axios.post("/save-user", this.newUser);

                    Toastify({
                         text: "User created successfully!",
                         backgroundColor: "green",
                         className: "text-light",
                         duration: 3000,
                         gravity: "top",
                         position: "right",
                    }).showToast();
                    this.disableButton = false;

                    this.fetchUsers(); 
                    this.closeCreateDialog();
               } catch (error) {
                    if (error.response && error.response.data && error.response.data.message) {
                         Toastify({
                              text: error.response.data.message,
                              backgroundColor: "red",
                              className: "text-light",
                              duration: 3000,
                              gravity: "top",
                              position: "right",
                         }).showToast();
                    } else {
                         Toastify({
                              text: "An unexpected error occurred. Please try again.",
                              backgroundColor: "red",
                              className: "text-light",
                              duration: 3000,
                              gravity: "top",
                              position: "right",
                         }).showToast();
                    }
                    this.disableButton = false;
               }
          },

          async fetchUsers() {
               this.isLoading = true;
               try {
                    const response = await axios.get("/fetch-users");
                    this.users = response.data;
                    this.isLoading = false;
               } catch (error) {
                    this.isLoading = false;
               }
          },
          async fetchRoles() {
               try {
                    const response = await axios.get("/fetch-roles");
                    this.roles = response.data;
               } catch (error) {
                    console.error(error);
               }
          },
     },
};
</script>

<style scoped>
.text-center {
     text-align: center;
}
</style>
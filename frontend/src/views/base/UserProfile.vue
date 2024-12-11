<template>
     <v-container class="d-flex justify-center align-center">
       <v-card class="pa-4" max-width="500" elevation="3">
         <v-card-title class="text-h5 font-weight-bold text-center">
           User Profile
         </v-card-title>
         <v-divider></v-divider>
         <v-card-text>
           <v-row dense>
             <v-col cols="12" class="text-center">
               <strong class="text-h6">{{ user.user_name }}</strong>
               <p class="text-subtitle-1 grey--text">{{ user.email }}</p>
             </v-col>
             <v-col cols="12" class="text-center">
               <strong>Role:</strong>
               <p>{{ user.roles.role_name }}</p>
             </v-col>
           </v-row>
         </v-card-text>
         <v-divider></v-divider>
         <v-card-actions class="d-flex justify-center">
           <v-btn color="primary" outlined @click="editProfile">
             <v-icon left>mdi-pencil</v-icon>Edit Profile
           </v-btn>
           <v-btn color="primary" outlined @click="resetPassword">
             <v-icon left>mdi-lock</v-icon>Reset Password
           </v-btn>
         </v-card-actions>
       </v-card>

       <!-- Password reset Dialog -->
       <v-dialog v-model="passwordDialog" max-width="500">
         <v-card>
           <v-card-title class="text-h6 font-weight-bold">Reset Password</v-card-title>
           <v-divider></v-divider>
           <v-card-text>
             <v-form ref="form" v-model="valid">
               <v-text-field
                 label="New Password"
                 v-model="editedUserPassword.password"
                 :rules="[rules.required, rules.password]"
                 outlined
                 dense
               />
               <v-text-field
                 label="Confirm Password"
                 v-model="editedUserPassword.confirmPassword"
                 :rules="[rules.required, rules.confirmPassword]"
                 outlined
                 dense
               />
             </v-form>
           </v-card-text>
           <v-divider></v-divider>
           <v-card-actions class="d-flex justify-end">
             <v-btn color="primary" @click="savePasswordChanges" :disabled="!valid || saveStatus">
              {{ saveStatus ? 'Saving...' : 'Save'}}
             </v-btn>
             <v-btn v-if="!saveStatus" text @click="closeDialog" :disabled="saveStatus">Cancel</v-btn>
           </v-card-actions>
         </v-card>
       </v-dialog>
   
       <!-- Edit Profile Dialog -->
       <v-dialog v-model="userDataDialog" max-width="500">
         <v-card>
           <v-card-title class="text-h6 font-weight-bold">Edit Profile</v-card-title>
           <v-divider></v-divider>
           <v-card-text>
             <v-form ref="form" v-model="valid">
               <v-text-field
                 label="Username"
                 v-model="editedUser.user_name"
                 :rules="[rules.required]"
                 outlined
                 dense
               />
               <v-text-field
                 label="Email"
                 v-model="editedUser.email"
                 :rules="[rules.required, rules.email]"
                 outlined
                 dense
               />
               <v-text-field
                 label="Role"
                 v-model="editedUser.roles.role_name"
                 readonly
                 outlined
                 dense
               />
             </v-form>
           </v-card-text>
           <v-divider></v-divider>
           <v-card-actions class="d-flex justify-end">
             <v-btn color="primary" @click="saveUserData" :disabled="!valid || saveStatus">
               {{ saveStatus ? 'Saving...' : 'Save'}}
             </v-btn>
             <v-btn v-if="!saveStatus" text @click="closeDialog" :disabled="saveStatus">Cancel</v-btn>
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
         userDataDialog: false,
         passwordDialog: false,
         valid: false,
         saveStatus: false,
         user: {},
         editedUser: {},
         userPassword: {},
         editedUserPassword: {},
         rules: {
           required: (value) => !!value || "This field is required",
           email: (value) => /.+@.+\..+/.test(value) || "E-mail must be valid",
           password: (value) =>
            value.length >= 6 || "Password must be at least 6 characters",
           confirmPassword: (value) =>
            value === this.editedUserPassword.password || "Passwords must match",
         },
       };
     },
     created() {
      this.loadUserData();
    },

     methods: {
      loadUserData(){
        const userDetails = JSON.parse(localStorage.getItem('vuex'));
        this.user = userDetails.user;
      },
      resetPassword(){
        this.editedUserPassword = { ...this.userPassword};
        this.passwordDialog = true;
      },
       editProfile() {
         this.editedUser = { ...this.user };
         this.userDataDialog = true;
       },
       showToastifyMessage(message, color){
          Toastify({
              text: message,
              backgroundColor: color,
              className: "text-light",
              duration: 3000,
              gravity: "top",
              position: "right"
            }).showToast();
        },
       async saveUserData(){
        this.saveStatus = true;
        try {
          const response = await axios.put(`/update-user-data/${this.user.id}`, this.editedUser);
          this.$store.commit('setUser', response.data.user);
          this.showToastifyMessage(response.data.message, 'green');
          this.loadUserData();
          this.userDataDialog = false;
          this.saveStatus = false;
        } catch (error) {
          this.saveStatus = false;
          // console.log(error);
          this.showToastifyMessage("Failed to update user data. Try again.", "red");
        }
       },
       async savePasswordChanges() {
          if (
            this.editedUserPassword.password !== this.editedUserPassword.confirmPassword
          ) {
            this.showToastifyMessage("Passwords do not match!", "red");
            return;
          }
          this.saveStatus = true;
          try {
            const response = await axios.put(
              `/update-user-password/${this.user.id}`,
              { password: this.editedUserPassword.password }
            );
            this.$store.commit('setToken', response.data.token);
            this.showToastifyMessage(response.data.message, "green");
            this.editedUserPassword = { password: "", confirmPassword: "" };
            this.passwordDialog = false;
            this.saveStatus = false;
          } catch (error) {
            // console.error(error);
            this.saveStatus = false;
            this.showToastifyMessage("Failed to update password. Try again.", "red");
          }
        },
       closeDialog() {
         this.userDataDialog = false;
         this.passwordDialog = false;
       },
     },
   };
   </script>
   
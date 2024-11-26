<template>
     <v-container class="d-flex justify-center align-center" style="margin-top: 20px">
       <v-card class="pa-4" max-width="500" elevation="3">
         <v-card-title class="text-h5 font-weight-bold text-center">
           User Profile
         </v-card-title>
         <v-divider></v-divider>
         <v-card-text>
           <v-row dense>
             <v-col cols="12" class="text-center mt-4">
               <strong class="text-h6">{{ user.username }}</strong>
               <p class="text-subtitle-1 grey--text">{{ user.email }}</p>
             </v-col>
             <v-col cols="12" class="text-center mt-2">
               <strong>Role:</strong>
               <p>{{ user.role }}</p>
             </v-col>
           </v-row>
         </v-card-text>
         <v-divider></v-divider>
         <v-card-actions class="d-flex justify-center">
           <v-btn color="primary" outlined @click="editProfile">
             <v-icon left>mdi-pencil</v-icon>Edit Profile
           </v-btn>
         </v-card-actions>
       </v-card>
   
       <!-- Edit Profile Dialog -->
       <v-dialog v-model="dialog" max-width="500">
         <v-card>
           <v-card-title class="text-h6 font-weight-bold">Edit Profile</v-card-title>
           <v-divider></v-divider>
           <v-card-text>
             <v-form ref="form" v-model="valid">
               <v-text-field
                 label="Username"
                 v-model="editedUser.username"
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
                 v-model="editedUser.role"
                 :rules="[rules.required]"
                 outlined
                 dense
               />
             </v-form>
           </v-card-text>
           <v-divider></v-divider>
           <v-card-actions class="d-flex justify-end">
             <v-btn color="primary" @click="saveChanges" :disabled="!valid">
               Save
             </v-btn>
             <v-btn text @click="closeDialog">Cancel</v-btn>
           </v-card-actions>
         </v-card>
       </v-dialog>
     </v-container>
   </template>
   
   <script>
   export default {
     data() {
       return {
         dialog: false,
         valid: false,
         user: {
           username: "JohnDoe123",
           email: "johndoe@example.com",
           role: "Administrator",
         },
         editedUser: {},
         rules: {
           required: (value) => !!value || "This field is required",
           email: (value) => /.+@.+\..+/.test(value) || "E-mail must be valid",
         },
       };
     },
     methods: {
       editProfile() {
         this.editedUser = { ...this.user };
         this.dialog = true;
       },
       saveChanges() {
         this.user = { ...this.editedUser };
         this.dialog = false;
       },
       closeDialog() {
         this.dialog = false;
       },
     },
   };
   </script>
   
   <style scoped>
   .v-card {
     border-radius: 12px;
   }
   
   .text-center {
     text-align: center;
   }
   
   .mt-4 {
     margin-top: 16px;
   }
   
   .mt-2 {
     margin-top: 8px;
   }
   </style>
   
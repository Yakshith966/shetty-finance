<template>
     <v-container fluid>
       <!-- Heading and Buttons -->
       <v-row class="mb-4 align-center">
         <v-col cols="4">
           <h2 class="font-weight-bold mb-0">Monthly Checklist</h2>
         </v-col>
         <v-col cols="8" class="text-right">
           <v-btn color="primary" class="mx-2">Add</v-btn>
           <v-btn color="success darken-1" class="mx-2">Save</v-btn>
           <v-btn color="info darken-1" class="mx-2">Preview</v-btn>
           <v-btn color="grey darken-1" class="mx-2">Export to Excel</v-btn>
         </v-col>
       </v-row>
   
       <!-- Table -->
       <v-sheet class="pa-4" color="grey lighten" elevation="2">
         <v-simple-table dense>
           <thead>
             <tr>
               <th class="text-center">Sl No</th>
               <th class="text-center">Date</th>
               <th class="text-center">Date of Issue</th>
               <th class="text-center">Branch</th>
               <th class="text-center">Customer Name</th>
               <th class="text-center">Contact No 1</th>
               <th class="text-center">Contact No 2</th>
               <th class="text-center">Paid Amount</th>
               <th class="text-center">Monthly Return Payment</th>
               <th class="text-center">Return Date</th>
               <th class="text-center">Return History</th>
               <th class="text-center">Action</th>
             </tr>
           </thead>
           <tbody>
             <tr v-for="(item, index) in tableData" :key="index">
               <td class="text-center">{{ index + 1 }}</td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.date"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Select Date"
                   type="date"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.dateOfIssue"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Date of Issue"
                   type="date"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.branch"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Branch"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.customerName"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Customer Name"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.contactNo1"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Contact No 1"
                   type="tel"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.contactNo2"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Contact No 2"
                   type="tel"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.paidAmount"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Paid Amount"
                   type="number"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.monthlyReturnPayment"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Monthly Return Payment"
                   type="number"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.returnDate"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Return Date"
                   type="date"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-text-field
                   v-model="item.returnHistory"
                   outlined
                   dense
                   hide-details
                   class="custom-input"
                   placeholder="Return History"
                 ></v-text-field>
               </td>
               <td class="text-center">
                 <v-btn color="red" @click="removeRow(index)">Remove</v-btn>
               </td>
             </tr>
           </tbody>
         </v-simple-table>
       </v-sheet>
     </v-container>
   </template>
   
   <script>
   export default {
     name: "MonthlyChecklist",
     mounted() {
       console.log('MonthlyChecklist mounted');
     },
     data() {
       return {
         tableData: [
           { date: "", dateOfIssue: "", branch: "", customerName: "", contactNo1: "", contactNo2: "", paidAmount: "", monthlyReturnPayment: "", returnDate: "", returnHistory: "", action: "" }
         ]
       };
     },
     methods: {
       removeRow(index) {
         this.tableData.splice(index, 1); // Remove the row at the specified index
       },
     },
   };
   </script>
   
   <style scoped>
   .custom-input {
     margin: 5px 0; /* Add some margin for spacing */
     border: 1px solid black; /* Add black border */
   }
   
   /* Optional: Customize the style of the table and buttons further if needed */
   .v-simple-table th, .v-simple-table td {
     padding: 10px; /* Padding for table cells */
   }
   
   .v-btn {
     min-width: 120px; /* Set a minimum width for buttons */
   }
   
   /* Additional style to adjust the table layout */
   .v-simple-table {
     margin-top: 20px; /* Add space above the table */
   }
   
   .v-row {
     margin-bottom: 20px; /* Add space between the row and buttons */
   }
   </style>
   
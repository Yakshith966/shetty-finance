<template>
  <v-data-table
    :headers="headers"
    :items="records"
    item-value="id"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Service Details</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-btn class="mb-2" color="primary" @click="openNewItemDialog">
          New Item
        </v-btn>
      </v-toolbar>
    </template>

    <template v-slot:item.status="{ item }">
      <v-select
        v-model="item.status"
        :items="['Received', 'Repairing', 'Repaired']"
        dense
        outlined
      ></v-select>
    </template>
       <template v-slot:item.paymentStatus="{ item }">
<div>
 <!-- Check if item.paymentDetails exists and its status is 'Paid' -->
 <v-chip
   v-if="item.paymentDetails && item.paymentDetails.status === 'Paid'"
   color="green"
   outlined
   small
 >
   {{ item.paymentDetails.status }}
 </v-chip>

 <!-- Otherwise, display the dropdown if paymentDetails exists -->
 <v-select
   v-else-if="item.paymentDetails"
   v-model="item.paymentDetails.status"
   :items="['Paid', 'Pending']"
   dense
   outlined
   @change="updatePaymentStatus(item)"
 ></v-select>

 <!-- Display a dash if item.paymentDetails is undefined -->
 <span v-else>-</span>
</div>
</template>
    
    <template v-slot:item.payment="{ item }">
      <v-btn icon :disabled="isPaid(item)" @click="openPaymentDialog(item)">
        <v-icon>mdi-credit-card</v-icon>
      </v-btn>
    </template>

    <template v-slot:item.actions="{ item }">
      <v-icon class="me-2" size="small" :disabled="isPaid(item)" @click="!isPaid(item) && openEditDialog(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon size="small"  :disabled="isPaid(item)"
      @click="openViewDialog(item)">
        mdi-eye
      </v-icon>
    </template>
    
  </v-data-table>
  
  <!-- New/Edit Dialog -->
  <v-dialog v-model="dialog" max-width="800px">
    <v-card>
      <v-card-title>
        <span class="text-h5">{{ dialogMode === 'new' ? 'New Item' : 'Edit Item' }}</span>
      </v-card-title>
      <v-card-text>
        <v-container>
         <v-container>
   <v-checkbox  v-if="dialogMode!='edit'" v-model="isExistingCustomer" label="Already a Customer"></v-checkbox>
 </v-container>
         <v-autocomplete
       v-if="isExistingCustomer"
       v-model="selectedCustomer"
       :items="customerNames"
       item-title="customerName"
       item-value="customerId"
       label="Search Customer"
       prepend-inner-icon="mdi-magnify"
       outlined
       hide-details
     ></v-autocomplete>
          
          <v-row>
            <!-- First Card: Customer Details -->
            <v-col cols="12" md="6">
              <v-card>
                <v-card-title>Customer Details</v-card-title>
                <v-card-text>
                  <v-text-field v-model="editedItem.customerName" label="Customer Name"></v-text-field>
                  <v-text-field v-model="editedItem.phone" label="Phone"></v-text-field>
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                  <v-text-field v-model="editedItem.altPhone" label="Alternative Mobile"></v-text-field>
                </v-card-text>
              </v-card>
            </v-col>

            <!-- Second Card: Product Details -->
            <v-col cols="12" md="6">
              <v-card>
                <v-card-title>Product Details</v-card-title>
                <v-card-text>
                 <v-text-field v-model="editedItem.productType" label="Product Type"></v-text-field>
                 <v-text-field v-model="editedItem.productName" label="Product Name"></v-text-field>
                  <v-text-field v-model="editedItem.model" label="Model"></v-text-field>
                  <v-text-field v-model="editedItem.serialNumber" label="Serial Number"></v-text-field>
                  <v-text-field v-model="editedItem.date" label="Date" type="date"></v-text-field>
                  <v-textarea v-model="editedItem.issueDescription" label="Issue Description"></v-textarea>
                  <v-text-field v-model="editedItem.collectedItems" label="Collected Items"></v-text-field>
                  <v-select
                    v-model="editedItem.status"
                    :items="['Received', 'Repairing','Repaired']"
                    label="Status"
                    outlined
                  ></v-select>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn variant="text" @click="closeDialog">Cancel</v-btn>
        <v-btn color="primary" @click="saveItem">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- Payment Dialog -->
  <v-dialog v-model="paymentDialog" max-width="500px">
    <v-card>
      <v-card-title>Payment Details</v-card-title>
      <v-card-text>
        <v-text-field v-model="paymentDetails.amount" label="Amount"></v-text-field>
        <v-select
          v-model="paymentDetails.status"
          :items="['Paid', 'Pending']"
          label="Payment Status"
          outlined
          @change="updatePaymentStatus(item)"
        ></v-select>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn variant="text" @click="closePaymentDialog">Cancel</v-btn>
        <v-btn color="primary" @click="savePaymentDetails">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- View Dialog -->
  <v-dialog v-model="viewDialog" max-width="1000px">
<v-card>
 <v-card-title class="headline font-weight-bold justify-center">
   Customer Details
 </v-card-title>
 <v-divider></v-divider>
 <v-card-text>
   <v-container>
     <!-- Customer Information -->
     <v-row dense>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.customerName"
           label="Customer Name"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.phone"
           label="Phone"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.email"
           label="Email"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
     </v-row>
     
     <!-- Alternative Information -->
     <v-row dense>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.altPhone"
           label="Alternative Phone"
           readonly
           outlined
           class="mb-3"
         ></v-text-field> 
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.productType"
           label="Product Type"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.productName"
           label="Product Name"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <!-- <v-col cols="4">
         <v-text-field
           v-model="editedItem.model"
           label="Model"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col> -->
     </v-row>

     <!-- Additional Product Information -->
     <v-row dense>
      <v-col cols="4">
         <v-text-field
           v-model="editedItem.model"
           label="Model"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.serialNumber"
           label="Serial Number"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.date"
           label="Date"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <!-- <v-col cols="4">
         <v-text-field
           v-model="editedItem.status"
           label="Status"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col> -->
     </v-row>

     <!-- Description with More Space -->
     <v-row dense>
      <v-col cols="4">
         <v-text-field
           v-model="editedItem.status"
           label="Status"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="8">
         <v-textarea
           v-model="editedItem.issueDescription"
           label="Issue Description"
           rows="5"
           readonly
           outlined
           class="mb-3"
         ></v-textarea>
       </v-col>
     </v-row>

     <!-- Payment Information -->
     <v-row dense>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.paymentDetails.amount"
           label="Amount"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
       <v-col cols="4">
         <v-text-field
           v-model="editedItem.paymentDetails.status"
           label="Payment Status"
           readonly
           outlined
           class="mb-3"
         ></v-text-field>
       </v-col>
     </v-row>
   </v-container>
 </v-card-text>
 <v-card-actions class="justify-end">
   <v-btn color="primary" @click="viewDialog = false">Close</v-btn>
 </v-card-actions>
</v-card>
</v-dialog>

</template>

<script>
export default {
  data: () => ({
   
viewDialog: false, // New dialog for viewing customer details
   isExistingCustomer: false,
 selectedCustomer: null,
    dialog: false,
    dialogMode: 'new',
    paymentDialog: false,
    customerNames: [
{ customerId: 1, customerName: 'John Doe', email: 'john.doe@example.com' },
{ customerId: 2, customerName: 'Jane Smith', email: 'jane.smith@example.com' },
],
    headers: [
      { title: 'Customer ID', key: 'customerId' },
      { title: 'Customer Name', key: 'customerName' },
      { title: 'Product Type', key: 'productType' },
      { title: 'Product Name', key: 'productName' },
      { title: 'Date', key: 'date' },
      { title: 'Status', key: 'status' },
      { title: 'Payment', key: 'payment' },
      { title: 'Payment Status', key: 'paymentStatus' },
      { title: 'Actions', key: 'actions' },
    ],
    records: [], // Data for the table
    editedItem: {
      customerId: '',
      customerName: '',
      phone: '',
      email: '',
      altPhone: '',
      productType:'',
      productName: '',
      model: '',
      serialNumber: '',
      date: '',
      issueDescription: '',
      collectedItems: '',
      status: '',
      paymentDetails: { // Add paymentDetails property
       amount: '',
       status: '',
     },
    },
    defaultItem: {
      customerId: '',
      customerName: '',
      phone: '',
      email: '',
      altPhone: '',
      productType:'',
      productName: '',
      model: '',
      serialNumber: '',
      date: '',
      issueDescription: '',
      collectedItems: '',
      status: '',
    },
    paymentDetails: {
      amount: '',
      status: '',
    },
  }),
  computed: {

},

  methods: {
    openNewItemDialog() {
      this.dialogMode = 'new';
      this.dialog = true;
      this.editedItem = { ...this.defaultItem };
    },
    openEditDialog(item) {
      this.dialogMode = 'edit';
      this.editedItem = { ...item };
      this.dialog = true;
    },
    openViewDialog(item) {
     this.editedItem = { ...item }; // Load selected customer's details
     this.viewDialog = true;
    },
    openPaymentDialog() {
   // Pre-fill payment details when dialog is opened
   this.paymentDetails = { ...this.editedItem.paymentDetails };
   this.paymentDialog = true;
 },
    closeDialog() {
      this.dialog = false;
    },
    closePaymentDialog() {
      this.paymentDialog = false;
    },
    saveItem() {
      if (this.dialogMode === 'new') {
        this.records.push({ ...this.editedItem });
      } else {
        const index = this.records.findIndex((r) => r.customerId === this.editedItem.customerId);
        if (index !== -1) this.records.splice(index, 1, { ...this.editedItem });
      }
      this.closeDialog();
    },
    savePaymentDetails() {
// Save the payment details in editedItem
this.editedItem.paymentDetails = { ...this.paymentDetails };

// Find the matching record in records and update it
const index = this.records.findIndex(record => record.customerId === this.editedItem.customerId);
if (index !== -1) {
 // Directly update the record's paymentDetails
 this.records[index].paymentDetails = { ...this.paymentDetails };
}

alert(`Payment Details Saved: ${JSON.stringify(this.paymentDetails)}`);
this.closePaymentDialog();
},
populateCustomerDetails(customerId) {
 const customer = this.records.find((record) => record.customerId === customerId);
 if (customer) {
   this.editedItem = {
     ...this.editedItem,
     customerName: customer.customerName,
     phone: customer.phone,
     email: customer.email,
     altPhone: customer.altPhone,
   };
 }
},
updatePaymentStatus(item) {
const targetItem = this.records.find(record => record.customerId === item.customerId);
if (targetItem) {
 targetItem.paymentDetails.status = item.paymentDetails.status;
}
},

isPaid(item) {
   return item.paymentDetails && item.paymentDetails.status === 'Paid';
 },

  },
};
</script>

<style scoped>
.v-card-title {
  font-weight: bold;
}
.read-only-column {
pointer-events: none; /* Disable pointer interactions */
background-color: #f9f9f9; /* Subtle background for clarity */
}
.v-text-field[readonly] .v-input__control,
.v-textarea[readonly] .v-input__control {
cursor: default; /* Indicate no interaction allowed */
}
.v-card-title {
color: #3F51B5;
}
.v-col {
padding-left: 16px; /* Add space to the left */
padding-right: 16px; /* Add space to the right */
}

.v-row {
margin-bottom: 16px; /* Add space between rows */
}

.read-only-column {
background-color: #f9f9f9;
border-radius: 4px; /* Optional for better design */
}
</style>
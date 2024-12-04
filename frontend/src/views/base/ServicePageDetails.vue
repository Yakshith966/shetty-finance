<template>
  <v-data-table :headers="headers" :items="filteredRecords" item-value="id" :search="search">
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Service Details</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn class="mb-2" color="primary" @click="openNewItemDialog">
          New Item
        </v-btn>
      </v-toolbar>
      <v-card-title class="d-flex align-center pe-2">
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-select v-model="selectedStatus" :items="[{ id: null, status: 'All' }, ...formattedStatusOptions]"
          label="Filter by Status" item-value="id" item-title="status" outlined density="compact" variant="solo-filled"
          flat hide-details single-line style="max-width: 200px; margin-right: 1rem;"></v-select>
        <v-text-field v-model="search" label="Search" prepend-inner-icon="mdi-magnify" outlined density="compact"
          variant="solo-filled" flat hide-details single-line></v-text-field>
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
        <td>{{ item.service_id }}</td>
        <td>{{ item.customer.name }}</td>
        <td>{{ item.product_type }}</td>
        <td>{{ item.product_name }}</td>
        <td>{{ item.product_received_date }}</td>
        <!-- <td>{{ item.payment_mode }}</td> -->
        <!-- <td>{{ item.payment_date }}</td> -->
        <td>
          <v-btn icon @click="openDealersDialog(item)">
            <v-icon>mdi-account</v-icon>
          </v-btn>
        </td>
        <td>
          <v-select :readonly="isPaid(item)" v-model="item.service_status" :items="formattedStatusOptions"
            label="Status" item-value="id" item-title="status" class="mt-3" outlined
            @update:model-value="checkServiceStatusChange(item)">
          </v-select>
        </td>
        <td>
          <v-btn icon @click="openPaymentDialog(item)">
            <v-icon>mdi-credit-card</v-icon>
          </v-btn>
        </td>
        <td>
          <!-- Payment Status with Conditional Color -->
          <v-chip v-if="item.payment_details && item.payment_details[0]?.payment_status" :color="item.payment_details[0]?.payment_status.id === 2 ? 'green' :
            item.payment_details[0]?.payment_status.id === 3 ? 'orange' : 'red'" outlined
            small>
            {{ item.payment_details[0]?.payment_status.payment_status }}
          </v-chip>
          <span v-else style="font-size: 1.2em; font-weight: bold; color: #555;">
            N/A
          </span>
        </td>


        <td>
          <v-icon class="me-2" size="small" v-if="!isPaid(item)" @click="openEditDialog(item)">
            mdi-pencil
          </v-icon>
          <v-icon size="small" @click="openViewDialog(item)">
            mdi-eye
          </v-icon>
        </td>
      </tr>

      <!-- Display Message if No Data Available -->
      <tr v-else>
        <td :colspan="headers.length" class="text-center">
          No data available
        </td>
      </tr>
    </template>
  </v-data-table>

  <!-- New/Edit Dialog -->
  <v-dialog v-model="dialog" :max-width="dialogMode === 'edit' ? '500px' : '800px'" @click:outside="handleOutsideClick">
    <v-card>
      <v-card-title class="d-flex justify-space-between align-center py-2">
        <span class="text-h6">
          {{ dialogMode === 'new' ? 'New Item' : 'Edit Item' }}
        </span>
        <v-btn icon="mdi-close" variant="text" @click="closeDialog"></v-btn>
      </v-card-title>

      <v-card-text>
        <v-container>
          <!-- Existing Customer Checkbox -->
          <v-container>
            <v-checkbox v-if="dialogMode != 'edit'" v-model="isExistingCustomer" class="text-caption"
              label="Already a Customer">
            </v-checkbox>
          </v-container>

          <!-- Autocomplete for Existing Customers -->
          <v-autocomplete v-if="isExistingCustomer" v-model="selectedCustomer" :items="customerDetails"
            item-title="name" item-value="id" label="Search Customer" prepend-inner-icon="mdi-magnify" outlined
            hide-details class="text-caption" @update:model-value="handleCustomerSelection">
          </v-autocomplete>

          <v-row>
            <!-- First Card: Customer Details -->
            <v-col cols="12" md="6" v-if="dialogMode !== 'edit'">
              <v-card>
                <v-card-title class="text-body-2">Customer Details</v-card-title>
                <v-card-text>
                  <v-text-field v-model="editedItem.customerName" :readonly="isExistingCustomer" label="Customer Name*"
                    class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.phone" label="Phone*" :readonly="isExistingCustomer"
                    class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.email" :readonly="isExistingCustomer" label="Email"
                    class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.altPhone" :readonly="isExistingCustomer" label="Alternative Mobile"
                    class="text-body-2">
                  </v-text-field>
                </v-card-text>
              </v-card>
            </v-col>

            <!-- Second Card: Product Details -->
            <v-col :cols="dialogMode === 'edit' ? 12 : 12" :md="dialogMode === 'edit' ? 20 : 6"
              class="d-flex justify-center">
              <v-card class="w-100" outlined>
                <v-card-title class="text-body-2">Product Details</v-card-title>
                <v-card-text>
                  <v-text-field v-model="editedItem.productType" label="Product Type *" class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.productName" label="Product Name *" class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.model" label="Model" class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.serialNumber" label="Serial Number" class="text-body-2">
                  </v-text-field>
                  <v-text-field v-model="editedItem.date" label="Date *" type="date" class="text-body-2">
                  </v-text-field>
                  <v-textarea v-model="editedItem.issueDescription" label="Issue Description *" class="text-body-2">
                  </v-textarea>
                  <v-text-field v-model="editedItem.collectedItems" label="Other Collected Items" class="text-body-2">
                  </v-text-field>
                  <v-select v-if="dialogMode !== 'edit'" model="editedItem.statusId" :items="formattedStatusOptions" label="Status*"
                    item-value="id" item-title="status" outlined class="text-body-2">
                  </v-select>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn variant="text" @click="closeDialog" :disabled="isDisable" class="text-body-2">Cancel</v-btn>
        <v-btn color="primary" v-if="dialogMode === 'new'" :disabled="isDisable" @click="saveItem()"
          class="text-body-2">Save</v-btn>
        <v-btn color="primary" v-if="dialogMode === 'edit'" :disabled="isDisable" @click="updateItem()"
          class="text-body-2">Update</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- Payment Dialog -->
  <v-dialog v-model="paymentDialog" max-width="500px">
    <v-card>
      <v-card-title class="d-flex justify-space-between align-center">
        <div class="text-h5 text-medium-emphasis ps-2">Payment Details</div>
        <v-btn icon="mdi-close" variant="text" @click="closePaymentDialog"></v-btn>
      </v-card-title>

      <v-card-text>
        <!-- Total Amount -->
        <v-text-field v-model="paymentDetails.repair_cost" label="Repair Amount" outlined></v-text-field>

        <!-- Payment Status -->
        <v-select v-model="paymentDetails.status" :items="paymentStatus" item-title="payment_status" item-value="id"
          label="Payment Status" outlined :readonly="isPaymentReadOnly"></v-select>

        <!-- Advance/Partial Payments -->
        <div v-if="paymentDetails.status === 3 || paymentDetails.status === 4">
          <v-text-field v-model="paymentDetails.advance_amount" label="Advance Payment" type="number" outlined
            :readonly="isPaymentReadOnly" @input="calculateRemainingAmount"></v-text-field>
          <v-text-field v-model="paymentDetails.remaining_amount" label="Remaining Amount" readonly
            outlined></v-text-field>
        </div>

        <!-- Full Payment -->
        <div v-if="paymentDetails.status === 2 || paymentDetails.status === 3">
          <v-text-field v-model="paymentDetails.payment_date" label="Payment Date" type="date" outlined
            :readonly="isPaymentReadOnly"></v-text-field>
          <v-select v-model="paymentDetails.payment_mode" :items="paymentModes" label="Payment Mode" item-title="mode"
            item-value="id" outlined :readonly="isPaymentReadOnly"></v-select>
        </div>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <template v-if="!isPaymentReadOnly">
          <v-btn variant="text" :disabled="isDisable" @click="closePaymentDialog">Cancel</v-btn>
          <v-btn color="primary" :disabled="isDisable" @click="savePaymentDetails">Save</v-btn>
        </template>
        <template v-if="isPaymentReadOnly">
          <v-btn variant="text" @click="closePaymentDialog">Close</v-btn>
        </template>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- view Dealers Dialog -->

  <v-dialog v-model="dealersDialog" max-width="500px">
    <v-card>
      <v-card-title class="d-flex justify-space-between align-center">
        <div class="text-h5 text-medium-emphasis ps-2">
          Dealers Details
        </div>
        <v-btn icon="mdi-close" variant="text" @click="closeDealersDialog"></v-btn>
      </v-card-title>

      <v-card-text>
        <!-- Dealer Selection -->
        <v-select v-model="dealersData.dealer_id" :items="dealers" item-title="name" item-value="id"
          label="Select Dealer" outlined density="compact" :clearable="!disableDealer"
          :readonly="disableDealer"></v-select>

        <!-- Product Description -->
        <v-textarea v-model="dealersData.product_description" :readonly="isDealersReadOnly" label="Product Description"
          outlined density="compact"></v-textarea>

        <!-- Product Status -->
        <v-select v-model="dealersData.status_id" :items="dealersStatus" label="Product Status" item-title="status"
          item-value="id" outlined density="compact" :readonly="isDealersReadOnly"></v-select>

        <!-- Payment Status -->
        <v-select v-model="dealersData.payment_status_id" :items="filteredPaymentStatus" label="Payment Status"
          item-title="payment_status" item-value="id" outlined density="compact"
          :readonly="isDealersReadOnly"></v-select>

        <!-- Amount (Only if payment status is 'Paid') -->
        <v-text-field v-if="dealersData.payment_status_id === 2" v-model="dealersData.amount" label="Amount"
          type="number" outlined density="compact" :readonly="isDealersReadOnly"></v-text-field>

        <!-- Payment Date (Only if payment status is 'Paid') -->
        <v-text-field v-if="dealersData.payment_status_id === 2" v-model="dealersData.amount_received_date"
          label="Payment Date" type="date" :readonly="isDealersReadOnly" outlined density="compact"></v-text-field>

        <v-select v-if="dealersData.payment_status_id === 2" v-model="dealersData.payment_mode" :items="paymentModes" label="Payment Mode" item-title="mode"
          item-value="id" outlined :readonly="isPaymentReadOnly"></v-select>

      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <template v-if="!isDealersReadOnly">
          <v-btn variant="text" @click="closeDealersDialog" :disabled="disableDealerButton">Cancel</v-btn>
          <v-btn color="primary" @click="saveDealersDetails" :disabled="disableDealerButton">Save</v-btn>
        </template>
        <template v-else-if="isDealersReadOnly">
          <v-btn variant="text" @click="closeDealersDialog">Cancel</v-btn>
        </template>
      </v-card-actions>
    </v-card>
  </v-dialog>


  <!-- View Dialog -->
  <v-dialog v-model="viewDialog" max-width="900px">
    <v-card>
      <v-card-title class="d-flex justify-space-between align-center">
        <div class="text-h5 text-medium-emphasis ps-2">
          Customer Details
        </div>
        <v-btn icon="mdi-close" variant="text" @click="viewDialog = false"></v-btn>
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <v-container>
          <!-- Customer Information -->
          <v-row dense class="mb-4">
            <v-col cols="12" md="4">
              <strong>Customer Name:</strong>
              <div class="mt-1">{{ editedItem.customerName || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Phone:</strong>
              <div class="mt-1">{{ editedItem.phone || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Email:</strong>
              <div class="mt-1">{{ editedItem.email || 'N/A' }}</div>
            </v-col>
          </v-row>

          <!-- Alternative Information -->
          <v-row dense class="mb-4">
            <v-col cols="12" md="4">
              <strong>Alternative Phone:</strong>
              <div class="mt-1">{{ editedItem.altPhone || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Product Type:</strong>
              <div class="mt-1">{{ editedItem.productType || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Product Name:</strong>
              <div class="mt-1">{{ editedItem.productName || 'N/A' }}</div>
            </v-col>
          </v-row>

          <!-- Additional Product Information -->
          <v-row dense class="mb-4">
            <v-col cols="12" md="4">
              <strong>Model:</strong>
              <div class="mt-1">{{ editedItem.model || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Serial Number:</strong>
              <div class="mt-1">{{ editedItem.serialNumber || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Date:</strong>
              <div class="mt-1">{{ editedItem.date || 'N/A' }}</div>
            </v-col>
          </v-row>

          <!-- Status and Issue Description -->
          <v-row dense class="mb-4">
            <v-col cols="12" md="4">
              <strong>Status:</strong>
              <div class="mt-1">{{ editedItem.status || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="8">
              <strong>Issue Description:</strong>
              <div class="mt-1">{{ editedItem.issueDescription || 'N/A' }}</div>
            </v-col>
          </v-row>

          <!-- Payment Information -->
          <v-row dense v-if="editedItem.paymentDetails" class="mb-4">
            <v-col cols="12" md="4">
              <strong>Repair Amount:</strong>
              <div class="mt-1">{{ editedItem.paymentDetails.repair_cost || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Paid Amount:</strong>
              <div class="mt-1">{{ editedItem.paymentDetails.paid_amount || 'N/A' }}</div>
            </v-col>
            <v-col cols="12" md="4">
              <strong>Payment Status:</strong>
              <div class="mt-1">{{ editedItem.paymentDetails.status || 'N/A' }}</div>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-divider></v-divider>
      <v-card-actions class="justify-end">
        <v-btn color="primary" @click="viewDialog = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>


</template>

<script>
import Toastify from "toastify-js";
import moment from 'moment';

export default {
  mounted() {
    this.fetchProductStatus();
    this.fetchPaymentStatus();
    this.fetchPaymentModes();
    this.fetchCustomerDetails();
    this.fetchDealers();
    this.fetchDealersStatus();
    this.fetchServiceProductDetails();
    
  },
  data: () => ({
    phoneNumberRule: (value) =>
      /^\d{10}$/.test(value) || "Phone number must be exactly 10 digits.",

    viewDialog: false,
    isDealersReadOnly: false,
    disableDealer : false,
    isDisable: false,
    isExistingCustomer: false,
    search: '',
    selectedCustomer: null,
    dialog: false,
    isLoading: false,
    dialogMode: 'new',
    paymentDialog: false,
    customerDetails: [],
    headers: [
      { title: 'Service ID', key: 'service_id' },
      { title: 'Customer Name', key: 'customer.name' },
      { title: 'Product Type', key: 'product_type' },
      { title: 'Product Name', key: 'product_name' },
      { title: 'Date', key: 'product_received_date' },
      { title: 'Dealers', key: 'payment', sortable: false },
      { title: 'Status', key: 'status', sortable: false },
      { title: 'Payment', key: 'payment', sortable: false },
      { title: 'Payment Status', key: 'paymentStatus', sortable: false, },
      { title: 'Actions', key: 'actions', sortable: false, },
    ],
    service_status: [],
    selectedStatus: null,
    isPaymentReadOnly: false,
    disableDealerButton: false,
    paymentStatus: [],
    records: [],
    editedItem: {
      customerId: '',
      id: '',
      customerName: '',
      phone: '',
      email: '',
      altPhone: '',
      productType: '',
      productName: '',
      model: '',
      serialNumber: '',
      date: '',
      issueDescription: '',
      collectedItems: '',
      status: '',
      statusId: '',
      paymentDetails: {
        repair_cost: '',
        advance_amount: '',
        remaining_amount: '',
        date: '',
        mode: '',

      },
    },
    defaultItem: {
      customerId: '',
      customerName: '',
      phone: '',
      email: '',
      altPhone: '',
      productType: '',
      productName: '',
      model: '',
      serialNumber: '',
      date: '',
      issueDescription: '',
      collectedItems: '',
      status: '',
      statusId: '',
    },
    paymentDetails: {
      repair_cost: '',
      advance_amount: '',
      remaining_amount: '',
      paid_amount: '',
      status: '',
      payment_date: '',
      payment_mode: '',
      customer_id: '',
      service_id: '',
    },
    paymentModes: [],
    dealers: [],
    dealersDialog: false,
    dealersData: {
        dealer_id: null,
        service_id : null,
        product_description: '',
        status_id: null,
        payment_mode : '',
        payment_status_id : null,
        amount : '',
        amount_received_date : '', 
    },
    dealersStatus: [],
  }),
  computed: {
    formattedStatusOptions() {
      return this.service_status;
    },
    filteredPaymentStatus() {
      const hasId3 = this.paymentStatus.some((status) => status.id === 3);
      return hasId3
        ? this.paymentStatus.filter((status) => status.id !== 3)
        : this.paymentStatus;
    },
    filteredRecords() {
      return this.records.filter((record) => {
        const matchesStatus =
          this.selectedStatus === null || record.service_status === this.selectedStatus;
        const matchesSearch =
          this.search === '' ||
          record.service_id.toString().includes(this.search) ||
          record.customer.name.toLowerCase().includes(this.search.toLowerCase()) ||
          record.product_name.toLowerCase().includes(this.search.toLowerCase());
        return matchesStatus && matchesSearch;
      });
    },
  },
  watch: {
    isExistingCustomer(newVal) {
      if (!newVal) {
        this.resetForm();
      }
    },
    'paymentDetails.repair_cost'(newValue) {
      if (!newValue) {
        this.paymentDetails.advance_amount = null;
        this.paymentDetails.remaining_amount = null;
      } else {
        this.calculateRemainingAmount();
      }
    },
  },

  methods: {
    handleOutsideClick() {
      if (this.dialogMode === 'new') {
        this.resetForm();
        this.dialog = false;
      }
    },
    calculateRemainingAmount() {
      const total = parseFloat(this.paymentDetails.repair_cost || 0);
      const advance = parseFloat(this.paymentDetails.advance_amount || 0);
      this.paymentDetails.remaining_amount = total > advance ? total - advance : 0;

      if (advance > total) {
        Toastify({
          text: "Advance payment cannot exceed total amount.",
          backgroundColor: "red",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
          close: true,
        }).showToast();
        this.paymentDetails.advance_amount = 0;
      }
    },
    isPaid(item) {
      return item.payment_details && item.payment_details[0]?.payment_status.payment_status === 'Paid' && item.service_status === 3;
    },
    formattedServiceStatus(id) {
      const filteredStatus = this.service_status.find((item) => item.id === id);
      return filteredStatus ? filteredStatus.status : null;
    },
    checkServiceStatusChange(item) {
      
    if (
      item.latest_dealer_detail?.status_id === 1 &&
      (item.service_status === 3 || item.service_status === 4)
    ) {
      // Reset the dropdown to the previous value
      item.service_status = item.previousServiceStatus || item.service_status;

      // Show error message
      Toastify({
        text: "Status cannot be changed because the dealer status is pending.",
        backgroundColor: "red",
        className: "text-light",
        duration: 3000,
        gravity: "top",
        position: "right",
        close: true,
      }).showToast();
      this.fetchServiceProductDetails();
      return;
    }

    // Save the current value for future rollback if needed
    item.previousServiceStatus = item.service_status;

    // Proceed with the status update
    this.updateServiceStatus(item);
  },

  async updateServiceStatus(item) {
    try {
      const response = await axios.put(`/service-status/${item.id}`, {
        status_id: item.service_status,
      });
      this.fetchServiceProductDetails();
      Toastify({
        text: "Status updated successfully.",
        backgroundColor: "green",
        className: "text-light",
        duration: 3000,
        gravity: "top",
        position: "right",
        close: true,
      }).showToast();
    } catch (error) {
      this.fetchServiceProductDetails();
    }
  },


    openNewItemDialog() {
      this.dialogMode = 'new';
      this.dialog = true;
      this.editedItem = { ...this.defaultItem };
    },
    handleCustomerSelection(value) {
      if (!value) {
        this.resetForm();
      } else {
        this.populateCustomerDetails(value);
      }
    },
    async fetchProductStatus() {
      try {
        const response = await axios.get('/fetch-service-status');
        this.service_status = response.data;
      } catch (error) {
      }
    },
    async fetchDealersStatus() {
      try {
        const response = await axios.get('/fetch-dealers-status');
        this.dealersStatus = response.data;
      } catch (error) {
      }
    },
    async fetchDealers() {
      try {
        const response = await axios.get("/dealers");
        this.dealers = response.data;
      } catch (error) {
      }
    },
    async fetchPaymentModes() {
      try {
        const response = await axios.get('/fetch-payment-modes');
        this.paymentModes = response.data;
      } catch (error) {
      }
    },
    populateCustomerDetails() {
      if (this.isExistingCustomer && this.selectedCustomer) {
        const customer = this.customerDetails.find(
          (item) => item.id === this.selectedCustomer
        );
        if (customer) {
          this.editedItem.customerName = customer.name;
          this.editedItem.phone = customer.phone_number;
          this.editedItem.email = customer.email;
          this.editedItem.altPhone = customer.alternate_phone_number;
        }
      }
    },
    async fetchServiceProductDetails() {
      this.isLoading = true;
      try {
        const response = await axios.get('/service-details');
        this.records = response.data.data;
        this.isLoading = false;
      } catch (error) {
        this.isLoading = false;
      }
    },
    async fetchCustomerDetails() {
      try {
        const response = await axios.get('/customers');
        this.customerDetails = response.data.data;
      } catch (error) {
      }
    },
    async fetchPaymentStatus() {
      try {
        const response = await axios.get('/fetch-payment-status');
        this.paymentStatus = response.data;
      } catch (error) {
      }
    },
    async saveItem() {
      const payload = {
        customer_name: this.editedItem.customerName,
        phone: this.editedItem.phone,
        email: this.editedItem.email,
        altPhone: this.editedItem.altPhone,
        productType: this.editedItem.productType,
        productName: this.editedItem.productName,
        model: this.editedItem.model,
        serialNumber: this.editedItem.serialNumber,
        issueDescription: this.editedItem.issueDescription,
        date: this.editedItem.date,
        collectedItems: this.editedItem.collectedItems,
        status: this.editedItem.statusId,
        selectedCustomer: this.selectedCustomer,
      };
      this.isDisable = true;
      try {
        const response = await axios.post('/store-product-service-details', payload);
        this.closeDialog();
        this.isDisable = false;
        Toastify({
          text: "Data saved successfully.",
          backgroundColor: "green",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
        }).showToast();
        this.fetchServiceProductDetails();
        this.fetchCustomerDetails();
      } catch (error) {
        this.isDisable = false;
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
          Toastify({
            text: "Failed to save data. Please try again.",
            backgroundColor: "red",
            className: "text-light",
            duration: 3000,
            gravity: "top",
            position: "right",
          }).showToast();
        }
      }
    },
    updateItem() {
      const payload = {
        id: this.editedItem.id,
        product_type: this.editedItem.productType,
        product_name: this.editedItem.productName,
        model_number: this.editedItem.model,
        serial_number: this.editedItem.serialNumber,
        description: this.editedItem.issueDescription,
        product_received_date: this.editedItem.date,
        other_collected_item: this.editedItem.collectedItems,
        service_status: this.editedItem.statusId,
      };
      this.isDisable = true;
      const url = `/products/${payload.id}`;
      axios
        .put(url, payload)
        .then((response) => {
          this.isDisable = false;
          Toastify({
            text: "Record updated successfully.",
            backgroundColor: "green",
            className: "text-light",
            duration: 3000,
            gravity: "top",
            position: "right",
          }).showToast();
          this.closeDialog();
          this.fetchServiceProductDetails();
        })
        .catch((error) => {
          this.isDisable = false;
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
            Toastify({
              text: "Failed to Update data. Please try again.",
              backgroundColor: "red",
              className: "text-light",
              duration: 3000,
              gravity: "top",
              position: "right",
            }).showToast();
          }
        });
    },
    openEditDialog(item) {
      this.resetForm();
      this.dialogMode = 'edit';
      this.editedItem = {
        id: item.id,
        productType: item.product_type,
        productName: item.product_name,
        model: item.model_number,
        serialNumber: item.serial_number,
        date: moment(item.product_received_date).format('YYYY-MM-DD'),
        issueDescription: item.description,
        collectedItems: item.other_collected_item,
        statusId: item.service_status,
      };
      this.dialog = true;
    },
    openViewDialog(item) {
      this.resetEditedItem();
      this.editedItem = {
        customerId: item.customer.id,
        customerName: item.customer.name,
        email: item.customer.email,
        phone: item.customer.phone_number,
        altPhone: item.customer.alternate_phone_number,
        productName: item.product_name,
        productType: item.product_type,
        serialNumber: item.serial_number,
        model: item.model_number,
        collectedItems: item.other_collected_item,
        issueDescription: item.description,
        date: item.product_received_date,
        status: this.formattedServiceStatus(item.service_status),
        paymentDetails: {
          repair_cost: item.payment_details[0]?.repair_cost || '',
          paid_amount: item.payment_details[0]?.paid_amount || '',
          date: item.payment_details[0]?.payment_date || '',
          status: item.payment_details[0]?.payment_status.payment_status || '',
        }
      }
      this.viewDialog = true;
    },
    resetEditedItem() {
      this.editedItem = {
        customerId: '',
        customerName: '',
        email: '',
        phone: '',
        altPhone: '',
        productName: '',
        productType: '',
        serialNumber: '',
        model: '',
        collectedItems: '',
        issueDescription: '',
        date: '',
        status: '',
        paymentDetails: {
          amount: '',
          date: '',
          status: ''
        }
      };
    },
    openPaymentDialog(item) {
      this.paymentDetails = {
        repair_cost: item.payment_details[0]?.repair_cost || '',
        remaining_amount: item.payment_details[0]?.remaining_amount || '',
        advance_amount: item.payment_details[0]?.advance_amount || '',
        paid_amount: item.payment_details[0]?.paid_amount || '',
        status: item.payment_details[0]?.payment_status.id || '',
        payment_date: item.payment_details[0]?.payment_date
          ? moment(item.payment_details[0].payment_date).format('YYYY-MM-DD')
          : '',
        payment_mode: item.payment_details[0]?.payment_mode || '',
        customer_id: item.customer_id || null,
        service_id: item.id || null,
      };
      this.isPaymentReadOnly = item.payment_details[0]?.payment_status?.id === 2;
      this.paymentDialog = true;
    },
    openDealersDialog(item) {
      this.dealersData = {
        dealer_id: item.latest_dealer_detail?.dealer_id || null,
        product_description: item.latest_dealer_detail?.product_description || '',
        status_id: item.latest_dealer_detail?.status_id || null,
        amount: item.latest_dealer_detail?.amount || '',
        amount_received_date: item.latest_dealer_detail?.amount_received_date || '',
        payment_status_id: item.latest_dealer_detail?.payment_status_id || null,
        payment_mode: item.latest_dealer_detail?.payment_mode || null,
        service_id: item.id || null,
      };
      this.dealersDialog = true;
      this.disableDealer = item.latest_dealer_detail?.dealer_id ? true : false;
      this.isDealersReadOnly= item.payment_details && item.service_status === 3;
    },
    closeDealersDialog(){
      this.dealersDialog =false;
    },
    closeDialog() {
      this.dialog = false;
      this.resetForm();
    },
    resetForm() {
      this.isExistingCustomer = false;
      this.selectedCustomer = null;
      this.editedItem = {
        customerName: '',
        phone: '',
        email: '',
        altPhone: '',
        productType: '',
        productName: '',
        model: '',
        serialNumber: '',
        date: '',
        issueDescription: '',
        collectedItems: '',
        status: '',
        statusId: '',
      };
    },
    closePaymentDialog() {
      this.paymentDialog = false;
    },
    async savePaymentDetails() {
      if (this.paymentDetails.status === 2) {
      // Full payment
      this.paymentDetails.paid_amount = this.paymentDetails.repair_cost;
      this.paymentDetails.remaining_amount = 0; // No remaining amount
    } else if (this.paymentDetails.status === 1) {
      // Payment not started
      this.paymentDetails.paid_amount = null;
      this.paymentDetails.remaining_amount = this.paymentDetails.repair_cost; // Entire amount remaining
    } else if (this.paymentDetails.status === 3 || this.paymentDetails.status === 4) {
      // Partial or advance payment
      if (!this.paymentDetails.advance_amount) {
        this.paymentDetails.advance_amount = 0; // Default to 0 if not set
      }
      this.paymentDetails.paid_amount = this.paymentDetails.advance_amount;
    }
      const payload = {
        repair_cost: this.paymentDetails.repair_cost,
        paid_amount: this.paymentDetails.paid_amount,
        advance_amount: this.paymentDetails.advance_amount,
        remaining_amount: this.paymentDetails.remaining_amount,
        payment_status: this.paymentDetails.status,
        payment_date: this.paymentDetails.payment_date,
        payment_mode: this.paymentDetails.payment_mode,
        product_service_id: this.paymentDetails.service_id,
        customer_id: this.paymentDetails.customer_id,
      };
      try {
        this.isDisable = true;
        const response = await axios.get('/payment-details', {
          params: {
            service_id: this.paymentDetails.service_id,
            customer_id: this.paymentDetails.customer_id,
          },
        });

        if (response.data.exists && response.data.data) {
          this.isDisable = true;
          try {
            const updateResponse = await axios.put(
              `/payment-details/${response.data.data.id}`,
              payload
            );
            this.fetchServiceProductDetails();
            this.closePaymentDialog();
            this.isDisable = false;
            Toastify({
              text: "data updated successfully",
              backgroundColor: "green",
              className: "text-light",
              duration: 3000,
              gravity: "top",
              position: "right",
            }).showToast();
          } catch (error) {
            this.isDisable = false;
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
              Toastify({
                text: "Failed to Update data. Please try again.",
                backgroundColor: "red",
                className: "text-light",
                duration: 3000,
                gravity: "top",
                position: "right",
              }).showToast();
            }
          }
        } else {
          this.isDisable = true;
          try {
            const createResponse = await axios.post('/payment-details', payload);
            this.fetchServiceProductDetails();
            this.closePaymentDialog();
            this.isDisable = false;
            Toastify({
              text: "data saved successfully",
              backgroundColor: "green",
              className: "text-light",
              duration: 3000,
              gravity: "top",
              position: "right",
            }).showToast();
          } catch (error) {
            this.isDisable = false;
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
              Toastify({
                text: "Failed to save data. Please try again.",
                backgroundColor: "red",
                className: "text-light",
                duration: 3000,
                gravity: "top",
                position: "right",
              }).showToast();
            }
          }
        }
      } catch (error) {
        this.isDisable = false;
        Toastify({
          text: "Something went wrong.",
          backgroundColor: "red",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
        }).showToast();
      }
    },
    async saveDealersDetails() {
      this.disableDealerButton = true;
      try {
        // Check if the dealer details already exist
        const response = await axios.get('/dealers-details', {
          params: {
            service_id: this.dealersData.service_id,
            dealer_id: this.dealersData.dealer_id,
          },
        });

        // If the dealer exists, update the record
        if (response.data.exists && response.data.data) {
          // Set the ID of the existing dealer to update
          this.dealersData.id = response.data.data.id;

          // Proceed to update
          await this.updateDealersDetails();
        } else {
          // Dealer does not exist, create a new record
          await this.createDealersDetails();
        }
        this.disableDealerButton = false;
      } catch (error) {
        Toastify({
          text: "Something went wrong.",
          backgroundColor: "red",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
        }).showToast();
      }
    },

    // Create dealer details method
    async createDealersDetails() {
      // this.disableDealerButton = true;
      try {
        const createResponse = await axios.post('/dealers-details', this.dealersData);

        // Show success message
        Toastify({
          text: "Dealer details saved successfully!",
          backgroundColor: "green",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
        }).showToast();

        this.closeDealersDialog();
        this.fetchServiceProductDetails();
      } catch (error) {
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

    // Update dealer details method
    async updateDealersDetails() {
      try {
        const updateResponse = await axios.put(`/dealers-details/${this.dealersData.id}`, this.dealersData);

        // Show success message
        Toastify({
          text: "Dealer details updated successfully!",
          backgroundColor: "green",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
        }).showToast();

        this.closeDealersDialog();
        this.fetchServiceProductDetails();
      } catch (error) {
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
    

  },
};
</script>

<style scoped>
.text-danger {
  color: red;
}

.v-card-title {
  font-weight: bold;
}

.text-body-2 {
  font-size: 12px;
  /* Smaller font size */
}

.text-caption {
  font-size: 10px;
  /* Extra small font size for less prominent text */
}

.read-only-column {
  pointer-events: none;
  /* Disable pointer interactions */
  background-color: #f9f9f9;
  /* Subtle background for clarity */
}

.v-text-field[readonly] .v-input__control,
.v-textarea[readonly] .v-input__control {
  cursor: default;
  /* Indicate no interaction allowed */
}

.v-card-title {
  color: #3F51B5;
}

.v-col {
  padding-left: 16px;
  /* Add space to the left */
  padding-right: 16px;
  /* Add space to the right */
}

.v-row {
  margin-bottom: 16px;
  /* Add space between rows */
}

.read-only-column {
  background-color: #f9f9f9;
  border-radius: 4px;
  /* Optional for better design */
}

.toast-close {
  color: white;
  font-size: 16px;
  margin-left: 10px;
  cursor: pointer;
}
.full-width {
  width: 100%;
}

@media (max-width: 600px) {
  .full-width {
    width: calc(100% - 16px); /* Adjust padding if needed */
  }
}
</style>
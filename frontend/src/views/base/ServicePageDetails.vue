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
        <td>{{ item.product_recieved_date }}</td>
        <!-- <td>{{ item.payment_mode }}</td> -->
        <!-- <td>{{ item.payment_date }}</td> -->
        <td>
          <v-select :readonly="isPaid(item)" v-model="item.service_status" :items="formattedStatusOptions"
            label="Status" item-value="id" item-title="status" class="mt-3" outlined
            @update:model-value="updateServiceStatus(item)">
          </v-select>
        </td>
        <td>
          <v-btn icon @click="openPaymentDialog(item)">
            <v-icon>mdi-credit-card</v-icon>
          </v-btn>
        </td>
        <td>
          <!-- Payment Status with Conditional Color -->
          <v-chip v-if="item.payment_details && item.payment_details[0]?.payment_status"
            :color="item.payment_details[0]?.payment_status.payment_status === 'Paid' ? 'green' : 'red'" outlined small>
            {{ item.payment_details[0].payment_status.payment_status }}
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
      <v-card-title>
        <span class="text-h5">{{ dialogMode === 'new' ? 'New Item' : 'Edit Item' }}</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-container>
            <v-checkbox v-if="dialogMode != 'edit'" v-model="isExistingCustomer"
              label="Already a Customer"></v-checkbox>
          </v-container>
          <v-autocomplete v-if="isExistingCustomer" v-model="selectedCustomer" :items="customerDetails"
            item-title="name" item-value="id" label="Search Customer" prepend-inner-icon="mdi-magnify" outlined
            hide-details @update:model-value="handleCustomerSelection"></v-autocomplete>

          <v-row>
            <!-- First Card: Customer Details -->
            <v-col cols="12" md="6" v-if="dialogMode !== 'edit'">
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
            <v-col :cols="dialogMode === 'edit' ? 12 : 12" :md="dialogMode === 'edit' ? 20 : 6"
              class="d-flex justify-center">
              <v-card class="w-100" outlined>
                <v-card-title>Product Details</v-card-title>
                <v-card-text>
                  <v-text-field v-model="editedItem.productType" label="Product Type *"></v-text-field>
                  <v-text-field v-model="editedItem.productName" label="Product Name *"></v-text-field>
                  <v-text-field v-model="editedItem.model" label="Model"></v-text-field>
                  <v-text-field v-model="editedItem.serialNumber" label="Serial Number"></v-text-field>
                  <v-text-field v-model="editedItem.date" label="Date *" type="date"></v-text-field>
                  <v-textarea v-model="editedItem.issueDescription" label="Issue Description *"></v-textarea>
                  <v-text-field v-model="editedItem.collectedItems" label="Collected Items"></v-text-field>
                  <v-select v-model="editedItem.statusId" :items="formattedStatusOptions" label="Status" item-value="id"
                    item-title="status" outlined></v-select>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn variant="text" @click="closeDialog" :disabled="isDisable">Cancel</v-btn>
        <v-btn color="primary" v-if="dialogMode === 'new'" :disabled="isDisable" @click="saveItem()">Save</v-btn>
        <v-btn color="primary" v-if="dialogMode === 'edit'" :disabled="isDisable" @click="updateItem()">Update</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- Payment Dialog -->
  <v-dialog v-model="paymentDialog" max-width="500px">
    <v-card>
      <v-card-title>Payment Details</v-card-title>
      <v-card-text>
        <v-text-field v-model="paymentDetails.amount" label="Amount" :readonly="isPaymentReadOnly"></v-text-field>
        <v-select v-model="paymentDetails.status" :items="paymentStatus" item-title="payment_status" item-value="id"
          label="Payment Status" outlined :readonly="isPaymentReadOnly"></v-select>
        <div v-if="paymentDetails.status === 2">
          <!-- Payment Date Field -->
          <v-text-field v-model="paymentDetails.payment_date" label="Payment Date" type="date" outlined
            :readonly="isPaymentReadOnly"></v-text-field>

          <!-- Payment Mode Dropdown -->
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
              <v-text-field v-model="editedItem.customerName" label="Customer Name" readonly outlined
                class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-text-field v-model="editedItem.phone" label="Phone" readonly outlined class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-text-field v-model="editedItem.email" label="Email" readonly outlined class="mb-3"></v-text-field>
            </v-col>
          </v-row>

          <!-- Alternative Information -->
          <v-row dense>
            <v-col cols="4">
              <v-text-field v-model="editedItem.altPhone" label="Alternative Phone" readonly outlined
                class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-text-field v-model="editedItem.productType" label="Product Type" readonly outlined
                class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-text-field v-model="editedItem.productName" label="Product Name" readonly outlined
                class="mb-3"></v-text-field>
            </v-col>
          </v-row>

          <!-- Additional Product Information -->
          <v-row dense>
            <v-col cols="4">
              <v-text-field v-model="editedItem.model" label="Model" readonly outlined class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-text-field v-model="editedItem.serialNumber" label="Serial Number" readonly outlined
                class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="4">
              <v-text-field v-model="editedItem.date" label="Date" readonly outlined class="mb-3"></v-text-field>
            </v-col>
          </v-row>

          <!-- Description with More Space -->
          <v-row dense>
            <v-col cols="4">
              <v-text-field v-model="editedItem.status" label="Status" readonly outlined class="mb-3"></v-text-field>
            </v-col>
            <v-col cols="8">
              <v-textarea v-model="editedItem.issueDescription" label="Issue Description" rows="5" readonly outlined
                class="mb-3"></v-textarea>
            </v-col>
          </v-row>

          <!-- Payment Information -->
          <v-row dense>
            <v-col cols="4" v-if="editedItem.paymentDetails.amount">
              <v-text-field v-model="editedItem.paymentDetails.amount" label="Amount" readonly outlined
                class="mb-3"></v-text-field>
            </v-col>

            <v-col cols="4" v-if="editedItem.paymentDetails.status">
              <v-text-field v-model="editedItem.paymentDetails.status" label="Payment Status" readonly outlined
                class="mb-3"></v-text-field>
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
import Toastify from "toastify-js";
import moment from 'moment';

export default {
  mounted() {
    this.fetchProductStatus();
    this.fetchPaymentStatus();
    this.fetchPaymentModes();
    this.fetchCustomerDetails();
    this.fetchServiceProductDetails();
  },
  data: () => ({
    phoneNumberRule: (value) =>
      /^\d{10}$/.test(value) || "Phone number must be exactly 10 digits.",

    viewDialog: false,
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
      { title: 'Date', key: 'product_recieved_date' },
      { title: 'Status', key: 'status', sortable: false },
      { title: 'Payment', key: 'payment', sortable: false },
      { title: 'Payment Status', key: 'paymentStatus', sortable: false, },
      { title: 'Actions', key: 'actions', sortable: false, },
    ],
    service_status: [],
    selectedStatus: null,
    isPaymentReadOnly: false,
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
        amount: '',
        status: '',
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
      amount: '',
      status: '',
      payment_date: '',
      payment_mode: '',
      customer_id: '',
      service_id: '',
    },
    paymentModes: [],
  }),
  computed: {
    formattedStatusOptions() {
      return this.service_status;
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
  },

  methods: {
    handleOutsideClick() {
      if (this.dialogMode === 'new') {
        this.resetForm();
        this.dialog = false;
      }
    },
    isPaid(item) {
      return item.payment_details && item.payment_details[0]?.payment_status.payment_status === 'Paid' && item.service_status === 3;
    },
    formattedServiceStatus(id) {
      const filteredStatus = this.service_status.find((item) => item.id === id);
      return filteredStatus ? filteredStatus.status : null;
    },
    async updateServiceStatus(item) {
      try {
        const response = await axios.put(`/service-status/${item.id}`, {
          status_id: item.service_status,
        });
        this.fetchServiceProductDetails();
        Toastify({
          text: "status updated successfully.",
          backgroundColor: "green",
          className: "text-light",
          duration: 3000,
          gravity: "top",
          position: "right",
          close: true,
        }).showToast();
      } catch (error) {
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
        date: moment(item.product_recieved_date).format('YYYY-MM-DD'),
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
        date: item.product_recieved_date,
        status: this.formattedServiceStatus(item.service_status),
        paymentDetails: {
          amount: item.payment_details[0]?.amount || '',
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
        amount: item.payment_details[0]?.amount || '',
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
      const payload = {
        amount: this.paymentDetails.amount,
        payment_status: this.paymentDetails.status,
        payment_date: this.paymentDetails.payment_date,
        payment_mode: this.paymentDetails.payment_mode,
        product_service_id: this.paymentDetails.service_id,
        customer_id: this.paymentDetails.customer_id,
      };
      try {
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
  },
};
</script>

<style scoped>
.v-card-title {
  font-weight: bold;
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
</style>
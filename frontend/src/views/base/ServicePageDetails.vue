  <template>
    <div>
      <v-dialog max-width="500" v-model="reportGenerateDialogBox">
        <v-card :title="generateReportHeading">
          <v-card-text>
            <div class="mb-4">
              <v-text-field label="Start Date" v-model="reportFromDate" type="date" outlined></v-text-field>
            </div>
            <div>
              <v-text-field label="End Date" v-model="reportToDate" type="date" outlined></v-text-field>
            </div>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text @click="closeDialog()">Cancel</v-btn>
            <v-btn text @click="generateReport()"
              :disabled="this.reportFromDate == '' || this.reportToDate == ''">Generate</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      
      <!-- <template>
        <v-toolbar flat>
          <v-toolbar-title>Customer Details</v-toolbar-title>
          <v-btn color="primary" @click="openAddCustomerDialog">Add Customer</v-btn>
          <v-dialog v-model="addCustomerDialog" max-width="600px">
            <v-card>
              <v-card-title class="d-flex justify-space-between align-center">
                <span class="headline">Add New Customer</span>
                <v-btn icon="mdi-close" variant="text" @click="closeAddCustomerDialog"></v-btn>
              </v-card-title>
              <v-card-text>
                <v-form ref="form" v-model="formValid">
                  <v-text-field label="Payment Given Date" v-model="newCustomer.payment_given_date" outlined type="date"
                    :value="newCustomer.payment_given_date"></v-text-field>
                  <v-select
                    label="Branch"
                    v-model="newCustomer.branch"
                    :items="branchOptions"
                    outlined
                  ></v-select>  
                  <v-text-field label="Customer Name" v-model="newCustomer.customer_name" outlined>
                  </v-text-field>
                  <v-text-field label="Contact Number" v-model="newCustomer.contact_no" outlined
                    :rules="[contactNumberRule]" @input="validateContactNumber" maxlength="10" type="tel">
                  </v-text-field>
                  <v-text-field label="Alt Contact Number" v-model="newCustomer.alt_contact_no" outlined
                    :rules="[contactNumberRule]" @input="validateContactNumber" maxlength="10" type="tel">
                  </v-text-field>
                  <v-textarea label="Address" v-model="newCustomer.address" outlined rows="3" Auto-grow>
                  </v-textarea>
                  <v-text-field label="Agreement From" v-model="newCustomer.agreement_from" outlined
                    type="date"></v-text-field>
                  <v-text-field label="Agreement To" v-model="newCustomer.agreement_to" outlined
                    type="date"></v-text-field>
                  <v-textarea label="Document" v-model="newCustomer.document" outlined rows="3" Auto-grow></v-textarea>
                  <v-text-field label="Paid Amount" type="number" v-model="newCustomer.paid_amount"
                    outlined></v-text-field>
                  <v-text-field label="Monthly Return" type="number" v-model="newCustomer.monthly_return"
                    outlined></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="closeAddCustomerDialog">Cancel</v-btn>
                <v-btn @click="saveCustomer()" :disabled="!formValid">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template> -->
      <v-data-table :headers="headers" v-model:search="search" :items="customers">
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Customer Details</v-toolbar-title>
            <v-btn color="primary" @click="openAddCustomerDialog">Add Customer</v-btn>
            <v-dialog v-model="addCustomerDialog" max-width="600px">
              <v-card>
                <v-card-title class="d-flex justify-space-between align-center">
                  <span class="headline">Add New Customer</span>
                  <v-btn icon="mdi-close" variant="text" @click="closeAddCustomerDialog"></v-btn>
                </v-card-title>
                <v-card-text>
                  <v-form ref="form" v-model="formValid">
                    <v-text-field label="Payment Given Date" v-model="newCustomer.payment_given_date" outlined
                      type="date" :value="newCustomer.payment_given_date"></v-text-field>
                    <v-select
                      label="Branch"
                      v-model="newCustomer.branch"
                      :items="branchOptions"
                      outlined
                    ></v-select>
                    <v-text-field label="Customer Name" v-model="newCustomer.customer_name" outlined>
                    </v-text-field>
                    <v-text-field label="Contact Number" v-model="newCustomer.contact_no" outlined
                      :rules="[contactNumberRule]" @input="validateContactNumber" maxlength="10" type="tel">
                    </v-text-field>
                    <v-text-field label="Alt Contact Number" v-model="newCustomer.alt_contact_no" outlined
                      :rules="[contactNumberRule]" @input="validateContactNumber" maxlength="10" type="tel">
                    </v-text-field>
                    <v-textarea label="Address" v-model="newCustomer.address" outlined rows="3" Auto-grow>
                    </v-textarea>
                    <v-text-field label="Agreement From" v-model="newCustomer.agreement_from" outlined
                      type="date"></v-text-field>
                    <v-text-field label="Agreement To" v-model="newCustomer.agreement_to" outlined
                      type="date"></v-text-field>
                    <v-textarea label="Document" v-model="newCustomer.document" outlined rows="3"
                      Auto-grow></v-textarea>
                    <v-text-field label="Paid Amount" type="number" v-model="newCustomer.paid_amount"
                      outlined></v-text-field>
                    <v-text-field label="Monthly Return" type="number" v-model="newCustomer.monthly_return"
                      outlined></v-text-field>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text @click="closeAddCustomerDialog">Cancel</v-btn>
                  <v-btn @click="saveCustomer()" :disabled="!formValid">Save</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
          <v-card-title class="d-flex align-center pe-2" v-if="!isLoading">
            <template v-if="!isLoading && filteredPaymentDetails.length > 0">
              <CButton color="info" style="color: white" @click="openDialog('exportExcel')">Export Excel</CButton>
              <v-spacer></v-spacer>
              <CButton color="warning" variant="outline" @click="openDialog('downloadPdf')">Download PDF</CButton>
            </template>
            <template v-if="!isLoading && !filteredPaymentDetails.length > 0">
              <v-spacer></v-spacer>
              <v-spacer></v-spacer>
            </template>
            <v-spacer></v-spacer>
            <v-select v-model="selectedPaymentStatusId"
              :items="[{ id: null, payment_status: 'All' }, ...paymentStatusOptions]" label="Payment Status"
              item-value="id" item-title="payment_status" outlined density="compact" variant="solo-filled" flat
              hide-details style="max-width: 200px; margin-right: 1rem;"></v-select>
            <v-text-field v-model="search" density="compact" label="Search" prepend-inner-icon="mdi-magnify"
              variant="solo-filled" flat hide-details single-line></v-text-field>
          </v-card-title>
        </template>
        <!-- Custom row for loading state -->
        <template v-slot:body="{ items }">
          <tr v-if="isLoading">
            <td :colspan="headers.length" class="text-center">
              <CSpinner color="primary" />
            </td>
          </tr>
          <tr v-else-if="items.length > 0" v-for="(item, index) in customers" :key="index">
            <td>{{ item.customer_id }}</td>
            <td>{{ item.payment_given_date || '-' }}</td>
            <!-- <td>{{ item.branch || '-' }}</td> -->
            <td>{{ item.customer_name || '-' }}</td>
            <td>{{ item.contact_no || '-' }}</td>
            <!-- <td>{{ item.alt_contact_no || '-' }}</td> -->
            <!-- <td>{{ item.address || '-' }}</td> -->
            <td>{{ item.agreement_from || '-' }}</td>
            <td>{{ item.agreement_to || '-' }}</td>
            <!-- <td>{{ item.document || '-' }}</td> -->
            <td>{{ item.paid_amount || '-' }}</td>
            <td>{{ item.monthly_return || '-' }}</td>
            <td>
              <v-btn icon @click="toggleSubmodule(item, index)"><v-icon>mdi-credit-card</v-icon></v-btn>
            </td>
            <td>{{ item.remaining_amount || '-' }}</td>
            <td>
              <v-chip :color="getColor(item.payment_status)">
                {{ item.payment_status }}
              </v-chip>
            </td>
            <td>
              <v-icon icon @click="viewCustomerDetails(item)">mdi-eye</v-icon>
              <v-icon icon @click="editCustomerDialog(item)">mdi-pencil</v-icon>
            </td>
          </tr>
          <tr v-else>
            <td :colspan="headers.length" class="text-center">
              No data available
            </td>
          </tr>
        </template>
      </v-data-table>

      <v-dialog v-model="submoduleVisible" max-width="800px">
        <v-card>
          <v-card-title>
            <span class="headline">Return History for {{ selectedCustomer.customer_name }}</span>
            <v-btn icon="mdi-close" variant="text" @click="submoduleVisible = false"></v-btn>
          </v-card-title>
          <v-card-text>
            <v-simple-table>
              <thead>
                <tr>
                  <th>Given Date</th>
                  <th>Given Amount</th>
                  <th>Pending Amount</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(row, rowIndex) in submoduleRows" :key="rowIndex">
                  <td><v-text-field v-model="row.givenDate" type="date" required></v-text-field></td>
                  <td><v-text-field v-model="row.givenAmount" type="number" required @input="updateTotal"></v-text-field></td>
                  <td><v-text-field v-model="row.pendingAmount" type="number" required></v-text-field></td> 
                  <td><v-textarea v-model="row.remarks" outlined rows="1" autogrow></v-textarea></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="1" class="text-right"><strong>Total:</strong></td>
                  <td colspan="3">
                    <strong>{{ totalGivenAmount }}</strong>
                  </td>
                </tr>
              </tfoot>
            </v-simple-table>
            <v-btn @click="addSubmoduleRow" color="primary">Add Row</v-btn>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="saveSubmoduleData" color="green">Save</v-btn>
            <v-btn @click="cancelSubmodule" color="red">Cancel</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="editCustomerDialogVisible" max-width="600px">
        <v-card>
          <v-card-title class="d-flex justify-space-between align-center">
            <span class="headline">Edit Customer</span>
            <v-btn icon="mdi-close" variant="text" @click="closeEditCustomerDialog"></v-btn>
          </v-card-title>

          <v-card-text>
            <v-form ref="editForm" v-model="formValid">
              <v-select
                label="Branch"
                v-model="selectedCustomer.branch"
                :items="branchOptions"
                outlined
              ></v-select>
              <v-text-field label="Customer Name" v-model="selectedCustomer.customer_name" outlined></v-text-field>
              <v-text-field label="Contact Number" v-model="selectedCustomer.contact_no" outlined maxlength="10"
                type="tel"></v-text-field>
              <v-text-field label="Alt Contact Number" v-model="selectedCustomer.alt_contact_no" outlined maxlength="10"
                type="tel"></v-text-field>
              <v-textarea label="Address" v-model="selectedCustomer.address" outlined rows="3" auto-grow></v-textarea>
              <v-text-field label="Agreement From" v-model="selectedCustomer.agreement_from" outlined
                type="date"></v-text-field>
              <v-text-field label="Agreement To" v-model="selectedCustomer.agreement_to" outlined
                type="date"></v-text-field>
              <v-textarea label="Document" v-model="selectedCustomer.document" outlined rows="3" Auto-grow></v-textarea>
              <v-text-field label="Paid Amount" type="number" v-model="selectedCustomer.paid_amount"
                outlined></v-text-field>
              <v-text-field label="Monthly Return" type="number" v-model="selectedCustomer.monthly_return"
                outlined></v-text-field>
            </v-form>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text @click="closeEditCustomerDialog">Cancel</v-btn>
            <v-btn @click="saveCustomerData" :disabled="!formValid">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog v-model="showReport" max-width="900px" height="500px">
        <v-card>
          <v-card-title class="d-flex justify-space-between align-center">
            <span class="headline">Customer Details</span>
            <v-btn icon="mdi-printer" variant="text" @click="printContent"></v-btn>
            <v-btn icon="mdi-close" variant="text" @click="showReport = false"></v-btn>
          </v-card-title>

          <v-card-text>
            <v-row>
              <v-col cols="12" sm="6">
                <div><strong>Customer ID:</strong> {{ selectedCustomer.customer_id }}</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div><strong>Branch:</strong> {{ selectedCustomer.branch }}</div>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" sm="6">
                <div><strong>Customer Name:</strong> {{ selectedCustomer.customer_name }}</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div><strong>Payment Given Date:</strong> {{ formatDate(selectedCustomer.payment_given_date) }}</div>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" sm="6">
                <div><strong>Contact Number:</strong> {{ selectedCustomer.contact_no }}</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div><strong>Alt Contact Number:</strong> {{ selectedCustomer.alt_contact_no }}</div>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" sm="6">
                <div><strong>Agreement From:</strong> {{ formatDate(selectedCustomer.agreement_from) }}</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div><strong>Agreement To:</strong> {{ formatDate(selectedCustomer.agreement_to) }}</div>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" sm="6">
                <div><strong>Paid Amount:</strong> {{ selectedCustomer.paid_amount }}</div>
              </v-col>
              <v-col cols="12" sm="6">
                <div><strong>Monthly Return:</strong> {{ selectedCustomer.monthly_return }}</div>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="12" sm="6">
                <div><strong>Document:</strong> {{ selectedCustomer.document }}</div>
              </v-col>
              <v-col cols="12" sm="5" style="word-wrap: break-word; overflow-wrap: break-word;">
                <div><strong>Address:</strong> {{ selectedCustomer.address }}</div>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-dialog>
    </div>
  </template>
<script>
import jsPDF from "jspdf";
import "jspdf-autotable";
import Toastify from "toastify-js";
export default {
  data() {
    return {
      reportFromDate: "",
      customers: [],
      picker: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      branchOptions: ["Test1", "Test2"],
      showReport: false,
      addCustomerDialog: false,
      submoduleVisible: false, // To toggle the visibility of the submodule dialog
      submoduleRows: [
      { givenDate: '', givenAmount: 0, pendingAmount: 0, remarks: '' },], // Stores the rows for the submodule table
      totalGivenAmount: 0, // To store the total of the "Given Amount"
      editCustomerDialogVisible: false, // Flag to control dialog visibility
      selectedCustomer: null,
      // selectedCustomerIndex: null,
      reportToDate: "",
      dialog: false,
      dialogAction: "",
      isLoading: false,
      search: '',
      selectedPaymentStatusId: null,
      colorMode: null,
      generateReportHeading: "",
      reportGenerateDialogBox: false,
      paymentStatusOptions: [],
      paymentDetails: [],
      formValid: false,
      newCustomer: {
        customer_id: '',
        payment_given_date: '',
        branch: '',
        customer_name: '',
        contact_no: '',
        alt_contact_no: '',
        address: '',
        agreement_from: '',
        agreement_to: '',
        document: '',
        paid_amount: '',
        monthly_return: '',
        return_history: '',
        remaining_amount: '',
        Action: '',
      },

      selectedCustomer: {
        payment_given_date: '',
        branch: '',
        customer_name: '',
        contact_no: '',
        alt_contact_no: '',
        address: '',
        agreement_from: '',
        agreement_to: '',
        document: '',
        paid_amount: null,
        monthly_return: null,
      },

      headers: [
        { title: 'Customer ID', value: 'customer_id' },
        { title: 'Payment Given Date', value: 'payment_given_date' },
        // { title: 'Branch', value: 'branch'},
        { title: 'Customer Name', value: 'customer_name' },
        { title: 'Contact Number', value: 'contact_no' },
        // { title: 'Alt Contact Number', value: 'alt_contact_no' },
        // { title: 'Address', value: 'address' },
        { title: 'Agreement From', value: 'agreement_from' },
        { title: 'Agreement To', value: 'agreement_to' },
        // { title: 'Document', value: 'document' },
        { title: 'Paid Amount', value: 'paid_amount' },
        { title: 'Monthly Return', value: 'monthly_return' },
        { title: 'Return History', value: 'return_history' },
        { title: 'Remaining Amount', value: 'remaining_amount' },
        { title: 'Payment Status', value: 'payment_status' },
        { title: 'Action', value: 'action' },
      ],

      contactNumberRule: [
        v => v.length === 10 || 'Contact number must be 10 digits.',
        v => /^\d+$/.test(v) || 'Contact number must only contain digits.'
      ],
    }
  },
  mounted() {
    this.getPaymentStatus();
    this.colorMode = localStorage.getItem('coreui-free-vue-admin-template-theme');
  },
  computed: {
    filteredPaymentDetails() {
      return this.paymentDetails.filter((item) => {
        const matchesSearch =
          !this.search || // No search input means all items match
          item.Customer_id.toLowerCase().includes(this.search.toLowerCase()) ||
          item.customer_name.toLowerCase().includes(this.search.toLowerCase()) ||
          item.payment_given_date.toLowerCase().includes(this.search.toLowerCase()) ||
          item.product_name.toLowerCase().includes(this.search.toLowerCase()) ||
          item.payment_mode.toLowerCase().includes(this.search.toLowerCase());

        const matchesPaymentStatus =
          !this.selectedPaymentStatusId || // No payment status selected means all items match
          item.payment_status_id === this.selectedPaymentStatusId;

        return matchesSearch && matchesPaymentStatus;
      });
    },
  },

  methods: {

    openAddCustomerDialog() {
      this.addCustomerDialog = true;
      if (!this.newCustomer.payment_given_date) {
        const currentDate = new Date();
        this.newCustomer.payment_given_date = currentDate.toISOString().split('T')[0]; // Default to today
      }
    },
    formatDate(date) {
      const d = new Date(date);
      const year = d.getFullYear();
      const month = ('0' + (d.getMonth() + 1)).slice(-2); // Month is zero-based
      const day = ('0' + d.getDate()).slice(-2);
      return `${year}-${month}-${day}`;
    },
    validateContactNumber() {
      if (this.newCustomer.contact_no.length > 10) {
        this.newCustomer.contact_no = this.newCustomer.contact_no.slice(0, 10); // Trim to 10 digits
      }
    },
    setPaymentGivenDate() {
      const currentDate = new Date();
      this.newCustomer.payment_given_date = this.formatDate(currentDate); // Set the formatted current date
      console.log(this.newCustomer.payment_given_date);
    },
    saveCustomer() {
      // Generate a new customer ID, or you could generate it via an API or other logic
      const newCustomerWithID = { ...this.newCustomer, payment_status: 'pending', customer_id: Date.now(), return_history: [] };


      // Add the customer to the customers list
      this.customers.push(newCustomerWithID);

      // Reset form after saving
      this.newCustomer = {
        payment_given_date: '',
        branch: '',
        customer_name: '',
        contact_no: '',
        alt_contact_no: '',
        address: '',
        agreement_from: '',
        agreement_to: '',
        document: '',
        paid_amount: 0,
        monthly_return: 0,
        return_history: '',
        remaining_amount: 0,
        payment_status: 'Pending',
      };

      // Optionally reset form validation status
      this.formValid = false;
      console.log(this.customers);
      this.closeAddCustomerDialog();
    },
    closeAddCustomerDialog() {
      this.addCustomerDialog = false;
      // Reset the form
      this.newCustomer = {
        customer_id: '',
        payment_given_date: '',
        branch: '',
        customer_name: '',
        contact_no: '',
        alt_contact_no: '',
        address: '',
        agreement_from: '',
        agreement_to: '',
        document: '',
        paid_amount: '',
        monthly_return: '',
        return_history: '',
      };
    },

    toggleSubmodule(customer, index) {
      this.selectedCustomer = customer;
      // this.selectedCustomerIndex = index;
      // Load the customer's return history into the submodule rows
      this.submoduleRows = customer.return_history.length > 0 ? [...customer.return_history] : [{
        givenDate: '',
        givenAmount: '',
        pendingAmount: '',
        remarks: ''
      }];
      
      this.submoduleVisible = true;

    },

    // Add a new row to the submodule table
    addSubmoduleRow() {
      this.submoduleRows.push({
        givenDate: '',
        givenAmount: '',
        pendingAmount: '',
        remarks: ''
      });
    },
    updateTotal() {
      // console.log(this.submoduleRows);
      this.totalGivenAmount = this.submoduleRows.reduce((total, row) => {
        return total + (parseFloat(row.givenAmount) || 0);
      }, 0);
      // Update the remaining amount in the main module
      if (this.selectedCustomer !== null) {
        
        const paidAmount = parseFloat(this.selectedCustomer.paid_amount) || 0;
        this.selectedCustomer.remaining_amount = paidAmount - this.totalGivenAmount;
      }
      this.updatePaymentStatus();
    },

    // Save the submodule data and store it in the submodule itself
    saveSubmoduleData() {
      this.updateTotal();
      // Update the customer's return_history with the entered data
      this.selectedCustomer.return_history = [...this.submoduleRows];
      // Optionally, log the saved data for demonstration
      console.log(this.selectedCustomer);
      console.log('Saved return history for customer:', this.selectedCustomer.customer_id);
      console.log(this.submoduleRows);
      this.cancelSubmodule();
    },


    // Cancel and close the submodule table dialog
    cancelSubmodule() {
      this.submoduleVisible = false;
      // this.submoduleRows = [{ givenDate: '', givenAmount: 0, pendingAmount: 0, remarks: '' }]; // Reset the rows when canceling
      this.totalGivenAmount = 0;
    },

    async getPaymentStatus() {
      try {
        const response = await axios.get('get-payment-status-details');
        this.paymentStatusOptions = response.data;
      } catch (error) {
        // console.log(error);
      }
    },

    updatePaymentStatus() {
      if (this.selectedCustomer !== null) {
        const customer = this.selectedCustomer;
        // Check if any row in the submodule satisfies the conditions
        const isPaymentDone = this.submoduleRows.some((row) => {
          const givenDate = new Date(row.givenDate);
          const currentMonth = new Date().getMonth();
          const currentYear = new Date().getFullYear();

          // Condition 1: Given Date is in the current month
          const isCurrentMonth =
            givenDate.getMonth() === currentMonth && givenDate.getFullYear() === currentYear;

          // Condition 2: Given Amount equals Monthly Return
          const isMatchingAmount = parseFloat(row.givenAmount) === parseFloat(customer.monthly_return);

          return isCurrentMonth && isMatchingAmount;
        });

        // Update payment status
        customer.payment_status = isPaymentDone ? "Paid" : "Pending";
      }
    },

    // Open the edit dialog and pre-fill with the selected customer's data
    editCustomerDialog(item) {
      this.selectedCustomer = { ...item }; // Create a copy of the selected customer
      this.editCustomerDialogVisible = true; // Show the dialog
    },

    closeEditCustomerDialog() {
      this.editCustomerDialogVisible = false;
    },
    saveCustomerData() {
      if (this.formValid) {
        // Update the customer data with the selected data
        this.updateMainModule(this.selectedCustomer);

        // Close the dialog after saving
        this.closeEditCustomerDialog();
      } else {
        console.log('Form is invalid');
      }
    },
    updateMainModule(updatedCustomer) {
      // This method updates the customer in the customers array based on the customer_id or any unique identifier
      const index = this.customers.findIndex(customer => customer.customer_id === updatedCustomer.customer_id);

      if (index !== -1) {
        // If the customer exists, update their data
        this.customers[index] = { ...this.customers[index], ...updatedCustomer };
      } else {
        // If the customer doesn't exist, add them as a new customer
        this.customers.push(updatedCustomer);
      }

      // Optionally, you can also send this updated data to an API if needed
      this.saveDataToBackend(updatedCustomer);
    },
    saveDataToBackend(customerData) {
      // This is where you would save the customer data to an API or database
      console.log('Saving customer data:', customerData);
      setTimeout(() => {
        console.log('Customer data saved successfully');
      }, 1000);
    },
    formatDate(date) {
      if (!date) return '';
      const d = new Date(date);
      const day = String(d.getDate()).padStart(2, '0');
      const month = String(d.getMonth() + 1).padStart(2, '0'); // Months are 0-based
      const year = d.getFullYear();
      return `${day}-${month}-${year}`;
    },
    // This method is triggered when the view button is clicked
    viewCustomerDetails(item) {
      // Set the selected customer data
      this.selectedCustomer = item;

      // Show the report dialog
      this.showReport = true;
    },

    // Method to trigger the print functionality for the specific content
    printContent() {
      const printContent = document.getElementById('printable-content');
      const printWindow = window.open('', '', 'height=600,width=800');

      // Add the content to the print window
      printWindow.document.write('<html><head><title>Customer Details</title></head><body>');
      printWindow.document.write(printContent.innerHTML);
      printWindow.document.write('</body></html>');

      // Print the content
      printWindow.document.close();
      printWindow.print();
    },

    getColor(value) {
      return value == 'Paid' ? 'green' : 'red';
    },
    formatDataBasedOnDates(fromDate, toDate,) {
      const fromDateObj = new Date(fromDate);
      const toDateObj = new Date(toDate);
      const filteredData = this.filteredPaymentDetails.filter(paymentDetail => {
        const paymentDate = new Date(paymentDetail.payment_given_date);
        return paymentDate >= fromDateObj && paymentDate <= toDateObj;
      });
      return filteredData;
    },

    showToastifyMessage() {
      Toastify({
        text: "No data available for the selected dates",
        backgroundColor: "red",
        className: "text-light",
        duration: 3000,
        gravity: "top",
        position: "right"
      }).showToast();
    },
    openDialog(actionType) {
      this.reportFromDate = "";
      this.reportToDate = "";
      if (actionType === 'exportExcel') {
        this.generateReportHeading = 'Export Excel';
      } else {
        this.generateReportHeading = 'Download PDF';
      }
      this.dialogAction = actionType;
      this.reportGenerateDialogBox = true;
    },

    closeDialog() {
      this.dialog = false;
    },
    generateReport() {
      if (this.dialogAction === 'exportExcel') {
        if (this.reportFromDate != "" && this.reportToDate != "") {
          this.exportExcel();
        }
      } else if (this.dialogAction === 'downloadPdf') {
        if (this.reportFromDate != "" && this.reportToDate != "") {
          this.downloadPdf();
        }
      }
      this.closeDialog();
    }
  },
  watch: {
    // Recalculate total whenever submoduleRows changes
    submoduleRows: {
      handler() {
        this.updateTotal();
      },
      deep: true,
    },
  },
}
</script>

<style scoped>
/* div {
  white-space: nowrap;
} */

.v-simple-table {
  width: 100%;
  width: 80%;
  max-width: 900px;
}
</style>



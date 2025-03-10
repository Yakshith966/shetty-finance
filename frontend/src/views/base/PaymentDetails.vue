<template>
  <div>
    <v-dialog max-width="500" v-model="reportGenerateDialogBox">
      <v-card :title="generateReportHeading">
        <v-card-text>
          <div class="mb-4">
            <v-text-field
              label="Start Date"
              v-model="reportFromDate"
              type="date"
              outlined
            ></v-text-field>
          </div>
          <div>
            <v-text-field
              label="End Date"
              v-model="reportToDate"
              type="date"
              outlined
            ></v-text-field>
          </div>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="closeDialog()">Cancel</v-btn>
          <v-btn text @click="generateReport()" :disabled="!reportFromDate || !reportToDate">
            Generate
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-data-table :headers="headers" :items="filteredPaymentDetails" v-model:search="search">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Petty Cash Management</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="success" @click="openAddPettyCashDialog">Add Petty Cash</v-btn>
          <v-dialog v-model="addPettyCashDialog" max-width="600px">
            <v-card>
              <v-card-title>
                <span class="text-h6">Add Petty Cash</span>
                <v-btn icon="mdi-close" variant="text" @click="closeAddPettyCashDialog"></v-btn>
              </v-card-title>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6">
                      <v-text-field label="Date" v-model="newPettyCash.date" type="date" readonly></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Addition Petty Cash"
                        v-model="newPettyCash.addition_petty_cash"
                        type="number"
                        @input="calculateTotal"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Deletion Petty Cash"
                        v-model="newPettyCash.deletion_petty_cash"
                        type="number"
                        @input="calculateTotal"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Excess Amount"
                        v-model="newPettyCash.excess_amount"
                        type="number"
                        @input="calculateTotal"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="G Pay/Phone Pay"
                        v-model="newPettyCash.gpay_phonepay"
                        type="number"
                        @input="calculateTotal"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field label="Total" v-model="newPettyCash.total" readonly></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="closeAddPettyCashDialog">Cancel</v-btn>
                <v-btn text color="success" @click="savePettyCashDetails">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>   

      <template v-slot:body="{ items }">
        <tr v-if="isLoading">
          <td :colspan="headers.length" class="text-center">
            <CSpinner color="primary" />
          </td>
        </tr>
        <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
          <td>{{ index + 1}}</td>
          <td>{{ item.month }}</td>
          <td>{{ item.addition_petty_cash  || '-'}}</td>
          <td>{{ item.deletion_petty_cash || '-'}}</td>
          <td>{{ item.excess_amount || '-'}}</td>
          <td>{{ item.gpay_phonepay || '-'}}</td>
          <td>{{ item.total || '-'}}</td>
          <td>
            <!-- <v-btn small color="primary" @click="handleEdit(item)">mdi-pencil</v-btn> -->
            <!-- <v-btn small color="error" @click="handleDelete(item)">Delete</v-btn> -->
            <v-icon icon @click="openEditSubmodule(item)">mdi-pencil</v-icon>
          </td>
        </tr>
        <tr v-else>
          <td :colspan="headers.length" class="text-center">
            No data available
          </td>
        </tr>
      </template>
      
    </v-data-table>
    <v-dialog v-model="editSubmoduleVisible" max-width="800px">
      <v-card>
        <v-card-title>
          <span class="headline">Edit Petty Cash - {{ selectedPettyCash.month }}</span>
          <v-btn icon="mdi-close" variant="text" @click="editSubmoduleVisible = false"></v-btn>
        </v-card-title>
        <v-card-text>
          <v-simple-table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Addition Petty Cash</th>
                <th>Deletion Petty Cash</th>
                <th>Excess Amount</th>
                <th>G Pay/Phone Pay</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(row, index) in editSubmoduleRows" :key="index">
                <td>
                  <v-text-field v-model="row.date" type="date" required></v-text-field>
                </td>
                <td>
                  <v-text-field v-model="row.addition_petty_cash" type="number" required @input="updateTotal"></v-text-field>
                </td>
                <td>
                  <v-text-field v-model="row.deletion_petty_cash" type="number" required @input="updateTotal"></v-text-field>
                </td>
                <td>
                  <v-text-field v-model="row.excess_amount" type="number" required @input="updateTotal"></v-text-field>
                </td>
                <td>
                  <v-text-field v-model="row.gpay_phonepay" type="number" required @input="updateTotal"></v-text-field>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" class="text-right"><strong>Total:</strong></td>
                <td><strong>{{ totalAmount }}</strong></td>
              </tr>
            </tfoot>
          </v-simple-table>
          <v-btn @click="addSubmoduleRow" color="primary">Add Row</v-btn>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="success" @click="saveEditedPettyCash">Save</v-btn>
        </v-card-actions>
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
      addPettyCashDialog: false,
      editPettyCashDialog: false,
      editSubmoduleVisible: false,
      selectedPettyCash: {},
      editSubmoduleRows: [],
      newPettyCash: {},
      editableRow: {},
      dialogAction: "",
      isLoading: false,
      search: "",
      generateReportHeading: "",
      reportGenerateDialogBox: false,
      paymentDetails: [],
      headers: [
        { title: "Sl. No", key: "sl_no" },
        { text: "Date", value: "date" },
        { title: "Addition Petty Cash", key: "addition_petty_cash" },
        { title: "Deletion Petty Cash", key: "deletion_petty_cash" },
        { title: "Excess Amount", key: "excess_amount" },
        { title: "G Pay/Phone Pay", key: "gpay_phonepay" },
        { title: "Total", key: "total" },
        { title: "Action", key: "action", sortable: false },
      ],
    };
  },
  mounted() {
    this.getPaymentDetails();
  },
  computed: {
    filteredPaymentDetails() {
      return this.paymentDetails.filter((item) => {
        return (
          !this.search ||
          item.month.toLowerCase().includes(this.search.toLowerCase()) ||
          item.addition_petty_cash.toString().includes(this.search) ||
          item.deletion_petty_cash.toString().includes(this.search)
        );
      });
    },
  },
  methods: {
    openAddPettyCashDialog() {
      this.resetNewPettyCash();
      this.addPettyCashDialog = true;
    },
    
    calculateTotal() {
      this.newPettyCash.total =
        parseFloat(this.newPettyCash.addition_petty_cash || 0) -
        parseFloat(this.newPettyCash.deletion_petty_cash || 0) +
        parseFloat(this.newPettyCash.excess_amount || 0) +
        parseFloat(this.newPettyCash.gpay_phonepay || 0);
    },

    closeAddPettyCashDialog() {
      this.addPettyCashDialog = false;
    },
    savePettyCashDetails() {
      this.paymentDetails.push({
        sl_no: this.paymentDetails.length + 1, 
        ...this.newPettyCash,
      });

      this.closeAddPettyCashDialog();
    },
    resetNewPettyCash() {
      const currentDate = new Date();
      const year = currentDate.getFullYear();
      const month = String(currentDate.getMonth() + 1).padStart(2, "0");
      const day = String(currentDate.getDate()).padStart(2, "0");

      this.newPettyCash = {
        date: `${year}-${month}-${day}`, // Default to current date
        addition_petty_cash: 0,
        deletion_petty_cash: 0,
        excess_amount: 0,
        gpay_phonepay: 0,
        total: 0,
      };
    },
    openEditSubmodule(item) {
      this.selectedPettyCash = item;
      this.editSubmoduleRows = [...item.petty_cash_history];
      this.editSubmoduleVisible = true;
    },

    addSubmoduleRow() {
      this.editSubmoduleRows.push({
        date: new Date().toISOString().split("T")[0], // Default to current date
        addition_petty_cash: "",
        deletion_petty_cash: "",
        excess_amount: "",
        gpay_phonepay: "",
      });
    },

    updateTotal() {
      this.totalAmount = this.editSubmoduleRows.reduce((sum, row) => {
        return sum + (parseFloat(row.addition_petty_cash) || 0) 
                   - (parseFloat(row.deletion_petty_cash) || 0) 
                   + (parseFloat(row.excess_amount) || 0) 
                   + (parseFloat(row.gpay_phonepay) || 0);
      }, 0);
    },

    saveEditedPettyCash() {
      // Update total amount in main grid
      this.selectedPettyCash.total = this.totalAmount;

      // Close dialog
      this.editSubmoduleVisible = false;
    },
        
    showSuccessMessage(message) {
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#4CAF50",
      }).showToast();
    },
    async getPaymentDetails() {
      this.isLoading = true;
      try {
        const response = await axios.get("/get-payment-details");
        // this.paymentDetails = response.data.map((item, index) => ({
        //   sl_no: index + 1,
        //   month: item.month,
        //   addition_petty_cash: item.addition_petty_cash,
        //   deletion_petty_cash: item.deletion_petty_cash,
        //   excess_amount: item.excess_amount,
        //   gpay_phonepay: item.gpay_phonepay,
        //   total: item.total,
        // }));
        this.isLoading = false;
      } catch (error) {
        this.isLoading = false;
        console.error(error);
      }
    },
    openDialog(actionType) {
      this.reportFromDate = "";
      this.reportToDate = "";
      this.generateReportHeading =
        actionType === "exportExcel" ? "Export Excel" : "Download PDF";
      this.dialogAction = actionType;
      this.reportGenerateDialogBox = true;
    },
    closeDialog() {
      this.reportGenerateDialogBox = false;
      this.dialogAction = "";
    },
    handleEdit(item) {
      console.log("Edit Item:", item);
      this.editPettyCashDialog = true;
      // Add your edit functionality here
    },
    handleDelete(item) {
      console.log("Delete Item:", item);
      // Add your delete functionality here
    },
    generateReport() {
      if (this.dialogAction === "exportExcel") {
        this.exportExcel();
      } else if (this.dialogAction === "downloadPdf") {
        this.downloadPdf();
      }
      this.closeDialog();
    },
    exportExcel() {
      // Add your Excel export logic here
    },
    downloadPdf() {
      // Add your PDF download logic here
    },
  },
};
</script>

<style scoped>
.spinner-container {
  display: flex;
  justify-content: center;
  margin: 16px 0;
}
</style>

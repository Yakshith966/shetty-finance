<template>
  <div>
    <!-- Consolidated Sheet Dialog -->
    <v-dialog max-width="500" v-model="consolidatedSheetDialog">
      <v-card :title="generateConsolidatedSheetHeading">
        <v-card-text>
          <div class="mb-4">
            <v-text-field
              label="Start Date"
              v-model="consolidatedFromDate"
              type="date"
              outlined
            ></v-text-field>
          </div>
          <div>
            <v-text-field
              label="End Date"
              v-model="consolidatedToDate"
              type="date"
              outlined
            ></v-text-field>
          </div>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="closeConsolidatedDialog()">Cancel</v-btn>
          <v-btn text @click="generateConsolidatedSheet()" :disabled="!consolidatedFromDate || !consolidatedToDate">
            Generate
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Consolidated Sheet Data Table -->
    <v-data-table :headers="consolidatedHeaders" :items="filteredConsolidatedDetails" v-model:search="searchConsolidated">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Consolidated Sheet</v-toolbar-title>
          <v-btn color="success" @click="openAddConsolidatedDialog">Add Consolidated Sheet</v-btn>

          <!-- Add Consolidated Sheet Dialog -->
          <v-dialog v-model="addConsolidatedDialog" max-width="600px">
            <v-card>
              <v-card-title>
                <span class="text-h6">Add Consolidated Sheet Details</span>
                <v-btn icon="mdi-close" variant="text" @click="closeAddConsolidatedDialog"></v-btn>
              </v-card-title>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Month"
                        v-model="newConsolidatedSheet.month"
                        type="month"
                        outlined
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Total Investment"
                        v-model="newConsolidatedSheet.total_investment"
                        type="number"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Payment Return"
                        v-model="newConsolidatedSheet.payment_return"
                        type="number"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="New Payment"
                        v-model="newConsolidatedSheet.new_payment"
                        type="number"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Customer Receives"
                        v-model="newConsolidatedSheet.customer_receives"
                        type="number"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Customer Received"
                        v-model="newConsolidatedSheet.customer_received"
                        type="number"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-text-field
                        label="Difference Amount"
                        v-model="newConsolidatedSheet.difference_amount"
                        type="number"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="closeAddConsolidatedDialog">Cancel</v-btn>
                <v-btn text color="success" @click="saveConsolidatedSheetDetails">
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>

        <v-card-title class="d-flex align-center pe-2" v-if="!isLoadingConsolidated">
          <template v-if="!isLoadingConsolidated && filteredConsolidatedDetails.length > 0">
            <CButton color="info" style="color: white" @click="openDialog('exportConsolidatedExcel')">Export Excel</CButton>
            <v-spacer></v-spacer>
            <CButton color="warning" variant="outline" @click="openDialog('downloadConsolidatedPdf')">Download PDF</CButton>
          </template>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="searchConsolidated"
            density="compact"
            label="Search"
            prepend-inner-icon="mdi-magnify"
            variant="solo-filled"
            flat
            hide-details
            single-line
          ></v-text-field>
        </v-card-title>
        
      </template>

      <template v-slot:body="{ items }">
        <tr v-if="isLoadingConsolidated">
          <td :colspan="consolidatedHeaders.length" class="text-center">
            <CSpinner color="primary" />
          </td>
        </tr>
        <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
          <td>{{ index + 1}}</td>
          <td>{{ item.month }}</td>
          <td>{{ item.total_investment || '-' }}</td>
          <td>{{ item.payment_return || '-' }}</td>
          <td>{{ item.new_payment || '-' }}</td>
          <td>{{ item.customer_receives || '-' }}</td>
          <td>{{ item.customer_received || '-' }}</td>
          <td>{{ item.difference_amount || '-' }}</td>
          <td>
            <v-icon icon @click="handleEditConsolidated(item)">mdi-pencil</v-icon>
          </td>
        </tr>
        <tr v-else>
          <td :colspan="consolidatedHeaders.length" class="text-center">
            No data available
          </td>
        </tr>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      addConsolidatedDialog: false,
      newConsolidatedSheet: {
        month: '',
        total_investment: '',
        payment_return: '',
        new_payment: '',
        customer_receives: '',
        customer_received: '',
        difference_amount: '',
      },
      isLoadingConsolidated: false,
      searchConsolidated: "",
      generateConsolidatedSheetHeading: "",
      consolidatedSheetDialog: false,
      consolidatedDetails: [],
      consolidatedHeaders: [
        { title: "Sl. No", key: "sl_no" },
        { title: "Month", key: "month" },
        { title: "Total Investment", key: "total_investment" },
        { title: "Payment Return", key: "payment_return" },
        { title: "New Payment", key: "new_payment" },
        { title: "Customer Receives", key: "customer_receives" },
        { title: "Customer Received", key: "customer_received" },
        { title: "Difference Amount", key: "difference_amount" },
        { title: "Action", key: "action", sortable: false },
      ],
    };
  },
  computed: {
    filteredConsolidatedDetails() {
      return this.consolidatedDetails.filter((item) => {
        return (
          !this.searchConsolidated ||
          item.month.toLowerCase().includes(this.searchConsolidated.toLowerCase()) ||
          item.total_investment.toString().includes(this.searchConsolidated) ||
          item.payment_return.toString().includes(this.searchConsolidated)
        );
      });
    },
  },
  methods: {
    openAddConsolidatedDialog() {
      this.resetNewConsolidatedSheet();
      this.addConsolidatedDialog = true;
      this.setDefaultMonthConsolidated();
    },

    setDefaultMonthConsolidated() {
      const currentDate = new Date();
      const year = currentDate.getFullYear();
      const month = String(currentDate.getMonth() + 1).padStart(2, "0");
      this.newConsolidatedSheet.month = `${year}-${month}`;
    },

    closeAddConsolidatedDialog() {
      this.addConsolidatedDialog = false;
    },

    saveConsolidatedSheetDetails() {
      this.consolidatedDetails.push({
        sl_no: this.consolidatedDetails.length + 1,
        ...this.newConsolidatedSheet,
      });

      this.closeAddConsolidatedDialog();
      this.showSuccessMessage("Consolidated Sheet details added successfully!");
    },

    resetNewConsolidatedSheet() {
      this.newConsolidatedSheet = {
        month: "",
        total_investment: 0,
        payment_return: 0,
        new_payment: 0,
        customer_receives: 0,
        customer_received: 0,
        difference_amount: 0,
      };
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

    async getConsolidatedDetails() {
      this.isLoadingConsolidated = true;
      try {
        const response = await axios.get("/get-consolidated-details");
        this.consolidatedDetails = response.data.map((item, index) => ({
          sl_no: index + 1,
          ...item,
        }));
        this.isLoadingConsolidated = false;
      } catch (error) {
        this.isLoadingConsolidated = false;
        console.error(error);
      }
    },

    openDialog(actionType) {
      this.consolidatedFromDate = "";
      this.consolidatedToDate = "";
      this.generateConsolidatedSheetHeading =
        actionType === "exportConsolidatedExcel" ? "Export Excel" : "Download PDF";
      this.dialogAction = actionType;
      this.consolidatedSheetDialog = true;
    },

    closeConsolidatedDialog() {
      this.consolidatedSheetDialog = false;
      this.dialogAction = "";
    },

    handleEditConsolidated(item) {
      console.log("Edit Item:", item);
      // Implement your edit functionality here
    },

    generateConsolidatedSheet() {
      if (this.dialogAction === "exportConsolidatedExcel") {
        this.exportConsolidatedExcel();
      } else if (this.dialogAction === "downloadConsolidatedPdf") {
        this.downloadConsolidatedPdf();
      }
      this.closeConsolidatedDialog();
    },

    exportConsolidatedExcel() {
      // Add your Excel export logic here
    },

    downloadConsolidatedPdf() {
      // Add your PDF download logic here
    },
  },
};
</script>

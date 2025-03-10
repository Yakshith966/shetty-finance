<template>
     <div>
          <v-dialog max-width="500" v-model="reportGenerateDialogBox">
               <v-card :title="generateReportHeading">
                    <v-card-text>
                         <div class="mb-4">
                              <v-text-field label="Start Date" v-model="reportFromDate" type="date"
                                   outlined></v-text-field>
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
          <v-data-table :headers="headers" v-model:search="search" :items="filteredDealersDetails">
               

               <template v-slot:top>
                    <v-toolbar flat>
                         <v-toolbar-title>Dealers Payment Details</v-toolbar-title>
                    </v-toolbar>
                    <v-card-title class="d-flex align-center pe-2" v-if="!isLoading">
                         <template v-if="!isLoading && filteredDealersDetails.length > 0">
                              <CButton color="info" style="color: white" @click="openDialog('exportExcel')">Export Excel
                              </CButton>
                              <v-spacer></v-spacer>
                              <CButton color="warning" variant="outline" @click="openDialog('downloadPdf')">Download PDF
                              </CButton>
                         </template>
                         <template v-if="!isLoading && !filteredDealersDetails.length > 0">
                              <v-spacer></v-spacer>
                              <v-spacer></v-spacer>
                         </template>
                         <v-spacer></v-spacer>
                         <v-select v-model="selectedPaymentStatusId"
                              :items="[{ id: null, payment_status: 'All' }, ...paymentStatusOptions]"
                              label="Payment Status" item-value="id" item-title="payment_status" outlined
                              density="compact" variant="solo-filled" flat hide-details
                              style="max-width: 200px; margin-right: 1rem;"></v-select>
                         <v-text-field v-model="search" density="compact" label="Search"
                              prepend-inner-icon="mdi-magnify" variant="solo-filled" flat hide-details
                              single-line></v-text-field>
                    </v-card-title>
               </template>
               <!-- Custom row for loading state -->
               <template v-slot:body="{ items }">
                    <tr v-if="isLoading">
                         <td :colspan="headers.length" class="text-center">
                              <CSpinner color="primary" />
                         </td>
                    </tr>
                    <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
                         <td>{{ item.service_id }}</td>
                         <td>{{ item.dealer_name }}</td>
                         <td>{{ item.dealer_phone_no }}</td>
                         <td>{{ item.product_type }}</td>
                         <td>{{ item.product_name }}</td>
                         <td>{{ item.customer_name }}</td>
                         <td>{{ item.amount }}</td>
                         <td>{{ item.payment_mode || 'N/A' }}</td>
                         <td>{{ item.amount_received_date || 'N/A' }}</td>
                         <td>
                              <v-chip :color="getColor(item.payment_status)">
                                   {{ item.payment_status }}
                              </v-chip>
                         </td>
                    </tr>
                    <tr v-else>
                         <td :colspan="headers.length" class="text-center">
                              No data available
                         </td>
                    </tr>
               </template>
          </v-data-table>
     </div>
</template>

<script>
import Toastify from "toastify-js";
import jsPDF from "jspdf";
import "jspdf-autotable";
export default {
     data(){
          return {
               reportFromDate: "",
               reportToDate: "",
               dialogAction: "",
               dealersDetails: [],
               generateReportHeading: "",
               reportGenerateDialogBox: false,
               isLoading: false,
               selectedPaymentStatusId: null,
               headers: [
                    { title: 'Service ID', key: 'service_id' },
                    { title: 'Dealers Name', key: 'dealer_name' },
                    { title: 'Dealers Phone no', key: 'dealer_phone_no'},
                    { title: 'Product Type', key: 'product_type' },
                    { title: 'Product Name', key: 'product_name' },
                    { title: 'Customer Name', key: 'customer_name' },
                    { title: 'Amount', key: 'amount' },
                    { title: 'Payment Mode', key: 'payment_mode' },
                    { title: 'Payment Date', key: 'amount_received_date' },
                    { title: 'Payment Status', key: 'payment_status' },
               ],
               search: '',
               paymentStatusOptions: [],
          }
     },
     computed: {
          filteredDealersDetails() {
               return this.dealersDetails.filter((item) => {
                    const matchesSearch =
                         !this.search || 
                         item.service_id.toLowerCase().includes(this.search.toLowerCase()) ||
                         item.customer_name.toLowerCase().includes(this.search.toLowerCase()) ||
                         item.product_type.toLowerCase().includes(this.search.toLowerCase()) ||
                         item.product_name.toLowerCase().includes(this.search.toLowerCase()) ||
                         item.payment_mode.toLowerCase().includes(this.search.toLowerCase());

                    const matchesPaymentStatus =
                         !this.selectedPaymentStatusId || 
                         item.payment_status_id === this.selectedPaymentStatusId;

                    return matchesSearch && matchesPaymentStatus;
               });
          },
     },
     mounted(){
          this.getDealersDetails();
          this.getPaymentStatus();
     },
     methods: {
          async getPaymentStatus() {
               try {
                    const response = await axios.get('get-payment-status-details');
                    this.paymentStatusOptions = response.data;
               } catch (error) {
                    // console.log(error);
               }
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
          async getDealersDetails() {
               this.isLoading = true;
               try {
                    const response = await axios.get('/fetch-dealers-details-report');
                    this.dealersDetails = response.data;
                    this.isLoading = false;
               } catch (error) {
                    this.isLoading = false;
               }
          },
          getColor(value) {
               // console.log(value);
               return value == 'Paid' ? 'green' : 'red';
          },
          formatDataBasedOnDates(fromDate, toDate,) {
               const fromDateObj = new Date(fromDate);
               const toDateObj = new Date(toDate);
               const filteredData = this.filteredDealersDetails.filter(paymentDetail => {
                    const paymentDate = new Date(paymentDetail.amount_received_date);
                    return paymentDate >= fromDateObj && paymentDate <= toDateObj;
               });
               return filteredData;
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
               this.reportGenerateDialogBox = false;
               // this.reportFromDate = "";
               // this.reportToDate = "";
               this.dialogAction = "";
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
          },
          exportExcel() {
               const filteredData = this.formatDataBasedOnDates(this.reportFromDate, this.reportToDate);
               if (filteredData.length > 0) {
                    axios
                         .post(
                              "/dealers-details-excel-report",
                              {
                                   reportData: filteredData,
                              },
                              {
                                   responseType: "blob",
                                   headers: {
                                        "Content-Type": "application/json",
                                   },
                              }
                         )
                         .then((response) => {
                              const url = window.URL.createObjectURL(
                                   new Blob([response.data], {
                                        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                                   })
                              );
                              const link = document.createElement("a");
                              link.href = url;
                              link.setAttribute("download", "DealersDetailsReport.xlsx");
                              document.body.appendChild(link);
                              link.click();
                              document.body.removeChild(link);
                         })
                         .catch((error) => {
                              // console.error("There was an error generating the report:", error);
                         });
               } else {
                    this.showToastifyMessage();
               }
          },
          downloadPdf() {
               const doc = new jsPDF('landscape');
               doc.setFontSize(20);
               doc.setTextColor(40);

               const title = "Payment Details - Report";
               const pageWidth = doc.internal.pageSize.width;
               const textWidth = doc.getTextWidth(title);
               const xPosition = (pageWidth - textWidth) / 2;
               doc.text(title, xPosition, 13);

               const formatDate = (date) => {
                    const [year, month, day] = date.split('-');
                    return `${day}-${month}-${year}`;
               };
               const fromDate = `From Date: ${formatDate(this.reportFromDate)}`;
               const toDate = `To Date: ${formatDate(this.reportToDate)}`;

               doc.setFontSize(10);
               doc.setFont("Helvetica", "bold");
               doc.text(fromDate, 15, 25);
               doc.text(toDate, pageWidth - 55, 25);

               doc.setFont("Helvetica", "normal");
               const headers = [
                    'Service ID',
                    'Dealers Name',
                    'Dealers Phone no',
                    'Product Type',
                    'Product Name',
                    'Customer Name',
                    'Amount',
                    'Payment Mode',
                    'Payment Date',
                    'Status'
               ];

               const filteredData = this.formatDataBasedOnDates(this.reportFromDate, this.reportToDate);

               const body = filteredData.map(paymentDetail => [
                    paymentDetail.service_id,
                    paymentDetail.dealer_name,
                    paymentDetail.dealer_phone_no,
                    paymentDetail.product_type,
                    paymentDetail.product_name,
                    paymentDetail.customer_name,
                    paymentDetail.amount,
                    paymentDetail.payment_mode,
                    paymentDetail.amount_received_date,
                    paymentDetail.payment_status
               ]);

               let totalAmount = filteredData.reduce((sum, paymentDetail) => {
                    return sum + parseFloat(paymentDetail.amount || 0);
               }, 0);

               body.push([
                    "",
                    "",
                    "",
                    "",
                    "",
                    "Total Expense",
                    totalAmount.toFixed(2),
                    "",
                    "",
                    "",
               ]);
               const totalRowIndex = body.length - 1;

               doc.autoTable({
                    startY: 30,
                    margin: { top: 10, left: 10, right: 10 },
                    head: [headers],
                    headStyles: {
                         fillColor: [0, 57, 107],
                         halign: "center",
                         overflow: "linebreak",
                         fontSize: 11,
                         textColor: [255, 255, 255],
                         lineColor: [0, 0, 0],
                    },
                    body: body,
                    styles: {
                         fontSize: 9,
                         textColor: [0, 0, 0],
                         cellPadding: 2.2,
                         lineHeight: 1.6,
                         halign: "center",
                    },
                    columnStyles: {
                         0: { cellWidth: 'auto', halign: "center" },
                         1: { cellWidth: 'auto', halign: "center" },
                         2: { cellWidth: 'auto', halign: "center" },
                         3: { cellWidth: 'auto', halign: "center" },
                         4: { cellWidth: 'auto', halign: "center" },
                         5: { cellWidth: 'auto', halign: "center" },
                         6: { cellWidth: 'auto', halign: "center" },
                         7: { cellWidth: 'auto', halign: "center" },
                         8: { cellWidth: 'auto', halign: "center" },
                         9: { cellWidth: 'auto', halign: "center" },
                         10: { cellWidth: 'auto', halign: "center" },
                    },

                    didParseCell: function (data) {
                         if (data.row.index === totalRowIndex) {
                              // Apply bold styling for the total row
                              data.cell.styles.fontStyle = "bold";
                              data.cell.styles.fillColor = [240, 240, 240]; // Light gray background
                         }
                    },

               });
               if (filteredData.length > 0) {
                    doc.save("payment_report.pdf");
               } else {
                    this.showToastifyMessage();
               }
          },
     }
}
</script>
<style scoped>
  .spinner-container {
  display: flex;
  justify-content: center;
  margin: 16px 0;
  }
 </style>
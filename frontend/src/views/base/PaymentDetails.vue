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
          <v-btn text @click="generateReport()" :disabled="this.reportFromDate == '' || this.reportToDate == ''">Generate</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-data-table
      :headers="headers"
      v-model:search="search"
      :items="filteredPaymentDetails"
    >
    <!-- disable-pagination -->
    
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Payment Details</v-toolbar-title>
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
          <v-text-field
            v-model="search"
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
      <!-- Custom row for loading state -->
      <template v-slot:body="{ items }">
        <tr v-if="isLoading">
          <td :colspan="headers.length" class="text-center">
            <CSpinner color="primary" />
          </td>
        </tr>
        <tr v-else-if="items.length > 0" v-for="(item, index) in items" :key="index">
          <td>{{ item.service_id }}</td>
          <td>{{ item.product_type }}</td>
          <td>{{ item.product_name }}</td>
          <td>{{ item.customer_name }}</td>
          <td>{{ item.amount }}</td>
          <td>{{ item.payment_mode }}</td>
          <td>{{ item.payment_date }}</td>
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
import jsPDF from "jspdf";
import "jspdf-autotable";
import Toastify from "toastify-js";
export default {
  data() {
    return {
      reportFromDate: "",
      reportToDate: "",
      dialogAction: "",
      isLoading: false,
      search: '',
      generateReportHeading: "",
      reportGenerateDialogBox: false,
      paymentDetails: [],
      headers: [
        { title: 'Service ID', key: 'service_id' },
        { title: 'Product Type', key: 'product_type' },
        { title: 'Product Name', key: 'product_name' },
        { title: 'Customer Name', key: 'customer_name' },
        { title: 'Amount', key: 'amount' },
        { title: 'Payment Mode', key: 'payment_mode' },
        { title: 'Payment Date', key: 'payment_date' },
        { title: 'Status', key: 'payment_status' },
      ],
    }
    },
    mounted(){
    this.getPaymentDetails();
    },
    computed: {
      filteredPaymentDetails() {
        if (this.search) {
          return this.paymentDetails.filter((item) => {
            return (
              item.service_id.toLowerCase().includes(this.search.toLowerCase()) ||
              item.customer_name.toLowerCase().includes(this.search.toLowerCase()) ||
              item.product_type.toLowerCase().includes(this.search.toLowerCase()) ||
              item.product_name.toLowerCase().includes(this.search.toLowerCase()) ||
              item.payment_mode.toLowerCase().includes(this.search.toLowerCase())
            );
          });
        }
        return this.paymentDetails;
      },
    },
    methods: {
      async getPaymentDetails(){
        this.isLoading = true;
        try {
          const response = await axios.get('/get-payment-details');
          this.paymentDetails = response.data;
          this.isLoading = false;
          // console.log(this.paymentDetails);
        } catch (error) {
          this.isLoading = false;
        }
      },
      getColor(value) {
        return value == 'Paid' ? 'green' : 'red';
      },
      exportExcel(){
        // console.log('export excel');
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
        doc.text(toDate, pageWidth-55, 25);

        doc.setFont("Helvetica", "normal");
        const headers = [
            'Service ID',
            'Product Type',
            'Product Name',
            'Customer Name',
            'Amount',
            'Payment Mode',
            'Payment Date',
            'Status'
          ];

        const normalizeDate = (date) => {
            const d = new Date(date);
            d.setHours(0, 0, 0, 0); // Set time to 00:00:00
            return d;
        };

        const fromDateObj = normalizeDate(this.reportFromDate);
        const toDateObj = normalizeDate(this.reportToDate);
        // console.log(fromDateObj, toDateObj);
        // Filter paymentDetails based on the selected date range
        const filteredData = this.paymentDetails.filter(paymentDetail => {
            const paymentDate = normalizeDate(paymentDetail.payment_date);
            // console.log(paymentDate);
            return paymentDate >= fromDateObj && paymentDate <= toDateObj;
        });
        // console.log(filteredData);
        const body = filteredData.map(paymentDetail => [
            paymentDetail.service_id,
            paymentDetail.product_type,
            paymentDetail.product_name,
            paymentDetail.customer_name,
            paymentDetail.amount,
            paymentDetail.payment_mode,
            paymentDetail.payment_date,
            paymentDetail.payment_status
        ]);

        let totalAmount = this.paymentDetails.reduce((sum, paymentDetail) => {
            return sum + parseFloat(paymentDetail.amount || 0);
        }, 0);

        body.push([
            "",
            "",
            "",
            "Total",
            totalAmount.toFixed(2),
            "",
            "",
            ""  
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
          },
          columnStyles: {
            0: { cellWidth: 'auto' },
            1: { cellWidth: 'auto' },
            2: { cellWidth: 'auto' },
            3: { cellWidth: 'auto' },
            4: { cellWidth: 'auto' },
            5: { cellWidth: 'auto' },
            6: { cellWidth: 'auto' },
            7: { cellWidth: 'auto' },
          },

          didParseCell: function (data) {
              if (data.row.index === totalRowIndex) {
                  // Apply bold styling for the total row
                  data.cell.styles.fontStyle = "bold";
                  data.cell.styles.fillColor = [240, 240, 240]; // Light gray background
              }
          },

        });
        if(filteredData.length > 0){
          doc.save("payment_report.pdf");
        } else {
          Toastify({
            text: "No data available for the selected dates",
            backgroundColor: "red",
            className: "text-light",
            duration: 2000,
            gravity: "top",
            position: "right"
          }).showToast();
        }
      },

      openDialog(actionType){
        this.reportFromDate = "";
        this.reportToDate = "";
        if(actionType === 'exportExcel'){
          this.generateReportHeading = 'Export Excel';
        }else{
          this.generateReportHeading = 'Download PDF';
        }
        this.dialogAction = actionType;
        this.reportGenerateDialogBox = true;
      },
      closeDialog(){
        this.reportGenerateDialogBox = false;
        // this.reportFromDate = "";
        // this.reportToDate = "";
        this.dialogAction = "";
      },
      generateReport(){
        if (this.dialogAction === 'exportExcel') {
          if(this.reportFromDate != "" && this.reportToDate != ""){
            this.exportExcel();
          }
        } else if (this.dialogAction === 'downloadPdf') {
          if(this.reportFromDate != "" && this.reportToDate != ""){
            this.downloadPdf();
          }
        }
        this.closeDialog();
      }
    },
  }
</script>

<style scoped>
  .spinner-container {
  display: flex;
  justify-content: center;
  margin: 16px 0;
  }
 </style>
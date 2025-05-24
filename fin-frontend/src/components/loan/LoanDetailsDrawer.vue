<template>
     <a-drawer
       title="Loan Details"
       :visible="visible"
       width="1000"
       @close="handleClose"
       :closable="true"
     >
       <div v-if="loading" class="drawer-loading">
         <a-spin size="large" />
       </div>
   
       <div v-else>
         <template v-if="loan">
           <!-- Loan Info -->
           <a-card title="Loan Info" class="mb-3">
             <a-form layout="vertical">
               <a-form-item label="Loan ID">
                 <a-input :value="loan.loan_number" readonly />
               </a-form-item>
               <a-form-item label="Member Name">
                 <a-input :value="loan.member.name" readonly />
               </a-form-item>
               <a-form-item label="Principal Amount">
                 <a-input :value="loan.principal_amount" readonly />
               </a-form-item>
               <a-form-item label="Loan Disbursed Amount">
                 <a-input :value="loan.amount_given" readonly />
               </a-form-item>
               <a-form-item label="Interest Rate">
                 <a-input :value="loan.interest_rate + '%'" readonly />
               </a-form-item>
               <a-form-item label="Start Date">
                 <a-input :value="loan.start_date?.slice(0, 10)" readonly />
               </a-form-item>
               <a-form-item label="End Date">
                 <a-input :value="loan.end_date?.slice(0, 10)" readonly />
               </a-form-item>
             </a-form>
           </a-card>
   
           <!-- Payments -->
           <a-card title="Payments" class="mb-3" v-if="loan.payments?.length">
             <a-table
               :dataSource="loan.payments"
               :columns="paymentColumns"
               rowKey="id"
               size="small"
               bordered
               :pagination="false"
             />
           </a-card>
   
           <!-- Original Loan -->
           <a-card
             title="Original Loan"
             class="mb-3"
             v-if="loan.original_loan"
           >
             <a-form layout="vertical">
               <a-form-item label="Loan Number">
                 <a-input :value="loan.original_loan.loan_number" readonly />
               </a-form-item>
               <a-form-item label="Amount">
                 <a-input :value="'₹' + loan.original_loan.principal_amount" readonly />
               </a-form-item>
               <a-form-item label="Amount Disbursed">
                 <a-input :value="'₹' + loan.original_loan.amount_given" readonly />
               </a-form-item>
               <a-form-item label="Interest">
                 <a-input :value="loan.original_loan.interest_rate + '%'" readonly />
               </a-form-item>
               <a-form-item label="Start Date">
                 <a-input :value="loan.original_loan.start_date?.slice(0, 10)" readonly />
               </a-form-item>
               <a-form-item label="End Date">
                 <a-input :value="loan.original_loan.end_date?.slice(0, 10)" readonly />
               </a-form-item>
             </a-form>
           </a-card>
   
           <!-- Renewed Loans -->
           <a-card
             title="Renewed Loans"
             class="mb-3"
             v-if="loan.renewed_loans?.length"
           >
             <a-table
               :dataSource="loan.renewed_loans"
               :columns="renewedColumns"
               rowKey="id"
               size="small"
               bordered
               :pagination="false"
             />
           </a-card>
         </template>
       </div>
     </a-drawer>
   </template>
   
   <script>
   import dayjs from 'dayjs';
   export default {
     name: "LoanDetailsDrawer",
     props: {
       visible: Boolean,
       loanId: [String, Number],
     },
     data() {
       return {
         loan: null,
         loading: false,
         renewedColumns: [
           { title: "Loan ID", dataIndex: "loan_number", key: "loan_number" },
           { title: "Amount", dataIndex: "principal_amount", key: "principal_amount" },
           { title: "Amount Disbursed", dataIndex: "amount_given", key: "amount_given" },
           { title: "Start Date", dataIndex: "start_date", key: "start_date" ,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY') },
           { title: "End Date", dataIndex: "end_date", key: "end_date" ,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
           { title: "Interest (%)", dataIndex: "interest_rate", key: "interest_rate" },
         ],
         paymentColumns: [
           {
             title: "Payment Date",
             dataIndex: "payment_date",
             key: "payment_date",
             customRender: ({ text }) => text?.slice(0, 10),
           },
           {
             title: "Principal Paid",
             dataIndex: "principal_paid",
             key: "principal_paid",
           },
           {
             title: "Interest Paid",
             dataIndex: "interest_paid",
             key: "interest_paid",
           },
           {
             title: "Penalty",
             dataIndex: "penalty",
             key: "penalty",
           },
         ],
       };
     },
     watch: {
     //   visible(newVal) {
     //     if (newVal && this.loanId) {
     //       this.fetchLoanDetails();
     //     }
     //   },
       loanId(newId) {
         if (this.visible && newId) {
           this.fetchLoanDetails();
         }
       },
     },
     methods: {
       async fetchLoanDetails() {
         this.loading = true;
         try {
           const response = await axios.get(`/loans/${this.loanId}/details`);
           this.loan = response.data.data;
         } catch (err) {
           this.$message.error("Failed to fetch loan details");
         } finally {
           this.loading = false;
         }
       },
       handleClose() {
         this.loan = null;
         this.$emit("close");
       },
     },
   };
   </script>
   
   <style scoped>
   .drawer-loading {
     display: flex;
     justify-content: center;
     align-items: center;
     height: 300px;
   }
   .mb-3 {
     margin-bottom: 16px;
   }
   </style>
   
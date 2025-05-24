<template>
     <div>
          <a-card :bordered="false">
               <div class="table-header">
                    <h2>Loan Details</h2>
                    <router-link to="/loan-create">
                         <a-button type="primary" style="display: flex; align-items: center; color: white;">
                              <template #icon>
                                   <PlusOutlined />
                              </template>
                              Add Loan
                         </a-button>
                    </router-link>
               </div>

               <a-input v-model="searchQuery" placeholder="Search Loan..."
                    style="margin-bottom: 15px; max-width: 300px;" allow-clear @change="handleSearch" />

               <a-table :loading="loading" :columns="columns" :data-source="filteredLoans"
                    :row-key="record => record.id" v-model:expandedRowKeys="expandedRowKeys" class="custom-table"
                    :scroll="{ x: 1000, y: 400 }">
                    <template #bodyCell="{ column, record }">
                         <template v-if="column.key === 'status'">
                              <a-tag :color="getStatusColor(record.status)">
                                   {{ record.status }}
                              </a-tag>
                         </template>

                         <template v-if="column.key === 'operation'">
                              <a-space size="middle">
                                   <!-- View button always enabled -->
                                   <a-button type="primary" size="small"
                                        style="display: flex; align-items: center; color: white;"
                                        @click="viewDetails(record.id)">
                                        <EyeOutlined />
                                        View
                                   </a-button>

                                   <!-- Edit button -->
                                   <a-button type="default" size="small" style="display: flex; align-items: center;"
                                        :disabled="record.status === 'renewed' || record.is_closed"
                                        @click="editLoan(record)">
                                        <EditOutlined />
                                        Edit
                                   </a-button>


                                   <!-- Renew button -->
                                   <a-button type="default" size="small" style="display: flex; align-items: center;"
                                        :disabled="record.status === 'renewed' || record.is_closed"
                                        @click="openRenewModal(record)">
                                        <SyncOutlined />
                                        Renew
                                   </a-button>
                                   <a-button type="primary" danger size="small"
                                        style="display: flex; align-items: center;"
                                        :disabled="record.status === 'renewed' || record.is_closed"
                                        @click="closeLoan(record)">
                                        <CheckCircleOutlined />
                                        Close Loan
                                   </a-button>

                                   <!-- Add Payment button -->
                                   <a-button type="dashed" size="small" style="display: flex; align-items: center;"
                                        :disabled="record.status === 'renewed' || record.is_closed"
                                        @click="addPayment(record)">
                                        <DollarCircleOutlined />
                                        Add Payment
                                   </a-button>
                              </a-space>
                         </template>
                    </template>

                    <template #expandedRowRender="{ record }">
                         <a-table :data-source="record.payments" :columns="paymentColumns" :pagination="false"
                              row-key="id" />
                    </template>
               </a-table>
          </a-card>
          <AddPaymentDrawer :loanStartDate="selectedLoan.start_date" :visible="showPaymentDrawer"
               :loan-id="selectedLoanId" @close="closeDrawer" @refresh="refreshLoans" />
     </div>
     <a-modal v-model:visible="renewVisible" title="Renew Loan" @ok="submitRenew" @cancel="renewVisible = false"
          ok-text="Renew" cancel-text="Cancel">
          <a-form layout="vertical">
               <a-form-item label="Remaining Amount">
                    <a-input-number :value="remainingAmount" disabled style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Extra Amount Requested">
                    <a-input-number v-model:value="extraAmount" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="New Loan Amount">
                    <a-input-number :value="newLoanAmount" disabled style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Start Date">
                    <a-date-picker v-model:value="startDate" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="End Date">
                    <a-date-picker v-model:value="endDate" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Interest Rate (%)">
                    <a-input-number v-model:value="interestRate" style="width: 100%;" />
               </a-form-item>
          </a-form>
     </a-modal>
     <LoanDetailsDrawer :visible="drawerVisible" :loanId="selectedLoanId" @close="drawerVisible = false" />
     <LoanEditDrawer :visible="editDrawerVisible" :loanData="EditloanData" @update:visible="editDrawerVisible = $event"
          @reset="EditloanData = null" @submitted="fetchLoans" />
</template>
   
   <script>
   import {
     PlusOutlined,
     EyeOutlined,
     EditOutlined,
     DollarCircleOutlined,
     SyncOutlined
   } from '@ant-design/icons-vue';
   import dayjs from 'dayjs';
   import AddPaymentDrawer from "../../components/loan/AddPaymentDrawer.vue";
   import LoanDetailsDrawer from "../../components/loan/LoanDetailsDrawer.vue";
   import LoanEditDrawer from "../../components/loan/LoanEditDrawer.vue";
   export default {
     components: {
       PlusOutlined,
       EyeOutlined,
       EditOutlined,
       DollarCircleOutlined,
       SyncOutlined,
       AddPaymentDrawer,
       LoanDetailsDrawer,
       LoanEditDrawer,
     },
     data() {
       return {
         loading: false,
         showPaymentDrawer: false,
         editDrawerVisible: false,
         selectedLoanId: null,
         drawerVisible: false,
         selectedLoan : {},
         renewVisible: false,
         extraAmount: 0,
         startDate: null,
         endDate: null,
         interestRate: 0,
         searchQuery: '',
         expandedRowKeys: [],
         loanData: [],
         EditloanData : {},
         columns: [
           { title: 'Loan Number', dataIndex: 'loan_number', key: 'loan_number', width: 150 },
           { title: 'Loan Amount', dataIndex: 'principal_amount', key: 'principal_amount', width: 150,  },
           { title: 'Loan Disbursed Amount', dataIndex: 'amount_given', key: 'amount_given', width: 150,  },
           { title: 'Payment Given Date', dataIndex: 'created_at', key: 'created_at', width: 180,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
           { title: 'Customer Name', dataIndex: ['member', 'name'], key: 'customer_name', width: 180 },
           { title: 'Interest Rate (%)', dataIndex: 'interest_rate', key: 'interest_rate', width: 150 },
           { title: 'Agreement From', dataIndex: 'start_date', key: 'agreement_from', width: 180 ,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
           { title: 'Agreement To', dataIndex: 'end_date', key: 'agreement_to', width: 180 ,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
           { title: 'Paid Amount', dataIndex: 'principal_paid', key: 'principal_paid', width: 150 },
           { title: 'Loan Status', key: 'status', width: 130 },
           { title: 'Action', key: 'operation', width: 200 },
         ],
         paymentColumns: [
           { title: 'Interest Paid', dataIndex: 'interest_paid', key: 'interest_paid' },
           { title: 'Principal Paid', dataIndex: 'principal_paid', key: 'principal_paid' },
           { title: 'Payment Date', dataIndex: 'payment_date', key: 'payment_date',customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
           { title: 'Penalty', dataIndex: 'penalty', key: 'penalty' },
           { title: 'Remarks', dataIndex: 'remarks', key: 'remarks' },
         ],
       };
     },
     computed: {
       filteredLoans() {
         if (!this.searchQuery) return this.loanData;
         return this.loanData.filter(loan =>
           loan.member?.name?.toLowerCase().includes(this.searchQuery.toLowerCase())
         );
       },
       remainingAmount() {
         if (!this.selectedLoan) return 0;
         return parseFloat(this.selectedLoan.principal_amount) - parseFloat(this.selectedLoan.principal_paid);
       },
       newLoanAmount() {
         return parseFloat(this.remainingAmount) + parseFloat(this.extraAmount || 0);
       },
     },
     mounted() {
       this.fetchLoans();
     },
     methods: {
          async closeLoan(record) {
               this.$confirm({
                    title: 'Are you sure you want to close this loan?',
                    content: 'This will mark the principal as paid and close the loan permanently.',
                    okText: 'Yes, Close it',
                    cancelText: 'Cancel',
                    onOk: async () => {
                         try {
                              const response = await axios.post(`/loans/${record.id}/close`);
                              this.$message.success(response.data.message || 'Loan closed successfully.');
                              this.fetchLoans?.(); // safely call if exists
                         } catch (error) {
                              console.error(error);
                              this.$message.error(error.response?.data?.message || 'Failed to close loan.');
                         }
                    }
               });
          },

          viewDetails(id) {
               this.selectedLoanId = id;
               this.drawerVisible = true;
               console.log( this.selectedLoanId,  this.drawerVisible);
          },
       openRenewModal(loan) {
         this.selectedLoan = loan;
         this.extraAmount = 0;
         this.startDate = null;
         this.endDate = null;
         this.interestRate = loan.interest_rate;
         this.renewVisible = true;
       },
       async submitRenew() {
         const start = dayjs(this.startDate);
         const end = dayjs(this.endDate);
         const months = end.diff(start, "month");
   
         if (months < 1) {
           this.$message.error("Loan duration must be at least 1 month.");
           return;
         }
         try {
           const payload = {
             extra_amount: this.extraAmount,
             start_date: dayjs(this.startDate).format('YYYY-MM-DD'),
             end_date: dayjs(this.endDate).format('YYYY-MM-DD'),
             interest_rate: this.interestRate,
             loan_months: months,
           };
   
           const response = await axios.post(`/loans/${this.selectedLoan.id}/renew`, payload);
   
           this.$message.success('Loan renewed successfully!');
           this.renewVisible = false;
          this.fetchLoans();
         } catch (err) {
           this.$message.error('Failed to renew loan');
         }
       },
       addPayment(record) {
         console.log(record);
         
         this.selectedLoanId = record.id;
         this.selectedLoan.start_date = record.start_date;
         this.showPaymentDrawer = true;
       },
       async editLoan(record) {
      // Assuming loanData is already available
      this.EditloanData = record;
      this.editDrawerVisible = true;
    },
    handleSubmission() {
      this.editDrawerVisible = false;
      this.$message.success('Loan updated successfully');
    },
       closeDrawer() {
         this.showPaymentDrawer = false;
         this.selectedLoanId = null;
       },
       refreshLoans() {
         this.fetchLoans();
       },
       async fetchLoans() {
         this.loading = true;
         try {
           const response = await axios.get("/loans-with-payments");
           this.loanData = response.data.data;
         } catch (error) {
           this.$message.error("Failed to load loans");
         } finally {
           this.loading = false;
         }
       },
       handleSearch() {
         // already handled via computed property
       },
       getStatusColor(status) {
         switch (status) {
           case 'active': return 'blue';
           case 'closed': return 'green';
           case 'renewed': return 'yellow';
           default: return 'gray';
         }
       },
     },
   };
   </script>
   
   <style scoped>
   .table-header {
     display: flex;
     justify-content: space-between;
     align-items: center;
     margin-bottom: 15px;
   }
   </style>
   
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

      <a-input v-model="searchQuery" placeholder="Search Loan..." style="margin-bottom: 15px; max-width: 300px;"
        allow-clear @change="handleSearch" />

      <a-table :loading="loading" :columns="columns" :data-source="filteredLoans" :row-key="record => record.id"
        v-model:expandedRowKeys="expandedRowKeys" class="custom-table" :scroll="{ x: 1000, y: 400 }">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'payment_status'">
            <a-tag :color="getStatusColor(record.status)">
              {{ record.status }}
            </a-tag>
          </template>

          <template v-if="column.key === 'operation'">
            <a-space size="middle">
              <a-button type="primary" size="small" style="display: flex; align-items: center;"
                @click="viewDetails(record)">
                <EyeOutlined />
                View
              </a-button>
              <a-button type="default" size="small" style="display: flex; align-items: center;"
                @click="editLoan(record)">
                <EditOutlined />
                Edit
              </a-button>
              <a-button type="dashed" size="small" style="display: flex; align-items: center;"
                @click="addPayment(record)">
                <DollarCircleOutlined />
                Add Payment
              </a-button>
            </a-space>
          </template>
        </template>
       
        <template #expandedRowRender="{ record }">
          <a-table :data-source="record.payments" :columns="paymentColumns" :pagination="false" row-key="id" />
        </template>
      </a-table>
    </a-card>
    <AddPaymentDrawer :visible="showPaymentDrawer" :loan-id="selectedLoanId" @close="closeDrawer"
    @refresh="refreshLoans" />
  </div>
</template>

<script>
import {
  PlusOutlined,
  EyeOutlined,
  EditOutlined,
  DollarCircleOutlined,
} from '@ant-design/icons-vue';
import dayjs from 'dayjs';
import AddPaymentDrawer from "../../components/AddPaymentDrawer.vue";

export default {
  components: {
    PlusOutlined,
    EyeOutlined,
    EditOutlined,
    DollarCircleOutlined,
    AddPaymentDrawer,
  },
  data() {
    return {
      loading: false,
      showPaymentDrawer: false,
      selectedLoanId: null,
      searchQuery: '',
      expandedRowKeys: [],
      loanData: [],
      columns: [
        { title: 'Loan Number', dataIndex: 'loan_number', key: 'loan_number', width: 150 },
        { title: 'Loan Amount', dataIndex: 'principal_amount', key: 'principal_amount', width: 150,  },
        { title: 'Payment Given Date', dataIndex: 'created_at', key: 'created_at', width: 180,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
        { title: 'Customer Name', dataIndex: ['member', 'name'], key: 'customer_name', width: 180 },
        { title: 'Interest Rate (%)', dataIndex: 'interest_rate', key: 'interest_rate', width: 150 },
        { title: 'Agreement From', dataIndex: 'start_date', key: 'agreement_from', width: 180 ,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
        { title: 'Agreement To', dataIndex: 'end_date', key: 'agreement_to', width: 180 ,  customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY'), },
        { title: 'Paid Amount', dataIndex: 'principal_paid', key: 'principal_paid', width: 150 },
        { title: 'Loan Status', key: 'payment_status', width: 130 },
        { title: 'Action', key: 'operation', width: 200 },
      ],
      paymentColumns: [
        { title: 'Amount Paid', dataIndex: 'amount', key: 'amount' },
        { title: 'Payment Date', dataIndex: 'created_at', key: 'created_at' },
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
  },
  mounted() {
    this.fetchLoans();
  },
  methods: {
    addPayment(record) {
      console.log(record);
      
      this.selectedLoanId = record.id;
      this.showPaymentDrawer = true;
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
    viewDetails(record) {
      console.log("View Details", record);
    },
    editLoan(record) {
      console.log("Edit Loan", record);
    },
    handleSearch() {
      // already handled via computed property
    },
    getStatusColor(status) {
      switch (status) {
        case 'active': return 'blue';
        case 'closed': return 'green';
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

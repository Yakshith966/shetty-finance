<template>
  <div>
    <a-card :bordered="false">
      <div class="table-header">
        <h2>Members Details</h2>
        <a-button type="primary" @click="openAddMemberModal"
          style="display: flex; justify-content: center; align-items: center;">
          <template #icon>
            <PlusOutlined />
          </template>
          Add Member
        </a-button>
      </div>

      <a-input v-model="searchQuery" placeholder="Search Members..." style="margin-bottom: 15px; max-width: 300px;"
        allow-clear @change="handleSearch" />

      <a-table :loading="loading" :columns="columns" :data-source="filteredMembers" :row-key="record => record.id"
        v-model:expandedRowKeys="expandedRowKeys" class="custom-table" :scroll="{ x: 1000, y: 400 }">
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'payment_status'">
            <a-tag :color="getStatusColor(record.payment_status)">
              {{ record.payment_status }}
            </a-tag>
          </template>


          <template v-if="column.key === 'return_history'">
            <a-button class="w-30" type="link" @click="openReturnHistory(record)">Return History</a-button>
          </template>

          <template v-if="column.key === 'operation'">
            <a-space>
              <a-button type="link" @click="viewDetails(record)">View</a-button>
              <a-button type="link" @click="editMember(record)">Edit</a-button>

            </a-space>
          </template>

        </template>
        <template #expandedRowRender="{ record }">
          <a-table :data-source="record.returnHistory" :columns="returnHistoryColumns" :pagination="false" />
        </template>
      </a-table>

      <!-- Return History Modal -->
      <a-modal v-model:open="isReturnHistoryVisible" title="Return History" @cancel="isReturnHistoryVisible = false"
        :mask-style="{ zIndex: 2000 }" :wrap-style="{ zIndex: 2000 }" :body-style="{ zIndex: 2000 }">
        <a-form layout="vertical">
          <a-row :gutter="16">
            <a-col :span="12">
              <a-form-item label="Given Date">
                <a-date-picker v-model:value="newReturnHistory.givenDate" style="width: 100%;" />
              </a-form-item>
            </a-col>
            <a-col :span="12">
              <a-form-item label="Given Amount">
                <a-input-number v-model:value="newReturnHistory.givenAmount" style="width: 100%;" />
              </a-form-item>
            </a-col>
            <a-col :span="12">
              <a-form-item label="Pending Amount">
                <a-input-number v-model:value="newReturnHistory.pendingAmount" style="width: 100%;" />
              </a-form-item>
            </a-col>
            <a-col :span="12">
              <a-form-item label="Penalty">
                <a-input-number v-model:value="newReturnHistory.penalty" style="width: 100%;" />
              </a-form-item>
            </a-col>
            <a-col :span="24">
              <a-form-item label="Remarks">
                <a-input v-model:value="newReturnHistory.remarks" />
              </a-form-item>
            </a-col>
          </a-row>
          <a-button type="primary" @click="addReturnHistory">Add Entry</a-button>
        </a-form>

        <a-table :data-source="selectedRecord?.returnHistory" :columns="returnHistoryColumns" :pagination="false" />
      </a-modal>
    </a-card>

    <!-- Add Member Modal -->
    <a-modal v-model:open="isModalVisible" title="Add Member" @ok="handleOk" @cancel="handleCancel"
      :mask-style="{ zIndex: 2000 }" :wrap-style="{ zIndex: 2000 }" :body-style="{ zIndex: 2000 }"
      style="z-index: 2000; width: 800px;">
      <a-form layout="vertical">
        <a-row :gutter="16">
          <a-col :span="12">
            <a-form-item label="Payment Given Date">
              <a-date-picker v-model:value="form.paymentDate" style="width: 100%;" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Branch">
              <a-input v-model:value="form.branch" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Customer Name">
              <a-input v-model:value="form.customerName" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Contact Number">
              <a-input v-model:value="form.contactNumber" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Alternative Contact Number">
              <a-input v-model:value="form.altContactNumber" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Address">
              <a-textarea v-model:value="form.address" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Agreement From">
              <a-date-picker v-model:value="form.agreementFrom" style="width: 100%;" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Agreement To">
              <a-date-picker v-model:value="form.agreementTo" style="width: 100%;" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Document">
              <a-upload v-model:file-list="form.document" :before-upload="() => false">
                <a-button>Upload Document</a-button>
              </a-upload>
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Paid Amount">
              <a-input-number v-model:value="form.paidAmount" style="width: 100%;" />
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Monthly Return">
              <a-input-number v-model:value="form.monthlyReturn" style="width: 100%;" />
            </a-form-item>
          </a-col>
        </a-row>
      </a-form>
    </a-modal>

  </div>
</template>

<script>
import { PlusOutlined } from '@ant-design/icons-vue';

export default {
  components: {
    PlusOutlined,
  },
  data() {
    return {
      loading: false,
      searchQuery: '',
      expandedRowKeys: [],
      isModalVisible: false,
      isReturnHistoryVisible: false,
      selectedRecord: null,
      newReturnHistory: {
        givenDate: null,
        givenAmount: null,
        pendingAmount: null,
        penalty: null,
        remarks: "",
      },
      returnHistoryColumns: [
        { title: "Given Date", dataIndex: "givenDate", key: "givenDate" },
        { title: "Given Amount", dataIndex: "givenAmount", key: "givenAmount" },
        { title: "Pending Amount", dataIndex: "pendingAmount", key: "pendingAmount" },
        { title: "Penalty", dataIndex: "penalty", key: "penalty" },
        { title: "Remarks", dataIndex: "remarks", key: "remarks" },
      ],
      form: {
        paymentDate: null,
        branch: '',
        customerName: '',
        contactNumber: '',
        altContactNumber: '',
        address: '',
        agreementFrom: null,
        agreementTo: null,
        document: [],
        paidAmount: null,
        monthlyReturn: null,
      },
      members: [
        {
          id: 1,
          member_id: 'MBR-001',
          payment_date: '2024-02-17',
          customer_name: 'John Doe',
          contact_number: '9876543210',
          agreement_from: '2024-01-01',
          agreement_to: '2025-01-01',
          paid_amount: 5000,
          monthly_return: 500,
          return_history: 'No issues',
          remaining_amount: 2000,
          payment_status: 'Paid',
        },
        {
          id: 2,
          member_id: 'MBR-002',
          payment_date: '2024-02-16',
          customer_name: 'Jane Smith',
          contact_number: '9123456789',
          agreement_from: '2023-06-01',
          agreement_to: '2024-06-01',
          paid_amount: 10000,
          monthly_return: 1000,
          return_history: 'Delayed payments',
          remaining_amount: 4000,
          payment_status: 'Partial',
        },
      ],
      filteredMembers: [],
      columns: [
        { title: 'Member ID', dataIndex: 'member_id', key: 'member_id', sorter: (a, b) => a.member_id.localeCompare(b.member_id), width: 130 },
        { title: 'Payment Given Date', dataIndex: 'payment_date', key: 'payment_date', sorter: (a, b) => new Date(a.payment_date) - new Date(b.payment_date), width: 130 },
        { title: 'Customer Name', dataIndex: 'customer_name', key: 'customer_name', sorter: (a, b) => a.customer_name.localeCompare(b.customer_name), width: 130 },
        { title: 'Contact Number', dataIndex: 'contact_number', key: 'contact_number', sorter: (a, b) => a.contact_number.localeCompare(b.contact_number), width: 130 },
        { title: 'Agreement From', dataIndex: 'agreement_from', key: 'agreement_from', sorter: (a, b) => new Date(a.agreement_from) - new Date(b.agreement_from), width: 130 },
        { title: 'Agreement To', dataIndex: 'agreement_to', key: 'agreement_to', sorter: (a, b) => new Date(a.agreement_to) - new Date(b.agreement_to), width: 130 },
        { title: 'Paid Amount', dataIndex: 'paid_amount', key: 'paid_amount', sorter: (a, b) => a.paid_amount - b.paid_amount, width: 130 },
        { title: 'Monthly Return', dataIndex: 'monthly_return', key: 'monthly_return', sorter: (a, b) => a.monthly_return - b.monthly_return, width: 130 },
        { title: 'Return History', dataIndex: 'return_history', key: 'return_history', width: 130 },
        { title: 'Remaining Amount', dataIndex: 'remaining_amount', key: 'remaining_amount', sorter: (a, b) => a.remaining_amount - b.remaining_amount, width: 130 },
        { title: 'Payment Status', dataIndex: 'payment_status', key: 'payment_status', width: 130 },
        { title: 'Action', key: 'operation', width: 130 },
      ],
    };
  },
  mounted() {
    this.filteredMembers = this.members;
  },
  methods: {
    openReturnHistory(record) {
      this.selectedRecord = record;
      this.isReturnHistoryVisible = true;
    },
    addReturnHistory() {
      if (!this.selectedRecord.returnHistory) {
        this.selectedRecord.returnHistory = [];
      }
      this.selectedRecord.returnHistory.push({ ...this.newReturnHistory });
      this.newReturnHistory = { givenDate: null, givenAmount: null, pendingAmount: null, penalty: null, remarks: "" };

      // Ensure row expands
      if (!this.expandedRowKeys.includes(this.selectedRecord.id)) {
        this.expandedRowKeys.push(this.selectedRecord.id);
      }
    },
    openAddMemberModal() {
      this.isModalVisible = true;
    },
    handleOk() {
      console.log('Form Data:', this.form);
      this.isModalVisible = false;
    },
    handleCancel() {
      this.isModalVisible = false;
    },
    viewDetails(record) {
      console.log('View Details:', record);
    },
    editMember(record) {
      console.log('Edit Member:', record);
    },
    handleSearch() {
      this.filteredMembers = this.members.filter((item) =>
        item.customer_name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
    getStatusColor(status) {
      switch (status) {
        case 'Paid': return 'green';
        case 'Partial': return 'orange';
        case 'Unpaid': return 'red';
        default: return 'blue';
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

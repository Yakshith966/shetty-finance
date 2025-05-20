<template>
  <div class="loan-form">
    <a-page-header title="Add New Loan" @back="$router.go(-1)" />

    <a-form layout="vertical" :model="form" class="mt-4">
      <a-row :gutter="16">
        <a-col :span="20">
          <a-form-item label="Customer">
            <div style="display: flex; gap: 8px; align-items: center;">
              <a-select v-model:value="form.member_id" placeholder="Select Member" allowClear :loading="memberLoading"
                style="flex: 1;">
                <a-select-option v-for="member in members" :key="member.id" :value="member.id">
                  {{ member.name }}
                </a-select-option>
              </a-select>
              <a-button type="default" shape="square" @click="drawerVisible = true"
                :style="{ display: 'flex', justifyContent: 'center', alignItems: 'center' }">
                <PlusOutlined />
              </a-button>
            </div>
          </a-form-item>
        </a-col>
      </a-row>

      <a-row :gutter="16">
        <a-col :span="8">
          <a-form-item label="Loan Amount (₹)">
            <a-input-number v-model:value="form.principal_amount" style="width: 100%" :min="0" />
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item label="Interest Rate (%)">
            <a-input-number v-model:value="form.interest_rate" style="width: 100%" :min="0" :step="0.1" />
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item label="Deduct Interest Upfront?">
            <a-radio-group v-model:value="form.deduct_upfront">
              <a-radio :value="true">Yes</a-radio>
              <a-radio :value="false">No</a-radio>
            </a-radio-group>
          </a-form-item>
        </a-col>
      </a-row>

      <a-row :gutter="16">
        <a-col :span="8">
          <a-form-item label="Start Date">
            <a-date-picker v-model:value="form.start_date" style="width: 100%" />
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item label="End Date">
            <a-date-picker v-model:value="form.end_date" style="width: 100%" :disabled-date="disabledEndDate" />
          </a-form-item>
        </a-col>

        <a-col :span="8">
          <a-form-item label="Actions">
            <div style="display: flex; gap: 10px">
              <a-button @click="calculateMonthlySchedule">Preview</a-button>
              <a-button type="primary" @click="disburseLoan">Disburse</a-button>
            </div>
          </a-form-item>
        </a-col>
      </a-row>
    </a-form>
    <a-drawer title="Add Customer" v-model:visible="drawerVisible" width="400" :destroyOnClose="true">
      <AddCustomerForm @memberAdded="addCustomer" />
    </a-drawer>
    <a-divider v-if="monthlySchedule.length">Monthly Interest Preview</a-divider>

    <a-table v-if="monthlySchedule.length" :dataSource="monthlySchedule" :columns="monthlyColumns" rowKey="month"
      bordered size="small" />
  </div>
</template>

<script>
import dayjs from "dayjs";
import { PlusOutlined } from "@ant-design/icons-vue";
import AddCustomerForm from "../../components/AddCustomerForm.vue";


export default {
  components: {
    PlusOutlined,
    AddCustomerForm
  },
  data() {
    return {
      members: [],
      memberLoading: false,
      drawerVisible: false,
      form: {
        member_id: null,
        principal_amount: null,
        interest_rate: null,
        deduct_upfront: false,
        start_date: null,
        end_date: null,
      },
      monthlySchedule: [],
      monthlyColumns: [
        { title: "Month", dataIndex: "month", key: "month" },
        { title: "Due Date", dataIndex: "due_date", key: "due_date" },
        { title: "Amount (₹)", dataIndex: "amount", key: "amount" },
      ],
    };
  },
  mounted() {
    this.fetchMembers();
  },
  methods: {
    disabledEndDate(current) {
    if (!this.form.start_date) return true;
    return current < dayjs(this.form.start_date).add(1, 'month');
  },
    addCustomer(customer) {
      this.members.push(customer); // No need to override id
      this.drawerVisible = false;
      this.form.member_id = customer.id;
    },
    async fetchMembers() {
      this.memberLoading = true;
      try {
        const res = await axios.get("/members");
        this.members = res.data;
      } catch (err) {
        this.$message.error("Failed to load members.");
      } finally {
        this.memberLoading = false;
      }
    },

    calculateMonthlySchedule() {
      const { principal_amount, interest_rate, start_date, end_date, deduct_upfront } = this.form;

      if (!principal_amount || !interest_rate || !start_date || !end_date) {
        this.$message.error("Please fill all fields first.");
        return;
      }

      const start = dayjs(start_date);
      const end = dayjs(end_date);
      const months = end.diff(start, "month");

      if (months < 1) {
        this.$message.error("Loan duration must be at least 1 month.");
        return;
      }

      const monthlyInterest = parseFloat((principal_amount * (interest_rate / 100)).toFixed(2));
      const schedule = [];

      let startMonthIndex = 1;

      if (deduct_upfront) {
        // Month 0: Upfront deduction (immediate)
        schedule.push({
          month: 0,
          due_date: start.format("YYYY-MM-DD"),  // upfront deduction date = loan start date
          amount: monthlyInterest,
          description: "Upfront Interest Deduction",
        });
        startMonthIndex = 1;
      } else {
        startMonthIndex = 1;
      }

      // Monthly interest payments starting next month after start date
      for (let i = startMonthIndex; i <= months; i++) {
        const dueDate = start.add(i, "month").format("YYYY-MM-DD");
        schedule.push({
          month: i,
          due_date: dueDate,
          amount: monthlyInterest,
          description: "Monthly Interest Payment",
        });
      }

      this.monthlySchedule = schedule;
    },

    async disburseLoan() {
      const { member_id, principal_amount, interest_rate, start_date, end_date, deduct_upfront } = this.form;

      if (!member_id || !principal_amount || !interest_rate || !start_date || !end_date) {
        this.$message.error("Please fill in all required fields.");
        return;
      }

      const start = dayjs(start_date);
      const end = dayjs(end_date);
      const months = end.diff(start, "month");

      if (months < 1) {
        this.$message.error("Loan duration must be at least 1 month.");
        return;
      }

      const interestRateDecimal = interest_rate / 100;
      let interest_deducted_upfront = 0;
      let amount_given = principal_amount;

      if (deduct_upfront) {
        interest_deducted_upfront = parseFloat((principal_amount * interestRateDecimal).toFixed(2));
        amount_given = parseFloat((principal_amount - interest_deducted_upfront).toFixed(2));
      }

      const payload = {
        member_id,
        principal_amount,
        interest_rate,
        loan_months: months,
        interest_deducted_upfront,
        amount_given,
        start_date: start.format("YYYY-MM-DD"),
        end_date: end.format("YYYY-MM-DD"),
      };

      try {
        await axios.post("/loans", payload);
        this.$message.success("Loan disbursed successfully!");
        this.$router.push("/loans");
      } catch (err) {
        this.$message.error("Failed to disburse loan.");
      }
    },
  },
};
</script>

<style scoped>
.loan-form {
  padding: 24px;
}
</style>

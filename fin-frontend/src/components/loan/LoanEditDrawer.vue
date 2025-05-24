<template>
     <a-drawer :visible="visible" width="1300" title="Edit Loan" placement="right"
          @update:visible="$emit('update:visible', $event)" :closable="true" @close="handleClose">
          <div v-if="loading" class="drawer-loading">
               <a-spin size="large" />
          </div>
          <div v-else-if="loan">
               <a-card title="Loan Details" class="mb-4">
                    <a-form layout="vertical">
                         <a-form-item label="Loan Number">
                              <a-input :value="loan.loan_number" readonly />
                         </a-form-item>
                         <a-form-item label="Member">
                              <a-input :value="loan.member?.name" readonly />
                         </a-form-item>
                         <a-form-item label="Amount Given">
                              <a-input :value="`₹${loan.amount_given}`" readonly />
                         </a-form-item>
                         <a-form-item label="Start Date">
                              <a-input :value="loan.start_date?.slice(0, 10)" readonly />
                         </a-form-item>
                         <a-form-item label="End Date">
                              <a-input :value="loan.end_date?.slice(0, 10)" readonly />
                         </a-form-item>
                    </a-form>
               </a-card>

               <a-card title="Payments">
                    <a-table v-if="payments.length > 0" :dataSource="payments" :columns="columns" :pagination="false"
                         rowKey="id" size="small">
                         <template #bodyCell="{ column, record }">
                              <template v-if="editRow === record.id">
                                   <template v-if="column.key === 'month_year'">
                                        <a-date-picker v-model:value="record.month_year" picker="month"
                                             format="MMMM YYYY"
                                             :disabledDate="date => date.isBefore(dayjs(loan.start_date))" size="small"
                                             style="width: 100%;" />
                                   </template>
                                   <template v-if="column.key === 'payment_date'">
                                        <a-date-picker v-model:value="record.payment_date" format="DD-MM-YYYY"
                                             style="width: 100%;" />
                                   </template>
                                   <template v-if="column.key === 'interest_paid'">
                                        <a-input-number v-model:value="record.interest_paid" size="small" :min="0"
                                             style="width: 100%;" />
                                   </template>
                                   <template v-if="column.key === 'principal_paid'">
                                        <a-input-number v-model:value="record.principal_paid" size="small" :min="0"
                                             style="width: 100%;" />
                                   </template>
                                   <template v-if="column.key === 'penalty'">
                                        <a-input-number v-model:value="record.penalty" size="small" :min="0"
                                             style="width: 100%;" />
                                   </template>
                                   <template v-if="column.key === 'notes'">
                                        <a-input v-model:value="record.notes" size="small" />
                                   </template>
                                   <template v-if="column.key === 'action'">
                                        <a-space>
                                             <a-button style="color: white;" size="small" type="primary"
                                                  :loading="submitLoading" @click="savePayment(record)">
                                                  Save
                                             </a-button>
                                             <a-button size="small" @click="cancelEdit(record)">Cancel</a-button>
                                        </a-space>
                                   </template>
                              </template>
                              <template v-else>
                                   <template v-if="column.key === 'month_year'">
                                        {{ dayjs(record.month_year).format('MMMM YYYY') }}
                                   </template>
                                   <template v-if="column.key === 'interest_paid'">
                                        ₹{{ record.interest_paid }}
                                   </template>
                                   <template v-if="column.key === 'principal_paid'">
                                        ₹{{ record.principal_paid || 0 }}
                                   </template>
                                   <template v-if="column.key === 'penalty'">
                                        ₹{{ record.penalty || 0 }}
                                   </template>
                                   <template v-if="column.key === 'notes'">
                                        {{ record.notes || '-' }}
                                   </template>
                                   <template v-if="column.key === 'action'">
                                        <a-button size="small" type="primary" style="color: aliceblue;" @click="editPayment(record)">Edit</a-button>
                                   </template>
                              </template>
                         </template>
                    </a-table>

                    <a-empty v-else description="No payments yet" />
               </a-card>
          </div>
     </a-drawer>
</template>

<script>
import dayjs from 'dayjs';
export default {
     name: 'LoanEditDrawer',
     props: {
          visible: Boolean,
          loanData: {
               type: Object,
               required: true
          }
     },
     data() {
          return {
               loan: null,
               payments: [],
               loading: false,
               submitLoading: false,
               editRow: null,
               originalRecord: {},
               columns: [
                    { title: 'Month', dataIndex: 'month_year', key: 'month_year' },
                    { title: 'Interest Paid', dataIndex: 'interest_paid', key: 'interest_paid' },
                    { title: 'Principal Paid', dataIndex: 'principal_paid', key: 'principal_paid' },
                    { title: 'Penalty', dataIndex: 'penalty', key: 'penalty' },
                    { title: 'Payment Date', dataIndex: 'payment_date', key: 'payment_date', customRender: ({ text }) => dayjs(text).format('DD-MM-YYYY') },
                    { title: 'Notes', dataIndex: 'notes', key: 'notes' },
                    { title: 'Action', key: 'action' }
               ]
          };
     },
     watch: {
          visible(val) {
               if (val) this.init();
          }
     },
     methods: {
          dayjs,
          handleClose() {
               this.$emit('update:visible', false);
               this.$emit('reset');
          },
          init() {
               this.loading = true;
               this.loan = this.loanData;
               this.payments = this.loanData.payments.map(p => ({ ...p }));
               this.loading = false;
               this.editRow = null;
          },
          editPayment(record) {
               this.originalRecord = { ...record };
               record.month_year = dayjs(record.month_year)
               record.payment_date = dayjs(record.payment_date)
               this.editRow = record.id;

          },
          cancelEdit(record) {
               Object.assign(record, this.originalRecord);
               this.editRow = null;
          },
          async fetchLoanData() {
               try {
                    this.loading = true;
                    const response = await axios.get(`/loans/${this.loan.id}`);
                    this.loan = response.data.loan;
                    this.payments = response.data.loan.payments.map(p => ({ ...p }));
               } catch (error) {
                    this.$message.error("Failed to fetch updated loan data.");
               } finally {
                    this.loading = false;
               }
          },
          async savePayment(record) {
               this.submitLoading = true;
               try {
                    const response = await axios.put(`/loan-payments/${record.id}`, {
                         loan_id: this.loan.id,
                         // month_year: record.month_year,
                         month_year: record.month_year
                              ? dayjs(record.month_year).startOf('month').format('YYYY-MM-DD')
                              : null,
                         payment_date: record.payment_date
                              ? dayjs(record.payment_date).format('YYYY-MM-DD')
                              : null,
                         interest_paid: record.interest_paid,
                         principal_paid: record.principal_paid,
                         penalty: record.penalty,
                         // payment_date: record.payment_date,
                         notes: record.notes,
                    });

                    this.$message.success(response.data.message);
                    this.editRow = null;
                    await this.fetchLoanData();
                    this.submitLoading = false;
                  
               } catch (error) {
                    if (error.response?.data?.errors) {
                         Object.values(error.response.data.errors).forEach(msg => {
                              this.$message.error(msg[0]);
                         });
                    } else {
                         this.$message.error('Failed to update payment.');
                    }
                    this.submitLoading = false;

               }
          },

          
     }
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
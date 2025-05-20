<template>
     <a-drawer title="Add Payment" :visible="visible" @close="handleClose" width="500">
          <a-form layout="vertical" :model="form" @submit.prevent>
               <a-form-item label="Month">
                    <a-date-picker v-model:value="form.month_year" picker="month" style="width: 100%;" format="MMMM YYYY" />
               </a-form-item>

               <a-form-item label="Interest Paid">
                    <a-input-number v-model:value="form.interest_paid" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Principal Paid">
                    <a-input-number v-model:value="form.principal_paid" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Penalty">
                    <a-input-number v-model:value="form.penalty" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Payment Date">
                    <a-date-picker v-model:value="form.payment_date" style="width: 100%;" />
               </a-form-item>

               <a-form-item label="Notes">
                    <a-textarea v-model:value="form.notes" rows="4" />
               </a-form-item>

               <a-space style="margin-top: 20px;">
                    <a-button type="primary" @click="submitPayment">Submit</a-button>
                    <a-button @click="handleClose">Cancel</a-button>
               </a-space>
          </a-form>
     </a-drawer>
</template>
   
   <script>
   export default {
     name: "AddPaymentDrawer",
     props: {
       visible: Boolean,
       loanId: Number,
     },
     emits: ['close', 'refresh'],
     data() {
       return {
         form: {
           loan_id: null,
           month_year: null,
           interest_paid: null,
           principal_paid: 0.0,
           penalty: 0.0,
           payment_date: null,
           notes: "",
         },
       };
     },
     watch: {
       loanId(newId) {
         if (newId) this.form.loan_id = newId;
       },
     },
     mounted() {
       this.form.loan_id = this.loanId;
       console.log('Form initialized with loan ID:', this.form.loan_id);
       
     },
     methods: {
       handleClose() {
         this.$emit('close');
       },
       async submitPayment() {
         try {
           await axios.post('/api/payments', this.form);
           this.$message.success("Payment added successfully");
           this.$emit('refresh');
           this.handleClose();
         } catch (e) {
           this.$message.error("Failed to add payment");
         }
       },
     },
   };
   </script>
   
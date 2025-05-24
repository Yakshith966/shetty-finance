<template>
     <a-drawer title="Add Payment" :visible="visible" @close="handleClose" width="500">
       <a-form layout="vertical" :model="form" @submit.prevent>
         <a-form-item label="Month">
           <a-date-picker
             v-model:value="form.month_year"
             picker="month"
             style="width: 100%;"
             format="MMMM YYYY"
             :disabled-date="disableBeforeLoanStart"
           />
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
           <a-date-picker
             v-model:value="form.payment_date"
             style="width: 100%;"
             :disabled-date="disableBeforeLoanStart"
           />
         </a-form-item>
   
         <a-form-item label="Notes">
           <a-textarea v-model:value="form.notes" rows="4" />
         </a-form-item>
   
         <a-space style="margin-top: 20px;">
           <a-button  
        :loading="submitLoading" style="color: white;" type="primary" @click="submitPayment">Submit</a-button>
           <a-button @click="handleClose">Cancel</a-button>
         </a-space>
       </a-form>
     </a-drawer>
   </template>
   
   <script>
   import dayjs from "dayjs";
   
   export default {
     name: "AddPaymentDrawer",
     props: {
       visible: Boolean,
       loanId: Number,
       loanStartDate: String, // pass loan start_date as prop (YYYY-MM-DD)
     },
     emits: ['close', 'refresh'],
     data() {
       return {
          submitLoading : false,
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
     },
     methods: {
       handleClose() {
         this.$emit('close');
       },
       disableBeforeLoanStart(current) {
         // Disable dates before the loan start date
         return current && current < dayjs(this.loanStartDate);
       },
       async submitPayment() {
           this.submitLoading = true;
         try {
           const payload = {
             ...this.form,
             month_year: this.form.month_year
               ? dayjs(this.form.month_year).startOf('month').format('YYYY-MM-DD')
               : null,
             payment_date: this.form.payment_date
               ? dayjs(this.form.payment_date).format('YYYY-MM-DD')
               : null,
           };
   
           await axios.post('/add-payments', payload);
   
           this.$message.success("Payment added successfully");
           this.$emit('refresh');
           this.handleClose();
           this.submitLoading = false;
         } catch (error) {
           if (error.response && error.response.data && error.response.data.errors) {
             const errors = error.response.data.errors;
             Object.values(errors).forEach((messages) => {
               messages.forEach((msg) => this.$message.error(msg));
             });
           } else {
             this.$message.error("Something went wrong while adding the payment.");
           }
           this.submitLoading = false;
         }
       },
     },
   };
   </script>
   
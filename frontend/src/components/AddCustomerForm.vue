<template>
  <div style="margin-top: 20px;">
    <a-page-header title="Add Customer" @back="$router.go(-1)" />
    <a-form layout="vertical" :model="form" @submit.prevent="submit">
      <a-form-item label="Branch">
        <a-select v-model:value="form.branch_id" placeholder="Select branch" :loading="branchLoading"
          :notFoundContent="branchLoading ? null : 'No branches found'">
          <a-select-option v-for="branch in branches" :key="branch.id" :value="branch.id">
            {{ branch.name }}
          </a-select-option>
        </a-select>
      </a-form-item>
      <a-form-item label="Name">
        <a-input v-model:value="form.name" />
      </a-form-item>
      <a-form-item label="Phone">
        <a-input v-model:value="form.phone" />
      </a-form-item>
      <a-form-item label="Email">
        <a-input v-model:value="form.email" />
      </a-form-item>
      <a-form-item label="Address">
        <a-input v-model:value="form.address" />
      </a-form-item>
      <a-form-item label="Govt ID Number">
        <a-input v-model:value="form.govId" />
      </a-form-item>
      <a-button type="primary" block @click="submit">Add Customer</a-button>
    </a-form>
  </div>
</template>
   
   <script>
  export default {
  data() {
    return {
      branches: [],
      branchLoading: false,
      form: {
        branch_id: null,
        name: "",
        phone: "",
        email: "",
        address: "",
        govId: "",
      },
    };
  },
  methods: {
    async fetchBranches() {
      this.branchLoading = true;
      try {
        const res = await axios.get("/branches");
        this.branches = res.data;
        this.branchLoading = false;
      } catch (error) {
        this.$message.error("Failed to load branches");
        this.branchLoading = false;
      }
    },
    
    async submit() {
      if (!this.form.name || !this.form.phone || !this.form.branch_id) {
        this.$message.error("Please fill required fields");
        return;
      }

      try {
        const response = await axios.post("/members", {
          branch_id: this.form.branch_id,
          name: this.form.name,
          email: this.form.email,
          phone_number: this.form.phone,
          address: this.form.address,
          document_proof_id: this.form.govId,
        });

        const memberData = response.data.data; // this contains the newly created member

        this.$message.success("Member added successfully");
        this.$emit("memberAdded", memberData); // Emit the new member's data
      } catch (e) {
        this.$message.error("Failed to add member");
      }
    },
  },
  mounted() {
    this.fetchBranches();
  },
};
   </script>
   
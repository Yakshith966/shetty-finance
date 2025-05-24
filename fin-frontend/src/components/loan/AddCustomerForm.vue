<template>
  <div>
    <a-form layout="vertical" :model="form" @submit.prevent="submit">
      <a-form-item label="Branch">
        <a-select
          v-model:value="form.branch_id"
          placeholder="Select branch"
          :loading="branchLoading"
          :notFoundContent="branchLoading ? 'Loading...' : 'No branches found'"
          @dropdownVisibleChange="handleDropdownVisible"
        >
          <a-select-option
            v-for="branch in branches"
            :key="branch.id"
            :value="branch.id"
          >
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

      <a-button
        type="primary"
       
        :loading="submitLoading"
        style="width: 100%;"
        @click="submit"
      >
        Add Customer
      </a-button>
    </a-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      branches: [],
      branchLoading: false,
      submitLoading: false,
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
      } catch (error) {
        this.$message.error("Failed to load branches");
      } finally {
        this.branchLoading = false;
      }
    },

    handleDropdownVisible(open) {
      if (open && this.branches.length === 0) {
        this.fetchBranches();
      }
    },

    async submit() {
      if (!this.form.name || !this.form.phone || !this.form.branch_id) {
        this.$message.error("Please fill required fields");
        return;
      }

      this.submitLoading = true;
      try {
        const response = await axios.post("/members", {
          branch_id: this.form.branch_id,
          name: this.form.name,
          email: this.form.email,
          phone_number: this.form.phone,
          address: this.form.address,
          document_proof_id: this.form.govId,
        });

        const memberData = response.data.data;
        this.$message.success("Member added successfully");
        this.$emit("memberAdded", memberData);
        this.resetForm();
      } catch (e) {
        this.$message.error("Failed to add member");
      } finally {
        this.submitLoading = false;
      }
    },

    resetForm() {
      this.form = {
        branch_id: null,
        name: "",
        phone: "",
        email: "",
        address: "",
        govId: "",
      };
    },
  },
  mounted() {
    this.fetchBranches();
  },
};
</script>

<script>
import { useRouter } from 'vue-router'
import avatar from '@/assets/images/avatars/10.png'
import Login from '../views/pages/Login.vue'


export default {
  data() {
    return {
      avatar, // Import avatar image
    }
  },
  methods: {
    logout() {
      axios
        .post('/logout')
        .then((response) => {
          this.$store.commit('clearAuth') // Clear authentication data from Vuex
          this.$router.push('/pages/login') // Redirect to login page
          console.log('Redirected to login page')
        })
        .catch((error) => {
          console.error('Error during redirection:', error)
        })
    },
  },
}
</script>


<template>
  <CDropdown placement="bottom-end" variant="nav-item">
    <CDropdownToggle class="py-0 pe-0" :caret="false">
      <CAvatar :src="avatar" size="md" />
    </CDropdownToggle>
    <CDropdownMenu class="pt-0">
      <CDropdownHeader
        component="h6"
        class="bg-body-secondary text-body-secondary fw-semibold mb-2 rounded-top"
      >
        Account
      </CDropdownHeader>
      <CDropdownItem> <CIcon icon="cil-user" /> Profile </CDropdownItem>
      <CDropdownDivider />
      <CDropdownItem @click="logout"> <CIcon icon="cil-lock-locked" /> Logout </CDropdownItem>
    </CDropdownMenu>
  </CDropdown>
</template>

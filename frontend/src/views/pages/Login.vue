<template>
  <div class="wrapper min-vh-100 d-flex flex-row align-items-center">
    <CContainer>
      <CRow class="justify-content-center">
        <CCol :md="6">
          <CCardGroup>
            <CCard class="p-4">
              <CCardBody>
                <CForm @submit.prevent="login">
                  <h1>Login</h1>
                  <p class="text-body-secondary">Sign In to your account</p>
                  <CRow v-if="errorMsg" class="justify-content-center mt-3">
                    <CCol :md="12">
                      <CAlert color="danger" dismissible @dismiss="errorMsg = ''">
                        {{ errorMsg }}
                      </CAlert>
                    </CCol>
                  </CRow>
                  <CInputGroup class="mb-3">
                    <CInputGroupText>
                      <CIcon icon="cil-user" />
                    </CInputGroupText>
                    <CFormInput placeholder="Username" autocomplete="username" v-model="loginDetails.userName"
                      required />
                  </CInputGroup>
                  <CInputGroup class="mb-4">
                    <CInputGroupText>
                      <CIcon icon="cil-lock-locked" />
                    </CInputGroupText>
                    <CFormInput :type="showPassword ? 'text' : 'password'" placeholder="Password"
                      autocomplete="current-password" v-model="loginDetails.passWord" required />
                    <!-- <CInputGroupText @click="togglePasswordVisibility" style="cursor: pointer;">
                      <CIcon :icon="showPassword ? 'cil-apple' : 'cil-apple'" size /> 
                    </CInputGroupText>  -->
                    <CInputGroupText @click="togglePasswordVisibility" style="cursor: pointer;">
                      <i :class="showPassword ? 'mdi mdi-eye' : 'mdi mdi-eye-off'" style="font-size: 1.25rem;"></i>
                    </CInputGroupText>
                  </CInputGroup>
                  <CRow>
                    <CCol :xs="3">
                      <CButton color="primary" class="px-4" type="submit"> Login </CButton>
                    </CCol>
                    <!-- <CCol :xs="6" class="text-right">
                      <CButton color="link" class="px-0">
                        Forgot password?
                      </CButton>
                    </CCol> -->
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
            <!-- <CCard class="text-white bg-primary py-5" style="width: 44%">
              <CCardBody class="text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.
                  </p>
                  <CButton color="light" variant="outline" class="mt-3">
                    Register Now!
                  </CButton>
                </div>
              </CCardBody>
            </CCard> -->
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>
<script>
import { createStore } from 'vuex';


export default{
 
  data() {
    return {
      loginDetails:{
      userName: '',
      passWord: '',
      },
      errorMsg: '', // To hold the error message
    requestLoad: false, 
    showPassword: false,
    };
  },
 
methods: {
  togglePasswordVisibility(){
    this.showPassword = !this.showPassword; 
  },
  login() {
  this.requestLoad = true;
  this.errorMsg = ''; // Clear any previous error messages
  axios.post('/login', {
      user_name: this.loginDetails.userName,
      password: this.loginDetails.passWord,
    })
    .then((response) => {
      this.requestLoad = false;
      this.$store.commit('setToken', response.data.token);
      this.$store.commit('setUser', response.data.user);
      this.$router.push('/dashboard');
    })
    .catch((err) => {
      this.requestLoad = false;
      if (err?.response?.status === 401) {
        this.errorMsg = 'Invalid username or password.';
      } else {
        this.errorMsg = 'An unexpected error occurred. Please try again later.';
      }
    });
},

}
}

</script>
<style scoped>
.alert {
  margin-top: 10px;
  font-weight: bold;
  text-align: center;
}

</style>

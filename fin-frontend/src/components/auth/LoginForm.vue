<template>
    <v-row class="d-flex mb-3">
      <v-col cols="12">
        <v-label class="mb-1">Username</v-label>
        <v-text-field
          v-model="loginDetails.userName"
          variant="outlined"
          hide-details
          color="primary"
        />
      </v-col>
  
      <v-col cols="12">
        <v-label class="mb-1">Password</v-label>
        <v-text-field
          v-model="loginDetails.passWord"
          variant="outlined"
          type="password"
          hide-details
          color="primary"
        />
      </v-col>
  
      <v-col cols="12" class="pt-0">
        <div class="d-flex flex-wrap align-center ml-n2">
          <v-checkbox v-model="checkbox" color="primary" hide-details>
            <template v-slot:label class="text-body-1">Remeber this Device</template>
          </v-checkbox>
          <div class="ml-sm-auto">
            <RouterLink
              to="/"
              class="text-primary text-decoration-none text-body-1 opacity-1 font-weight-medium"
            >
              Forgot Password ?
            </RouterLink>
          </div>
        </div>
      </v-col>
  
      <v-col cols="12" class="pt-0">
        <v-btn
          :loading="requestLoad"
          color="primary"
          size="large"
          block
          flat
          @click="login"
        >
          Sign in
        </v-btn>
      </v-col>
  
      <v-col cols="12" class="pt-0">
        <v-alert
          v-if="errorMsg"
          type="error"
          dense
          border="start"
          border-color="red"
          class="mt-3"
        >
          {{ errorMsg }}
        </v-alert>
        <v-alert
          v-if="successMsg"
          type="success"
          dense
          border="start"
          border-color="green"
          class="mt-3"
        >
          {{ successMsg }}
        </v-alert>
      </v-col>
    </v-row>
  </template>
  
  <script>

  
  export default {
    name: 'LoginForm',
    data() {
      return {
        loginDetails: {
          userName: '',
          passWord: '',
        },
        checkbox: true,
        requestLoad: false,
        errorMsg: '',
        successMsg: '',
      };
    },
    methods: {
      login() {
        this.requestLoad = true;
        this.errorMsg = '';
        this.successMsg = '';
  
        axios
          .post('/login', {
            name: this.loginDetails.userName,
            password: this.loginDetails.passWord,
          })
          .then((response) => {
            this.$store.commit('setToken', response.data.token);
            this.$store.commit('setUser', response.data.user);
            this.successMsg = 'Login successful! Redirecting...';
  
            setTimeout(() => {
              this.$router.push('/');
            }, 1000);
          })
          .catch((err) => {
            if (err?.response?.status === 401) {
              this.errorMsg = 'Invalid username or password.';
            } else {
              this.errorMsg = 'An unexpected error occurred. Please try again later.';
            }
          })
          .finally(() => {
            this.requestLoad = false;
          });
      },
    },
  };
  </script>
  
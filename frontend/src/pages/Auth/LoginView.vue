<template>
    <div class="card-content">
        <div class="md-layout-item md-medium-size-50 md-size-4">
            <form>
                <md-card style="max-width: 480px; height: 495px;">
                    <md-card-content>
                        <div style="height:6rem"></div>
                        <div class="card-content"><h4 class="title">Login</h4></div>
                                <div class="md-layout">

                                    <div class="md-layout-item md-small-size-100 md-size-90">
                                        <md-field>
                                        <label>User Name</label>
                                        <md-input v-model="username" type="text"></md-input>
                                        </md-field>
                                    </div>

                                    <div class="md-layout-item md-small-size-100 md-size-90">
                                        <md-field :md-toggle-password="false" >
                                            <label>Password</label>
                                            <md-input v-model="password" id="password" :type="ShowPassword ? 'text' : 'password'"></md-input>
                                        </md-field>
                                    </div>
                
                                    <div class="card-footer">
                                        <div class="md-layout-item md-sm small-size">
                                            <md-checkbox v-model="ShowPassword" value="1">Show Password</md-checkbox>
                                        </div>
                                        <div class="md-layout-item md-sm small-size">
                                            <md-checkbox v-model="RememberMe" value="1">Remember Me</md-checkbox>
                                        </div>
                                    </div>

                                </div>
                            <md-button class="md-primary md-block">Login</md-button>
                    </md-card-content>
                </md-card>
            </form>
        </div>
    </div>
</template>

<script>
  export default {
    data(){
        return{
      ShowPassword: false,
      RememberMe: false,
        }
    },

    methods:{
    },
  }
</script>
<style scoped>
.small-size {
  font-size: 12px; /* Adjust this value as needed */
}

.card-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 4%;
}

.card-footer {
  display: flex;
  flex-direction: column;
  align-items: left;
}

label {
  display: block;
  margin-bottom: 5px;
}
</style>

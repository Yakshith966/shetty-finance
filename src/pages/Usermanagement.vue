<template>
    <div>
      <div class="card-box">

        <div class="row align-items-center mb-3">
          <div class="col">
            <h4 class="mt-0 header-title">User Management</h4>
            <p class="text-muted font-14 mb-0">List of Users</p>
          </div>
          
          <div class="col-auto">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('list') }]"
                  @click.prevent="setActiveTab('list')"
                >
                  List
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('apply') }]"
                  @click.prevent="setActiveTab('apply')"
                >
                  Create
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

        <div v-if="activeTab === 'list'">
          <div class="row align-items-center mb-3">
              <div class="col">          
                <md-field class="custom-md-field">
                <label for="movie">show</label>
                    <md-select v-model="movie" name="movie" id="movie" class="custom-md-input">
                        <md-option value="fight-club">5</md-option>
                        <md-option value="godfather">10</md-option>
                        <md-option value="godfather-ii">15</md-option>
                        <!-- <md-option value="godfather-iii">Godfather III</md-option>
                        <md-option value="godfellas">Godfellas</md-option>
                        <md-option value="pulp-fiction">Pulp Fiction</md-option>
                        <md-option value="scarface">Scarface</md-option> -->
                    </md-select>
                </md-field>
              </div>
                <md-field class="custom-md-field" style="margin:0px 0px 0px 0px">
                  <label>Search...</label>
                  <md-input v-model="initial"></md-input>
                </md-field>
                <md-icon>search</md-icon>
          </div>
      
          <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">User Management</h4>
                <!-- <p class="category">List of Users</p> -->
                </md-card-header>
                <md-card-content>
                  <md-table v-model="users" :table-header-color="tableHeaderColor">
                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="Sl No">{{ item.name }}</md-table-cell>
                      <md-table-cell md-label="Emp Code">{{ item.country }}</md-table-cell>
                      <md-table-cell md-label="Name">{{ item.city }}</md-table-cell>
                      <md-table-cell md-label="User Name">{{ item.salary }}</md-table-cell>
                      <md-table-cell md-label="Edit"><md-icon>edit</md-icon></md-table-cell>
                      <md-table-cell md-label="Reset Password"><md-icon>lock_reset</md-icon></md-table-cell>
                      <md-table-cell md-label="Access Card"><md-icon>key</md-icon></md-table-cell>
                      <md-table-cell md-label="Status">Active</md-table-cell>
                    </md-table-row>
                  </md-table>
                </md-card-content>
        </md-card>
      </div>
        </div>  

      <div v-if="activeTab === 'apply'">
        <form>
          <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
            <md-card style="width: 55%;">
            <md-card-header data-background-color="green">
                <h4 class="title">User Management</h4>
                <!-- <p class="category">Complete your profile</p> -->
            </md-card-header>
            <md-card-content>
              <div class="form-group">
        <label for="employeeName">Employee Name<span>*</span></label>
                  <md-field>
                        <md-select v-model="country" name="country" id="country" placeholder="Select employee">
                            <md-option value="australia">Raju</md-option>
                            <md-option value="brazil">Sham</md-option>
                            <md-option value="japan">Suresh</md-option>
                            <md-option value="united-states">Rahul</md-option>
                        </md-select>
                    </md-field>
      </div>

      <!-- User Name -->
      <div class="form-group">
        <div class="input-group">
          <md-field>
                        <label>User Name</label>
                        <md-input v-model="username" type="text"></md-input>
          </md-field>
          <md-button class="md-primary">Generate User Name</md-button>
        </div>
      </div>

      <!-- Password -->
      <div class="form-group">

        <div class="input-group">
          <md-field>
            <label>Confirm Password</label>
              <md-input v-model="password" type="password"></md-input>
          </md-field>
          <md-button class="md-primary">Generate password</md-button>
        </div>
      </div>

      <!-- Confirm Password -->
      <div class="form-group">
        <md-field>
                    <label>Confirm Password</label>
                    <md-input v-model="confirmPassword" type="password"></md-input>
        </md-field>
      </div>

      <!-- Show Password Checkbox -->

      <!-- Email -->
      <div class="form-group">
                <md-field>
                    <label>Email</label>
                    <md-input v-model="lastname" type="email"></md-input>
                </md-field>
      </div>

      <!-- Buttons -->
      <div id="buttons">
        <!-- <button  class="save-button">Save</button> -->
        <!-- <md-button  class="md-success">Save</md-button> -->
        <div>
          <md-button type="submit" class="md-success" >Save</md-button>
        </div>
        <div style="padding-left: 10px;">
          <md-button type="button" class="md-danger">Cancel</md-button>
        </div>
      </div>
  
        <!-- <button type="button" id="cancel-button" @click="cancelForm">Cancel</button> -->
        
                    <!-- <div class="row">
                      <div class="md-layout-item md-small-size-100 md-size-96" >
                    <md-field>
                        <md-select v-model="country" name="country" id="country" placeholder="Select employee">
                            <md-option value="australia">Australia</md-option>
                            <md-option value="brazil">Brazil</md-option>
                            <md-option value="japan">Japan</md-option>
                            <md-option value="united-states">United States</md-option>
                        </md-select>
                    </md-field>
                      </div>
                   </div>

                <div class="md-layout-item md-small-size-100 md-size-96">
                    <md-field>
                        <label>User Name</label>
                        <md-input v-model="username" type="text"></md-input>
                    </md-field>
                </div>
                <div class="row">
                <div class="md-layout-item md-small-size-100 md-size-96">
                  <div class="all-buttons">

                        <div>
                        <md-field>
                            <label>Password</label>
                            <md-input v-model="password" type="password"></md-input>
                          </md-field>
                        </div>

                  </div>
                </div>
                <div>
                    <md-button class="md-primary">Primary</md-button>
                </div>
              </div>
                    <div class="md-layout-item md-small-size-100 md-size-56">
                    <md-field>
                    <label>Confirm Password</label>
                    <md-input v-model="confirmPassword" type="password"></md-input>
                    </md-field>
                </div>
                    <div class="md-layout-item md-small-size-100 md-size-56">
                    <md-field>
                    <label>Email</label>
                    <md-input v-model="lastname" type="email"></md-input>
                </md-field>
                </div> -->




                <!-- <div class="md-layout-item md-small-size-100 md-size-100">
                    <md-field>
                    <label>Adress</label>
                    <md-input v-model="address" type="text"></md-input>
                </md-field>
                </div>
                <div class="md-layout-item md-small-size-100 md-size-33">
                    <md-field>
                        <label>City</label>
                        <md-input v-model="city" type="text"></md-input>
                    </md-field>
                </div>
                <div class="md-layout-item md-small-size-100 md-size-33">
                    <md-field>
                    <label>Country</label>
                    <md-input v-model="country" type="text"></md-input>
                    </md-field>
                </div>
                <div class="md-layout-item md-small-size-100 md-size-33">
                    <md-field>
                        <label>Postal Code</label>
                    <md-input v-model="code" type="number"></md-input>
                    </md-field>
                </div>
                <div class="md-layout-item md-size-100">
                    <md-field maxlength="5">
                    <label>About Me</label>
                    <md-textarea v-model="aboutme"></md-textarea>
                </md-field>
            </div> -->

            <!-- <div class="md-layout-item md-size-100 text-right all-buttons">
              <div class="all-buttons">
                <md-button class="md-raised md-success">Save</md-button>
              </div>
              <div class="all-buttons">
                <md-button class="md-accent">Cancel</md-button>
              </div>
            </div> -->
                    
        <!-- <md-button class="md-raised md-primary"></md-button> -->
            </md-card-content>
          </md-card>   
          </div>       
        </form>
    </div>
  
    </div>
  </template>
  
  <script>
  export default {
    name: "simple-table",
    props: {
      tableHeaderColor: {
        type: String,
        default: "",
      },
    },
    data() {
      return {
        activeTab: 'list', // Default active tab
        users: [
          { name: "Dakota Rice", salary: "$36,738", country: "Niger", city: "Oud-Turnhout" },
          { name: "Minerva Hooper", salary: "$23,738", country: "Curaçao", city: "Sinaai-Waas" },
          { name: "Sage Rodriguez", salary: "$56,142", country: "Netherlands", city: "Overland Park" },
          { name: "Philip Chaney", salary: "$38,735", country: "Korea, South", city: "Gloucester" },
          { name: "Doris Greene", salary: "$63,542", country: "Malawi", city: "Feldkirchen in Kārnten" },
          { name: "Mason Porter", salary: "$78,615", country: "Chile", city: "Gloucester" },
        ],
        otherUsers: [
          { name: "Jane Doe", salary: "$48,000", country: "USA", city: "New York" },
          { name: "John Smith", salary: "$52,000", country: "UK", city: "London" },
          { name: "Juan Carlos", salary: "$44,000", country: "Spain", city: "Madrid" },
          { name: "Wei Zhang", salary: "$50,000", country: "China", city: "Beijing" },
        ],
      };
    },
    methods: {
      isActive(tab) {
        return this.activeTab === tab;
      },
      setActiveTab(tab) {
        this.activeTab = tab;
      }
    }
  };
  </script>
  
  <style scoped>

.custom-md-field{
  /* Adjust the overall size of the md-field if needed */
  width: 190px; /* Adjust as needed */
}

.custom-md-input {
  /* Adjust the size of the input */
  width: 50px; /* Change the width as needed */
  /* height: 30px; Change the height as needed */
  /*padding: 5px;  Adjust padding as needed */
  font-size: 14px; /* Adjust font size as needed */
}
  .row {
    --ct-gutter-x: 1.5rem;
    --ct-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--ct-gutter-y));
    margin-right: calc(-0.5 * var(--ct-gutter-x));
    margin-left: calc(-0.5 * var (--ct-gutter-x));
  }
  
  .tab-content {
    padding: 20px 0 0 0;
    border: none;
  }
  
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #71b6f9 !important;
  }
  
  .align-items-center {
    align-items: center !important;
    padding:0px 65px 0px 20px;
  }
  
  .mb-3 {
    margin-bottom: 1.5rem !important;
  }
  
  .col {
    flex: 1 0 0%;
  }
  
  .mt-0 {
    margin-top: 0 !important;
  }
  
  .header-title {
    font-size: 1rem;
    margin: 0 0 7px 0;
  }
  
  .card-box {
    background-color: #fff;
    padding: 1.5rem 0rem 0rem 0rem;
    -webkit-box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    margin-bottom: 1px;
    border-radius: .25rem;
  }
  
  .col-auto {
    flex: 0 0 auto;
    width: auto;
  }
  
  .nav {
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }
  
  /* .form-container {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
} */

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

/* input[type="text"],
input[type="password"],
input[type="email"],
select {
   width: 100%; 
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
} */

.input-group {
  display: flex;
}

/* .input-group input {
  flex: 1;
} */

/* .input-group button {
  margin-left: 10px;
  padding: 8px 12px;
  border: 1px solid #007bff;
  border-radius: 4px;
  background-color: #fff;
  color: #007bff;
  cursor: pointer;
} */

/* .input-group button:hover {
  background-color: #007bff;
  color: #fff;
} */


button[type="submit"],
button[type="button"].cancel-button {
  /* padding: 10px 20px; */
  /* border: none;
  border-radius: 4px; */
  cursor: pointer;
}

/* button[type="submit"].save-button {
  background-color: #28a745;
  color: #fff;
} */

/* button[type="button"].cancel-button {
  background-color: #ccc;
  color: #333;
  margin-left: 10px;
} */

#buttons {
  display: flex;
  flex-direction: row;
  
}

/* button[type="button"].cancel-button:hover {
  background-color: #b3b3b3;
} */

  .nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: rgb(113, 182, 249);
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
  }
  
  .nav-pills .nav-link {
    background: none;
    border: 0;
    border-radius: 0.25rem;
  }
  
  .nav-tabs .nav-link {
    margin-bottom: -1px;
    background: none;
    border: 1px solid transparent;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
  }
  
  ol, ul, dl {
    margin-top: 0;
    margin-bottom: 1rem;
  }

  .create-field{
    display:flex; 
    flex-direction: column; 
    align-items: left;
  }

  .all-buttons {
    display: flex;
    flex-direction: row;
    padding: 5px 10px;
  }
  </style>
  
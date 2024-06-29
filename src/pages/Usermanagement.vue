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
                <!-- <label for="movie">show</label> -->
                
                  <label for="country">Show</label>
                  <md-select v-model="country" name="country" id="country" md-dense>
                    <md-option value="australia">5</md-option>
                    <md-option value="brazil">10</md-option>
                    <md-option value="japan">15</md-option>
                    <md-option value="all">All</md-option>
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
                      <md-table-cell md-label="Emp Code">{{ item.salary }}</md-table-cell>
                      <md-table-cell md-label="Name">{{ item.country }}</md-table-cell>
                      <md-table-cell md-label="User Name">{{ item.city }}</md-table-cell>
                      <md-table-cell md-label="Edit"><button><md-icon>edit</md-icon></button></md-table-cell>
                      <md-table-cell md-label="Reset Password"><button><md-icon>lock_reset</md-icon></button></md-table-cell>
                      <md-table-cell md-label="Access Card"><button><md-icon>key</md-icon></button></md-table-cell>
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
            <div class="form-style">
              <md-card style="width: 55%;">
            <md-card-header data-background-color="green">
                <h4 class="title">User Management</h4>
                
            </md-card-header>
            <md-card-content>
              <div class="form-group">
               
              </div>
              <div class="struct" id="struct">
            <label for="country" class="test1"><span class="md-body-2">Employee Name</span></label>

                        <div class="test2">
                          <md-field>
                            <label for="country">Select</label>
                            <md-select required v-model="country" name="country" id="country" md-dense>
                              <md-option value="arial">Kiran</md-option>
                              <md-option value="calibri">Raju</md-option>
                              <md-option value="cambria">Ram</md-option>
                              <md-option value="comic-sans">Comic Sans</md-option>
                              <md-option value="consolas">Consolas</md-option>
                              <md-option value="courier">Courier</md-option>
                              <md-option value="droid-sans">Droid Sans</md-option>
                              <md-option value="georgia">Georgia</md-option>
                              <md-option value="helvetica">Helvetica</md-option>
                              <md-option value="impact">Impact</md-option>
                              <md-option value="roboto">Roboto</md-option>
                              <md-option value="segoe-ui">Segoe UI</md-option>
                              <md-option value="times-new-roman">Times New Roman</md-option>
                              <md-option value="ubuntu">Ubuntu</md-option>
                              <md-option value="verdana">Verdana</md-option>
                            </md-select>
                          </md-field>
                        </div>
                    
                        <div class="test3"></div>
                          <div class="test1">
                            <label for="country" class="test1"><span class="md-body-2">User Name</span></label>
                            </div>
                            <div class="test2">
                              <md-field>
                                  <label>User Name</label>
                                  <md-input v-model="username" type="text" required></md-input>
                              </md-field>
                            </div>
                            <div class="test3">
                            <md-button class="md-primary">Generate User Name</md-button>
                            </div>
                          <div class="test1">
                            <label for="country" class="test1"><span class="md-body-2">confirm Password</span></label>
                            </div>
                            <div class="test2">
                              <md-field>
                                <label>Confirm Password</label>
                                  <md-input v-model="password" type="password"></md-input>
                              </md-field>
                            </div>
                            <div class="test3">
                            <md-button class="md-primary">Generate Password</md-button>
                            </div>
                            <div class="test1">
                            <label for="country" class="test1"><span class="md-body-2">confirm Password</span></label>
                            </div>
                            <div class="test2">
                              <md-field>
                                <label>Confirm Password</label>
                                  <md-input v-model="password" type="password"></md-input>
                              </md-field>
                            </div>
                            <div></div>
                            <div class="test1">
                            <label for="country" class="test1"><span class="md-body-2">Email</span></label>
                            </div>
                            <div class="test2">
                              <md-field>
                                <label>Email</label>
                                  <md-input v-model="email" type="mail"></md-input>
                              </md-field>
                            </div>
                            <div></div>
                        </div>

            <!-- User Name -->
           

      <!-- Buttons -->
      <div class="row-layout2">
                    <div id="buttons">
                        <div>
                          <md-button type="submit" class="md-success" >Save</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                          <md-button type="button" class="md-danger">Cancel</md-button>
                        </div>
                      </div>
                    </div>  

            </md-card-content>
              </md-card>   
            </div>
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
          { name: "1", salary: "738", country: "Jhon", city: "Jhon12" },
          { name: "2", salary: "738", country: "Rahul", city: "Rahul56" },
          { name: "3", salary: "142", country: "Ram", city: "Ram23" },
          { name: "4", salary: "735", country: "Sham", city: "Sham12" },
          { name: "5", salary: "542", country: "Shiv", city: "Shiv23" },
          { name: "6", salary: "615", country: "Mahesh", city: "Mahesh55" },
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

.struct{
    display: grid;
    grid-template-columns: 135px 260px 38px;
    grid-gap: 25px;
    grid-auto-rows: 50px; 
    
    /*grid-auto-rows: 50px;  Set all rows to 50px height */
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
  /* md-field, md-select, md-option{
    max-width: 90px;
  } */
  .header-title {
    font-size: 1rem;
    margin: 0 0 7px 0;
  }
  
  .test1{
    text-align: right;
  }

  .card-box {
    background-color: #fff;
    /* padding: 1.5rem 0rem 0rem 0rem; */
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

  .row-layout2{
    display: flex;
    flex-direction: column; 
    align-items: flex-end;
    margin-top: 40px;
  }

  .form-style{
    display:flex;
    flex-direction:column;
    align-items:center;
  }
  </style>
  
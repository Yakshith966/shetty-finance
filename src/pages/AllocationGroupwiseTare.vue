<!-- lightsteelblue -->

<template>
    <div>
      <div class="card-box">
        <div class="row align-items-center mb-3">
          <div class="col">
            <h4 class="mt-0 header-title">ALLOCATION OF GROUPWISE TARE WT</h4>
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
  
            <label for="movie" class="custom-input-sm">Show         
               <select name="" class="form-control" id="">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="">All</option>
            </select></label>
  
          </div>
  
          <md-field class="custom-md-field" style="margin: 0px 0px 0px 0px">
            <label>Search...</label>
            <md-input v-model="initial"></md-input>
          </md-field>
          <md-icon>search</md-icon>
        </div>
  
        <div
          class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
        >
          <md-card>
            <md-card-header data-background-color="green">
              <h4 class="title">FEED INGREDIENT MASTER</h4>
              <!-- <p class="category">List of Users</p> -->
            </md-card-header>

            <md-card-content>
              <md-table
                v-model="users"
                :table-header-color="tableHeaderColor"
                class="custom-table"
              >
                <tr>
                  <th>Pen No</th>
                  <th>PST</th>
                  <th>ST</th>
                  <th>FN1</th>
                  <th>FN2</th>
                </tr>
  
                <tr v-for="item in users" :key="item.pen_no">
                  <td>{{ item.pen_no }}</td>
                  <td>{{ item.PST }}</td>
                  <td>{{ item.ST }}</td>
                  <td>{{ item.FN1 }}</td>
                  <td>{{ item.FN2 }}</td>

                </tr>
              </md-table>
            </md-card-content>
          </md-card>
        </div>
      </div>

      <!----------//here---------------------------------------------------------------------------------------------------------->
  
      <div v-if="activeTab === 'apply'" class="mt-3">
        <!-- <div v-if="activeTab === 'FeedConsumption'"> -->
      <md-card>
        <md-card-header data-background-color="green">
          <h4 class="title">ALLOCATION OF GROUPWISE TARE WT</h4>
          <!-- <p class="category">List of Users</p> -->
        </md-card-header>


        <md-card-content>
          <!-- <div class="table-layout">

                      </div> -->
          <hr />

          <div class="table-container">
            <div class="custm-header">
              <div class="t-cell">Age in Days/Week</div>
              <div class="t-cell">Trail Group</div>
              <div class="t-cell">Pen Number</div>
              <div class="t-cell">No of Birds</div>
              <div class="t-cell">Alloted Feed(Gms)</div>
              <div class="t-cell">Consumed Feed(in Gms)</div>
              <div class="t-cell">Feed Consumed Per Bird(Gms)</div>
              <!-- <div class="t-cell">Action</div> -->
            </div>
            <div v-for="row in FeedConsumption" :key="row.id" class="custm-row">
              <div class="t-cell">
                <select
                  name="cars"
                  v-model="row.ageDays"
                  id="cars"
                  class="select-style"
                >
                  <option value="volvo">Volvo</option>
                  <option value="saab">Saab</option>
                  <option value="opel">Opel</option>
                  <option value="audi">Audi</option>
                </select>
              </div>
              <div class="t-cell">
                <select
                  name="cars"
                  v-model="row.feedTrailGroup"
                  id="cars"
                  class="select-style"
                >
                  <option value="volvo">Volvo</option>
                  <option value="saab">Saab</option>
                  <option value="opel">Opel</option>
                  <option value="audi">Audi</option>
                </select>
              </div>
              <div class="t-cell">
                <select
                  name="cars"
                  v-model="row.feedPenNo"
                  id="cars"
                  class="select-style"
                >
                  <option value="volvo">Volvo</option>
                  <option value="saab">Saab</option>
                  <option value="opel">Opel</option>
                  <option value="audi">Audi</option>
                </select>
              </div>
              <div class="t-cell">
                <input type="number" v-model="row.noBirds" />
              </div>
              <div class="t-cell">
                <input type="number" v-model="row.feedAlloted" />
              </div>
              <div class="t-cell">
                <input type="number" v-model="row.feedConsumed" />
              </div>
              <div class="t-cell">
                <input type="number" v-model="row.feedConsumedPerBird" />
              </div>
            </div>
          </div>
          <hr />
          <div class="sec-row">
            <div>
              <md-button @click="addRowFeedConsumption" class="md-primary"
                >Add Row</md-button
              >
            </div>
            <div></div>
            <div></div>
            <div>
              <md-button type="submit" @click="displayCf" class="md-success"
                >Save</md-button
              >
            </div>
            <div>
              <md-button type="button" class="md-danger">Reset</md-button>
            </div>
          </div>
        </md-card-content>'
        
      </md-card>
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
        activeTab: "list", // Default active tab
        users: [
          { pen_no: "1", PST: "1.150", ST: "2.090", FN1: "1.230", FN2: "1.210" },
          { pen_no: "6", PST: "1.250", ST: "2.200", FN1: "1.270", FN2: "1.230" },
          { pen_no: "11", PST: "1.220", ST: "2.090", FN1: "1.210", FN2: "1.220" },
          { pen_no: "22", PST: "1.230", ST: "2.110", FN1: "1.190", FN2: "1.240"},
          { pen_no: "Avg", PST: "1.226", ST: "2.112", FN1: "1.190", FN2: "1.240" },

        ],
      };
    },
    methods: {
      isActive(tab) {
        return this.activeTab === tab;
      },
      setActiveTab(tab) {
        this.activeTab = tab;
      },
    },
  };
  </script>
  
  <style scoped>
  .custom-md-field {
    /* Adjust the overall size of the md-field if needed */
    width: 190px;
    /* Adjust as needed */
  }
  
  .custom-md-input {
    /* Adjust the size of the input */
    width: 50px;
    /* Change the width as needed */
    /* height: 30px; Change the height as needed */
    /*padding: 5px;  Adjust padding as needed */
    font-size: 14px;
    /* Adjust font size as needed */
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
  
  .nav-pills .nav-link.active,
  .nav-pills .show > .nav-link {
    color: #fff !important;
    background-color: #71b6f9 !important;
  }
  
  .align-items-center {
    align-items: center !important;
    padding: 0px 65px 0px 20px;
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
    padding: 1.2rem 0rem 0.2rem 0rem;
    /* list/create */
    -webkit-box-shadow: 0 0.75rem 6rem rgba(56, 65, 74, 0.03);
    box-shadow: 0 0.75rem 6rem rgba(56, 65, 74, 0.03);
    margin-bottom: 1px;
    border-radius: 0.25rem;
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
    display: inline;
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
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
      border-color 0.15s ease-in-out;
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
  
  ol,
  ul,
  dl {
    margin-top: 0;
    margin-bottom: 1rem;
  }
  
  .create-field {
    display: flex;
    flex-direction: column;
    align-items: left;
  }
  
  .all-buttons {
    display: flex;
    flex-direction: row;
    padding: 5px 10px;
  }
  </style>
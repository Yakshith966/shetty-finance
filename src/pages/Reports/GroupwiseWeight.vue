<template>
  <div>
    <div v-if="activeTab === 'list'">
      <div class="row align-items-center mb-3">
        <div class="col-md-4 d-flex">
           <label for="movie" class="mt-2 font-weight-bold"> Trial No:    </label>     
             <select name="" class="form-control width-10 ml-2 pl-2" id="">
              <option disabled>Select</option>
            <option value="T10/10/22">T10/10/22</option>
            <option value="T11/10/22">T11/10/22</option>
            <option value="T12/10/22">T12/10/22</option>
          </select>
        </div>

          <div class="col-md-2">
            <!-- <md-button class="greyblue-button">Generate Report</md-button> -->
            <button type="button" class="btn btn-sm btn-info">
              <md-icon class="text-white">list</md-icon> Generate Report
            </button>
          </div>
  
          <div class="col-md-2">
            <!-- <md-button class="bg-info">
              <md-icon>download</md-icon> Export Data
            </md-button> -->
            <button type="button" class="btn btn-sm btn-primary">
              <md-icon class="text-white">download</md-icon>Export Data
            </button>
          </div>
  
          <div class="col-md-2">

            <button type="button" class="btn btn-sm btn-success">
              <md-icon class="text-white">download</md-icon> Download PDF
            </button>
          </div>
        <div class="col-md-2 d-flex">
            <md-field class="custom-md-field">
          <label>Search...</label>
          <md-input v-model="initial"></md-input>
        </md-field>
        <md-icon>search</md-icon>
        </div>
        <!-- 
                <md-field class="custom-md-field" style="margin:0px 0px 0px 0px">
                    <label>Search...</label>
                    <md-input v-model="initial"></md-input>
                </md-field>
                <md-icon>search</md-icon> -->
      </div>

      <div
        class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
      >
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">
              GROUPWISE MALE/FEMALE BIRD'S BODY WEIGHT AT 5TH WEEK
            </h4>
          </md-card-header>
          <md-card-content>
            <md-table
              v-model="users"
              :table-header-color="tableHeaderColor"
              class="custom-table"
            >
              <!-- <thead> -->
                <tr>
                  <th rowspan="2">Group</th>
                  <th rowspan="2">Total Birds</th>
                  <th rowspan="2">Male Birds</th>
                  <th  rowspan="2">Female Birds</th>
                  <th colspan="2" >Body Weight</th>
                  <th rowspan="2">FCR</th>
                </tr>

                <tr>
                 
                 
                  <th>Male Birds</th>
                  <th>Female Birds</th>
                
                </tr>
              <!-- </thead> -->

              <tr v-for="item in users" :key="item.Group">
                <!--item-grp?-->
                <td>{{ item.Group }}</td>
                <td>{{ item.Total_birds }}</td>
                <td>{{ item.Male }}</td>
                <td>{{ item.Female }}</td>
                <td>{{ item.Male_wt }}</td>
                <td>{{ item.Female_wt }}</td>
                <td>{{ item.FCR }}</td>
              </tr>
            </md-table>
          </md-card-content>
        </md-card>
      </div>
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
        {
          Group: "T1",
          Total_birds: "144",
          Male: "98",
          Female: "49",
          Male_wt: " ",
          Female_wt: " ",
          FCR: " ",
        },
        {
          Group: "T2",
          Total_birds: "142",
          Male: "75",
          Female: "67",
          Male_wt: " ",
          Female_wt: " ",
          FCR: " ",
        },
        {
          Group: "T3",
          Total_birds: "148",
          Male: "77",
          Female: "71",
          Male_wt: " ",
          Female_wt: " ",
          FCR: " ",
        },
        {
          Group: "T4",
          Total_birds: "147",
          Male: "79",
          Female: "68",
          Male_wt: " ",
          Female_wt: " ",
          FCR: " ",
        },
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
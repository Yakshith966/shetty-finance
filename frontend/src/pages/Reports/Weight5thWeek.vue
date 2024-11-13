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

        <div class="col-md-4 d-flex">
          <label for="" class="d-flex mt-2 font-weight-bold"> Start date </label>
          <input
            type="text"
            value="15/10/2022"
            disabled
            class="form-control w-50 ml-2 pl-2"
          />
        </div>

        <!-- <div class="col">
            End date
            <md-button class="greyblue-button">19/11/2022</md-button>
          </div> -->

        <div class="col-md-4 d-flex">
          <label for="" class="d-flex mt-2 font-weight-bold"> End date </label>
          <input
            type="text"
            value="19/11/2022"
            disabled
            class="form-control w-50 ml-2 pl-2"
          />
        </div>

        <!-- 
                  <md-field class="custom-md-field" style="margin:0px 0px 0px 0px">
                      <label>Search...</label>
                      <md-input v-model="initial"></md-input>
                  </md-field>
                  <md-icon>search</md-icon> -->
      </div>

      <div class="row align-items-center mb-3">
        <!-- <div class="col">
  <label for="movie" class="custom-input-sm">Show         
             <select name="" class="form-control" id="">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="">All</option>
          </select></label>
        </div> -->

        <div class="col-md-2 d-flex">
          <label for="" class="d-flex mt-2 font-weight-bold">Temp</label>
          <input
            type="text"
            value="26*C"
            disabled
            class="form-control pl-2 w-50 ml-2"
          />
        </div>

        <!-- <div class="col">
            End date
            <md-button class="greyblue-button">19/11/2022</md-button>
          </div> -->

        <div class="col-md-2 d-flex">
          <label for="" class="d-flex mt-2 font-weight-bold">RH</label>
          <input
            type="text"
            value="91"
            disabled
            class="form-control pl-2 w-50 ml-2"
          />
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
          <!-- <md-button class="bg-success">
              <md-icon>download</md-icon> Download PDF
            </md-button> -->
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
        
      </div>

      <div
        class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
      >
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">bird weight on 5th week</h4>
            <!-- <p class="category">List of Users</p> -->
          </md-card-header>
          <md-card-content>
            <md-table
              v-model="users"
              :table-header-color="tableHeaderColor"
              class="custom-table"
            >
              <tr>
                <th>Group No</th>
                <th>Pen No.</th>
                <th>No of Birds</th>
                <th>Male</th>
                <th>Female</th>
                <th>Feed consumed per bird</th>
                <th>Avg wt/bird</th>
                <th>Avg wt/bird Male</th>
                <th>Avg wt/bird Female</th>
                <th>FCR</th>
              </tr>

              <tr v-for="(item,index) in users" :key="index">
                <!--item-grp?-->
                <td>{{ item.Group }}</td>
                <td>{{ item.pen_no }}</td>
                <td>{{ item.no_of_birds }}</td>
                <td>{{ item.male }}</td>
                <td>{{ item.Female }}</td>
                <td>{{ item.Feed }}</td>
                <td>{{ item.Avg_bird_wt }}</td>
                <td>{{ item.Avg_male_wt }}</td>
                <td>{{ item.Avg_female_wt }}</td>
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
          pen_no: "1",
          no_of_birds: "28",
          male: "23",
          Female: "5",
          Feed: "3.385",
          Avg_bird_wt: "1.976",
          Avg_male_wt: "2.034",
          Avg_female_wt: "1.708",
          FCR: "1.713",
        },
        {
          Group: "T1",
          pen_no: "6",
          no_of_birds: "28",
          male: "22",
          Female: "6",
          Feed: "3.337",
          Avg_bird_wt: "2.056",
          Avg_male_wt: "2.133",
          Avg_female_wt: "1.773",
          FCR: "1.623",
        },
        {
          Group: "T1",
          pen_no: "11",
          no_of_birds: "30",
          male: "23",
          Female: "7",
          Feed: "3.201",
          Avg_bird_wt: "2.036",
          Avg_male_wt: "2.108",
          Avg_female_wt: "1.801",
          FCR: "1.572",
        },
        {
          Group: "T1",
          pen_no: "17",
          no_of_birds: "29",
          male: "11",
          Female: "18",
          Feed: "3.102",
          Avg_bird_wt: "1.946",
          Avg_male_wt: "2.206",
          Avg_female_wt: "1.786",
          FCR: "1.595",
        },
        {
          Group: "T1",
          pen_no: "22",
          no_of_birds: "29",
          male: "16",
          Female: "13",
          Feed: "3.187",
          Avg_bird_wt: "1.999",
          Avg_male_wt: "2.149",
          Avg_female_wt: "1.813",
          FCR: "1.595",
        },
        {
          Group: "T1",
          pen_no: "Total",
          no_of_birds: "144",
          male: "95",
          Female: "49",
          Feed: "3.243",
          Avg_bird_wt: "2.002",
          Avg_male_wt: "2.114",
          Avg_female_wt: "1.786",
          FCR: "1.619",
        },

        //------------------ T2

        {
          Group: "T2",
          pen_no: "2",
          no_of_birds: "28",
          male: "20",
          Female: "8",
          Feed: "3.141",
          Avg_bird_wt: "1.792",
          Avg_male_wt: "1.872",
          Avg_female_wt: "1.593",
          FCR: "1.753",
        },
        {
          Group: "T2",
          pen_no: "7",
          no_of_birds: "30",
          male: "23",
          Female: "7",
          Feed: "3.207",
          Avg_bird_wt: "1.987",
          Avg_male_wt: "2.054",
          Avg_female_wt: "1.767",
          FCR: "1.614",
        },

        {
          Group: "T2",
          pen_no: "12",
          no_of_birds: "28",
          male: "12",
          Female: "16",
          Feed: "3.286",
          Avg_bird_wt: "2.050",
          Avg_male_wt: "2.231",
          Avg_female_wt: "1.914",
          FCR: "1.603",
        },
        {
          Group: "T2",
          pen_no: "16",
          no_of_birds: "28",
          male: "11",
          Female: "17",
          Feed: "3.196",
          Avg_bird_wt: "1.980",
          Avg_male_wt: "2.150",
          Avg_female_wt: "1.870",
          FCR: "1.614",
        },
        {
          Group: "T2",
          pen_no: "21",
          no_of_birds: "28",
          male: "9",
          Female: "19",
          Feed: "3.091",
          Avg_bird_wt: "1.976",
          Avg_male_wt: "2.162",
          Avg_female_wt: "1.888",
          FCR: "1.564",
        },
        {
          Group: "T2",
          pen_no: "Total",
          no_of_birds: "142",
          male: "75",
          Female: "67",
          Feed: "3.184",
          Avg_bird_wt: "1.957",
          Avg_male_wt: "2.061",
          Avg_female_wt: "1.842",
          FCR: "1.627",
        },

        //------------------ T3

        {
          Group: "T3",
          pen_no: "5",
          no_of_birds: "29",
          male: "22",
          Female: "7",
          Feed: "3.256",
          Avg_bird_wt: "2.059",
          Avg_male_wt: "2.120",
          Avg_female_wt: "1.866",
          FCR: "1.582",
        },
        {
          Group: "T3",
          pen_no: "10",
          no_of_birds: "30",
          male: "22",
          Female: "8",
          Feed: "3.203",
          Avg_bird_wt: "1.994",
          Avg_male_wt: "2.052",
          Avg_female_wt: "1.834",
          FCR: "1.606",
        },

        {
          Group: "T3",
          pen_no: "13",
          no_of_birds: "30",
          male: "11",
          Female: "19",
          Feed: "3.210",
          Avg_bird_wt: "2.059",
          Avg_male_wt: "2.239",
          Avg_female_wt: "1.954",
          FCR: "1.559",
        },
        {
          Group: "T3",
          pen_no: "18",
          no_of_birds: "29",
          male: "10",
          Female: "19",
          Feed: "3.137",
          Avg_bird_wt: "1.995",
          Avg_male_wt: "2.165",
          Avg_female_wt: "1.905",
          FCR: "1.573",
        },
        {
          Group: "T3",
          pen_no: "23",
          no_of_birds: "30",
          male: "12",
          Female: "18",
          Feed: "2.954",
          Avg_bird_wt: "1.756",
          Avg_male_wt: "1.863",
          Avg_female_wt: "1.684",
          FCR: "1.682",
        },
        {
          Group: "T3",
          pen_no: "Total",
          no_of_birds: "148",
          male: "77",
          Female: "71",
          Feed: "3.152",
          Avg_bird_wt: "1.972",
          Avg_male_wt: "2.083",
          Avg_female_wt: "1.850",
          FCR: "1.598",
        },

        //------------------ T4

        {
          Group: "T4",
          pen_no: "4",
          no_of_birds: "29",
          male: "21",
          Female: "8",
          Feed: "3.241",
          Avg_bird_wt: "2.014",
          Avg_male_wt: "2.113",
          Avg_female_wt: "1.754",
          FCR: "1.609",
        },
        {
          Group: "T4",
          pen_no: "9",
          no_of_birds: "30",
          male: "25",
          Female: "5",
          Feed: "3.256",
          Avg_bird_wt: "2.070",
          Avg_male_wt: "2.149",
          Avg_female_wt: "1.678",
          FCR: "1.573",
        },

        {
          Group: "T4",
          pen_no: "14",
          no_of_birds: "29",
          male: "10",
          Female: "19",
          Feed: "3.058",
          Avg_bird_wt: "2.056",
          Avg_male_wt: "2.182",
          Avg_female_wt: "1.989",
          FCR: "1.487",
        },
        {
          Group: "T4",
          pen_no: "19",
          no_of_birds: "30",
          male: "11",
          Female: "19",
          Feed: "3.010",
          Avg_bird_wt: "1.904",
          Avg_male_wt: "2.109",
          Avg_female_wt: "1.785",
          FCR: "1.581",
        },
        {
          Group: "T4",
          pen_no: "24",
          no_of_birds: "29",
          male: "12",
          Female: "17",
          Feed: "3.034",
          Avg_bird_wt: "1.892",
          Avg_male_wt: "2.032",
          Avg_female_wt: "1.794",
          FCR: "1.604",
        },
        {
          Group: "T4",
          pen_no: "Total",
          no_of_birds: "147",
          male: "79",
          Female: "68",
          Feed: "3.120",
          Avg_bird_wt: "1.987",
          Avg_male_wt: "2.120",
          Avg_female_wt: "1.883",
          FCR: "1.570",
        },

        //------------------ T5

        {
          Group: "T5",
          pen_no: "3",
          no_of_birds: "23",
          male: "17",
          Female: "6",
          Feed: "2.675",
          Avg_bird_wt: "1.533",
          Avg_male_wt: "1.629",
          Avg_female_wt: "1.258",
          FCR: "1.745",
        },
        {
          Group: "T5",
          pen_no: "8",
          no_of_birds: "21",
          male: "12",
          Female: "9",
          Feed: "3.045",
          Avg_bird_wt: "1.674",
          Avg_male_wt: "1.777",
          Avg_female_wt: "1.538",
          FCR: "1.818",
        },

        {
          Group: "T5",
          pen_no: "15",
          no_of_birds: "24",
          male: "7",
          Female: "17",
          Feed: "2.607",
          Avg_bird_wt: "1.555",
          Avg_male_wt: "1.731",
          Avg_female_wt: "1.482",
          FCR: "1.676",
        },
        {
          Group: "T5",
          pen_no: "20",
          no_of_birds: "20",
          male: "8",
          Female: "12",
          Feed: "2.747",
          Avg_bird_wt: "1.610",
          Avg_male_wt: "1.774",
          Avg_female_wt: "1.501",
          FCR: "1.706",
        },
        {
          Group: "T5",
          pen_no: "25",
          no_of_birds: "21",
          male: "9",
          Female: "12",
          Feed: "2.772",
          Avg_bird_wt: "2.234",
          Avg_male_wt: "3.073",
          Avg_female_wt: "1.605",
          FCR: "1.241",
        },
        {
          Group: "T5",
          pen_no: "Total",
          no_of_birds: "109",
          male: "53",
          Female: "56",
          Feed: "2.769",
          Avg_bird_wt: "1.721",
          Avg_male_wt: "1.943",
          Avg_female_wt: "1.498",
          FCR: "1.609",
        },

        {
          Group: " ",
          pen_no: "Total",
          no_of_birds: "690",
          male: "379",
          Female: "311",
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
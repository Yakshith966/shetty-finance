<template>
    <div>

        <div v-if="activeTab === 'list'">
            <div class="row align-items-center mb-3">

                <div class="col">          
                <md-field class="custom-md-field">
                <label for="movie">Select Trial No</label>
                    <md-select v-model="movie" name="movie" id="movie" class="custom-md-input">
                        <md-option value="T10/10/22">T10/10/22</md-option>
                        <md-option value="T11/10/22">T11/10/22</md-option>
                        <md-option value="T12/10/22">T12/10/22</md-option>
                    </md-select>
                </md-field>
              </div>


              <div class="col">
                    <md-button class="greyblue-button">Generate Report</md-button>
                </div>

                <div class="col">
    
                    <md-button class="blue-button">
                        <md-icon>download</md-icon> Export Data
                    </md-button>
                  
                </div>

                <div class="col">
                   
                    <md-button class="green-button">
                        <md-icon>download</md-icon> Download PDF
                    </md-button>
                </div>

<!-- 
                <md-field class="custom-md-field" style="margin:0px 0px 0px 0px">
                    <label>Search...</label>
                    <md-input v-model="initial"></md-input>
                </md-field>
                <md-icon>search</md-icon> -->
            </div>


            <div class="row align-items-center mb-3">   
            <div class="col">          

                <md-field class="custom-md-field">
                <label for="movie">show</label>
                    <md-select v-model="movie" name="movie" id="movie" class="custom-md-input">
                        <md-option value="5">5</md-option>
                        <md-option value="10">10</md-option>
                        <md-option value="15">15</md-option>
                        <md-option value=" ">All</md-option>

                    </md-select>
                </md-field>
              </div>
              
              <md-field class="custom-md-field" >
                    <label>Search...</label>
                    <md-input v-model="initial"></md-input>
                </md-field>
                <md-icon>search</md-icon>
            </div>
  

            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">MALE/FEMALE BIRD RATIO AS EQUAL NUMBERS</h4>
                        <!-- <p class="category">List of Users</p> -->
                    </md-card-header>
                    <md-card-content>
                        <md-table v-model="users" :table-header-color="tableHeaderColor">
                            <!-- <md-table-row>
                                <md-table-head>Group</md-table-head>
                                <md-table-head>Male Birds</md-table-head>
                                <md-table-head>Male Birds Body Wt</md-table-head>
                                <md-table-head>Female Birds</md-table-head>
                                <md-table-head>Female Birds Body Wt</md-table-head>
                                <md-table-head>Total Body Wt</md-table-head>
                                <md-table-head>Group Avg</md-table-head>
                                <md-table-head>...</md-table-head>
                            </md-table-row> -->
                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <md-table-cell md-label="Group">{{ item.Group }}</md-table-cell>
                                <md-table-cell md-label="Male Birds">{{ item.Male_Birds }}</md-table-cell>
                                <md-table-cell md-label="Male Birds Body Wt">{{ item.Male_Wt }}</md-table-cell>
                                <md-table-cell md-label="Female Birds">{{ item.Female_Birds }}</md-table-cell>
                                <md-table-cell md-label="Female Birds Body Wt">{{ item.Female_Wt }}</md-table-cell>
                                <md-table-cell md-label="Total Body Wt">{{ item.Total_wt }}</md-table-cell>
                                <md-table-cell md-label="Group Avg">{{ item.Group_avg }}</md-table-cell>
                                <md-table-cell md-label="FCR">{{ item.FCR }}</md-table-cell>
                            </md-table-row>
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
            activeTab: 'list', // Default active tab
            users: [
                { Group: "T1", Male_Birds: "72", Male_Wt: "152.21", Female_Birds: "72", Female_Wt: "128.59", Total_wt: "280.80", Group_avg: "1.950", FCR: "1.619" },
                { Group: "T2", Male_Birds: "71", Male_Wt: "146.33", Female_Birds: "71", Female_Wt: "130.78", Total_wt: "277.11", Group_avg: "1.952", FCR: "1.627" },
                { Group: "T3", Male_Birds: "74", Male_Wt: "154.14", Female_Birds: "74", Female_Wt: "136.90", Total_wt: "291.04", Group_avg: "1.967", FCR: "1.598" },
                { Group: "T4", Male_Birds: "74", Male_Wt: "156.88", Female_Birds: "73", Female_Wt: "133.81", Total_wt: "290.69", Group_avg: "1.977", FCR: "1.570" },
                { Group: "T4", Male_Birds: "55", Male_Wt: "106.87", Female_Birds: "54", Female_Wt: "80.89", Total_wt: "187.76", Group_avg: "1.723", FCR: "1.690" },
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
.nav-pills .show>.nav-link {
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
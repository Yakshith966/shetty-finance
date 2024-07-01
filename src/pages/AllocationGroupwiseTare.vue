<!-- lightsteelblue -->

<template>
  <div>
    <!-- <div class="card-box">
      <div class="row align-items-center mb-3">
        <div class="col">
          <h4 class="mt-0 header-title">ALLOCATION OF GROUPWISE TARE WT</h4>
        </div>

      </div>
    </div> -->

 
    <!----------//here---------------------------------------------------------------------------------------------------------->

    <div class="mt-3">
      <!-- <div v-if="activeTab === 'FeedConsumption'"> -->
    <md-card>
      <md-card-header data-background-color="green">
        <h4 class="title">ALLOCATION GROUPWISE TARE</h4>
        <!-- <p class="category">List of Users</p> -->
      </md-card-header>


      <md-card-content>
  


        <!-- <md-card-content> -->
          
            <div class=" row mt-3">
              <div class="col-md-12 d-flex">
               
                <label class="ml-1 "> <input type="radio" class="w-auto mr-1" name="options" value="option" />Feeder Drum</label>
              <label class="ml-4">
                <input type="radio" class="w-auto ml-1" name="options" value="option2" />
                Drum
              </label>
              <label class="ml-4">
                <input type="radio" class="w-auto" name="options" value="option3" />
                Feeder
              </label>
              <label class="ml-4">
                <input type="radio" class="w-auto ml-1" name="options" value="option2" />
                Drinker
              </label>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-3 d-flex ">
              <label class="my-auto ml-1">Group:
               
              </label>
               <select name="" id="" class="form-control width-10 ml-2 pl-2">
                  <option value="1">T1</option>
                  <option value="2">T2</option>
                  <option value="3">T3</option>
                  <option value="4">T4</option>
                </select>
            </div>
          </div>
          <!-- </md-card-content> -->



        <div class="table-container mt-5">
          <div class="custm-header">
            <div class="t-cell">Pen No</div>
            <div class="t-cell">PST</div>
            <div class="t-cell">ST</div>
            <div class="t-cell">FN1</div>
            <div class="t-cell">FN2</div>
            <!-- <div class="t-cell">Action</div> -->
          </div>
          <div v-for="(item,index) in groupWiseAllocData" :key="index" class="custm-row">
            <div class="t-cell">
              <select
                name="cars"
                v-model="item.penNo"
                id="cars"
                class="select-style"
              >
              <option value="1">1</option>
                <option value="6">6</option>
                <option value="11">11</option>
                <option value="22">22</option>
              </select>
            </div>
            <div class="t-cell">
              <input type="number" v-model="item.pst" />
            </div>
            <div class="t-cell">
              <input type="number" v-model="item.st" />
            </div>
            <div class="t-cell">
              <input type="number" v-model="item.fn1" />
            </div>
            <div class="t-cell">
              <input type="number" v-model="item.fn2" />
            </div>

          </div>
        </div>
       <div class="row mt-2">
        <div class="col-md-12 d-flex justify-content-between">
<md-button @click="addRowGroupWiseAlloc()" class="md-primary"
              >Add Row</md-button
            >
             <div>  <md-button type="submit" @click="saveData()" class="md-success"
              >Save</md-button
            >
            
            <md-button type="button" class="md-danger ml-2">Reset</md-button></div>
       </div>
        </div>
       
       
    
      </md-card-content>


      <md-card>
          <!-- <md-card-header data-background-color="green">
            <h4 class="title">FEED CONSUMPTION PER BIRD(GMS)</h4>
          </md-card-header> -->

          <md-card-content>
            <table class="styled-table">
              <thead>
                <tr>
                  <th>Pen No</th>
                  <th>PST</th>
                  <th>ST</th>
                  <th>FN1</th>
                  <th>FN2</th>
                  <th>Action</th>
                  <!-- <th>Delete</th> -->
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in savedData" :key="item.id">
                  <td>
                    <template v-if="!item.isEdit">{{
                      item.penNo
                    }}</template>
                    <template v-else>
                      <select v-model="item.penNo" class="slct2">
                        <option value="1">1</option>
                        <option value="6">6</option>
                        <option value="11">11</option>
                        <option value="22">22</option>
                      </select>
                    </template>
                  </td>
                  <td>
                    <template v-if="!item.isEdit">{{
                      item.pst
                    }}</template>
                    <template v-else>
                      <input v-model="item.pst" class="custm" />
                    </template>
                  </td>
            
                  <td>
                    <template v-if="!item.isEdit">{{
                      item.st
                    }}</template>
                    <template v-else>
                      <input v-model="item.st" class="custm" />
                    </template>
                  </td>
                  <td>
                    <template v-if="!item.isEdit">{{
                      item.fn1
                    }}</template>
                    <template v-else>
                      <input v-model="item.fn1" class="custm" />
                    </template>
                  </td>
                  <td>
                    <template v-if="!item.isEdit">{{
                      item.fn2
                    }}</template>
                    <template v-else>
                      <input v-model="item.fn2" class="custm" />
                    </template>
                  </td>
                  <td>
                    <button v-if="!item.isEdit" @click="toggleEdit(item)">
                      <md-icon>edit_square</md-icon>
                    </button>
                    <button v-else @click="saveChanges(item)">
                      <md-icon>save</md-icon>
                    </button>
                  </td>
                  <!-- <td>
                <div class="t-cell" @click="removeFeedRow(row)" style="cursor: pointer;">
                              <md-icon>clear</md-icon>
                 </div>
              </td> -->
                </tr>
              </tbody>
            </table>
          </md-card-content>
        </md-card>





      
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
      

      groupWiseAllocData:[{penNo:'',pst:'',st:'',fn1:'',fn2:'',isEdit:false}],
      savedData:[]
        
     
    };
  },
  methods: {
    isActive(tab) {
      return this.activeTab === tab;
    },
    setActiveTab(tab) {
      this.activeTab = tab;
    },
    addRowGroupWiseAlloc(){
      this.groupWiseAllocData.push({penNo:'',pst:'',st:'',fn1:'',fn2:'',isEdit:false});
  },
  saveChanges(item) {
    item.isEdit = false;
    // Additional logic to save changes if needed
  },
  saveData() {
    this.savedData.push(...this.groupWiseAllocData);
    this.groupWiseAllocData = [
      
        {penNo:'',pst:'',st:'',fn1:'',fn2:''}
      
    ];
  },

  toggleEdit(item) {
    item.isEdit = !item.isEdit;
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

.slct2 {
height: 40px;
width: 130px;
}
td{
font-weight: normal;
}
.select-style{
background-color: transparent;
}
</style>
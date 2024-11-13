<template>
     <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">Base Feed Formula</h4>
                </md-card-header>
                <md-card-content>
                    <div>
                        <md-card-content>
              <md-card-content>

                  <hr>

                  <div>
                    <div class="table-header">
                        <div class="table-cell">Controls</div>
                        <div class="table-cell">Raw Material</div>
                        <div class="table-cell">PBS</div>
                        <div class="table-cell">BS</div>
                        <div class="table-cell">BF-1</div>
                        <div class="table-cell">Action</div>
                    </div>
                    <div v-for="row in rawMaterials" :key="row.id" class="table-row">
                      <div class="table-cell"> 
                <!-- <label for="country">Select</label> -->
                <select required v-model="row.control" name="country" id="country" class="slct">
                  <option value="arial">Positive Control</option>
                  <option value="calibri">Control</option>
                  <option value="cambria">Negative Control 1</option>
                  <option value="comic-sans">Negative Control 2</option>
                  <option value="consolas">Negative Control 3</option>
                </select>
              </div>
                        <div class="table-cell"> 
                            <select name="cars" v-model="row.Raw_Material" class="slct">
                                    <option value="Maize">Maize</option>
                                    <option value="Jowar">Jowar</option>
                                    <option value="Rice">Rice</option>
                                    <option value="Meat">Meat</option>
                                </select>
                        </div>
                        <div class="table-cell"><input type="number" v-model="row.PBS" /></div>
                        <div class="table-cell"><input type="number" v-model="row.BS" /></div>
                        <div class="table-cell"><input type="number" v-model="row.BF_1" /></div>
                        <div class="table-cell" @click="removeRowRaw(row)" style="cursor: pointer;">
                            <md-icon>clear</md-icon>
                        </div>
                    </div>
                  </div>
                <div class="struct2">
                    <div><md-button @click="addRowRaw" class="md-primary">Add Row</md-button> </div>
                </div>

                  <hr>
                  
                  <div>
                    <div class="table-header">
                        <div class="table-cell">ADDITIVES</div>
                        <div class="table-cell">PBS</div>
                        <div class="table-cell">PBS-2</div>
                        <div class="table-cell">BS</div>
                        <div class="table-cell">Action</div>
                    </div>
                    <div v-for="(row) in additives" :key="row.id" class="table-row">
                        <div class="table-cell"> 
                            <select name="cars" v-model="row.Additives" class="slct">
                                    <option value="Maize">Maize</option>
                                    <option value="Jowar">Jowar</option>
                                    <option value="Rice">Rice</option>
                                    <option value="Meat">Meat</option>
                                </select>
                        </div>
                        <div class="table-cell"><input type="number" v-model="row.PBS" /></div>
                        <div class="table-cell"><input type="number" v-model="row.PBS_2" /></div>
                        <div class="table-cell"><input type="number" v-model="row.BF" /></div>
                        <div class="table-cell" @click="removeRowAdditives(row)" style="cursor: pointer;">
                            <md-icon>clear</md-icon>
                        </div>
                        </div>
                  </div>
                <div class="struct2" >
                    <div><md-button @click="addRowAdditives" class="md-primary">Add Row</md-button> </div>
                </div>
                  <hr>
                  <div>
                    <div class="table-header">
                        <div class="table-cell">NUTRIENTS</div>
                        <div class="table-cell">PBS</div>
                        <div class="table-cell">BS</div>
                        <div class="table-cell">BF-1</div>
                        <div class="table-cell">Action</div>
                    </div>
                    <div v-for="(row) in nutrients" :key="row.id" class="table-row">
                        <div class="table-cell"> 
                            <select name="cars" v-model="row.Nutrients" class="slct">
                                    <option value="Maize">Maize</option>
                                    <option value="Jowar">Jowar</option>
                                    <option value="Rice">Rice</option>
                                    <option value="Meat">Meat</option>
                                </select>
                        </div>
                        <div class="table-cell"><input type="number" v-model="row.PBS" /></div>
                        <div class="table-cell"><input type="number" v-model="row.BS" /></div>
                        <div class="table-cell"><input type="number" v-model="row.BF_1" /></div>
                        <div class="table-cell" @click="removeRowNutrients(row)" style="cursor: pointer;">
                            <md-icon>clear</md-icon>
                        </div>
                        </div>
                  </div>
                <div class="struct2" >
                    <div><md-button @click="addRowNutrients" class="md-primary">Add Row</md-button> </div>
                </div>

                  <hr>

                  <div class="table-header">
                        <div class="table-cell">COST PER KG</div>
                        <div class="table-cell">40.25</div>
                        <div class="table-cell">35.85</div>
                        <div class="table-cell">35.75</div>
                    
                    </div>
                    <div class="table-header">
                        <div class="table-cell">GRAM/BIRD</div>
                        <div class="table-cell">0.450</div>
                        <div class="table-cell">1.000</div>
                        <div class="table-cell">1.000</div>
                     
                    </div>
                    <div class="table-header">
                        <div class="table-cell">BAGS/1000</div>
                        <div class="table-cell">9.000</div>
                        <div class="table-cell">20.00</div>
                        <div class="table-cell">20.00</div>
                       
                    </div>

            <!-- <div class="struct2">
                <div><md-button @click="addRow" class="md-primary">Add Row</md-button> </div>
             </div> -->
                 
                 </md-card-content>
                
              </md-card-content>
                    </div>
                  <!-- <div><md-button @click="addRow" class="md-primary">Add</md-button> </div> -->

</md-card-content>



                
<div class="row-layout2">
    <div id="buttons">
            <div>
                <md-button type="submit" class="md-success">Submit</md-button>
            </div>
            
            <div style="padding-left: 10px;">
                <md-button type="button" class="md-danger">Reset</md-button>
            </div>
    </div>
</div> 
        </md-card>
</template>

<script>
export default {
  data() {
    return {
      id1: 0,
      id2: 0,
      id3: 0,
      rawMaterials: [],
      additives: [],
      nutrients: []
    };
  },
  methods: {
    addRowRaw() {
      this.rawMaterials.push({ control:'',Raw_Material: '', PBS: '', BS: '', BF_1: '', isEditing: false, id: this.id1++ });
    },
    addRowAdditives() {
      this.additives.push({ Additives: '', PBS: '', PBS_2: '', BS: '', isEditing: false, id: this.id2++ });
    },
    addRowNutrients() {
      this.nutrients.push({ Nutrients: '', PBS: '', BS: '', BF_1: '', isEditing: false, id: this.id3++ });
    },
    removeRowRaw(row) {
      this.rawMaterials = this.rawMaterials.filter((i) => i !== row);
    },
    removeRowAdditives(row) {
      this.additives = this.additives.filter((i) => i !== row);
    },
    removeRowNutrients(row) {
      this.nutrients = this.nutrients.filter((i) => i !== row);
    }
  },
  mounted() {
    this.addRowRaw();
    this.addRowAdditives();
    this.addRowNutrients();
  }
};
</script>

<style>
.table-row {
  display: flex;
  /* width: 2000px;  Adjust this value based on the number of columns */ 
}

.table-cell {
  /* flex: 1; */
  padding: 8px;
  /* border: 1px solid #ddd; */
  max-width:250px;
}

.styled-table {
    /* width: 100%; */
    border-collapse: collapse;
}
.styled-table th, .styled-table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    /* width: auto; */
}
.styled-table th {
    background-color: #f2f2f2;
}
.styled-table .slct, .styled-table .custm {
    width: 100%;
    box-sizing: border-box;
}

/* .table-cell input,
.table-cell .md-select,
.table-cell .md-field {
  width: 100%;
} */

 .col-auto {
    flex: 0 0 auto;
    flex-direction: row;
    /* width: auto; */
  }
  .card-box {
    background-color: #fff;
    padding: 10px;
    -webkit-box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    /* margin-bottom: 1px; */
    border-radius: .25rem;
  }

  .align-items-center {
    align-items: center !important;
    padding:0px 65px 0px 20px;
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
  .row-layout2{
    display: flex;
    flex-direction: column; 
    align-items: flex-end;
    margin-right: 10%;
  }

  #buttons {
  display: flex;
  flex-direction: row;
  padding-top: 10px;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #71b6f9 !important;
  }

  .nav-pills .nav-link {
    background: none;
    border: 0;
    border-radius: 0.25rem;
  }


.struct{
    display: grid;
    grid-template-columns: 105px 140px 58px 200px;
    grid-gap: 25px;
    /* grid-auto-rows: 50px;  */
    /*grid-auto-rows: 50px;  Set all rows to 50px height */
}

.struct2{
  display: grid;
    grid-template-columns: 135px 250px 58px 150px 100px;
    grid-gap: 25px;
    grid-auto-rows: 50px;
    margin-left:20px; 
    padding:10px 0px;
}

/* .md-field {
  margin: 0px 0px;
} */

.grid-item {
    height: 50px;
}

/* .test1, .test2, .test3, .test4, .test5 {
  flex: 1; /* Adjust the flex-grow as needed 
} */

/* Ensure that each test class has some default width */
.test1 {
    text-align: right;
    /* grid-column: 1 / 5; */
}
.test3 {
    text-align: right;
    /* grid-column: 3 / 5; */
}
/* .test4 {
    grid-column: 4 / 5;
}
.test5 {
    grid-column: 5 / 5;
} */

.testing{
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  padding-top: 15px;
  padding-left: 20px;
  justify-content: space-between;
  gap: 20px; /* Add gap between flex items */

}

hr {
            border: none;
            height: 2px;
            background-color: #000;
            /* margin-top: 40px; */
        }

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
  
  /* .mb-3 {
    margin-bottom: 1.5rem !important;
  } */
  
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
    padding: 10px;
    -webkit-box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    box-shadow: 0 .75rem 6rem rgba(56, 65, 74, .03);
    /* margin-bottom: 1px; */
    border-radius: .25rem;
  }
  
  

.table-header, .table-row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 1000px;
}

.table-cell {
  /* flex: 1; */
  padding: 8px;
  border: 1px solid #ddd;
  box-sizing: border-box;
  max-width: 250px;
}

.table-header {
  background-color: #f5f5f5;
  font-weight: bold;
}

.table-cell select,
.table-cell input {
  /* width: 100%; */
  padding: 4px;
  box-sizing: border-box;
}

.table-cell .slct {
  width: 100%;
  height: 100%;
}

  
  .col-auto {
    flex: 0 0 auto;
    flex-direction: row;
    /* width: auto; */
  }
  
  .nav {
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }

  .styled-table {
  /* width: 100%; */
  border-collapse: collapse;
  /* margin: 25px 0; */
  font-size: 15px;
  font-weight: 500;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  /* min-width: 400px; */
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
  /* background-color: #009879; */
  /* color: #ffffff; */
  text-align: left;
}

.styled-table th,
.styled-table td {
  padding: 12px 15px;
  border: 1px solid #dddddd;
}

.styled-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.styled-table tbody tr:hover {
  background-color: #f1f1f1;
}

.styled-table td button {
  background: none;
  border: none;
  cursor: pointer;
}

.styled-table td button:focus {
  outline: none;
}
 
.slct{
    height:20px;
    /* width:130px; */
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
  padding-top: 10px;
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

  .md-list-item .md-list-item-container .md-ripple > span {
    border-radius: 3px;
    display: contents;
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

  .table-layout {
    display: flex;
    flex-direction: column;
   
  }

  .form-style{
    display:flex;
    flex-direction:column;
    align-items:center;
    padding-top:20px;
  }
  
  .row-layout {
    display: flex;
    flex-direction: row;
    align-items: center;
  }
  
  .row-layout1{
    display: flex;
    flex-direction: row; 
    align-items: flex-start;
  }
  
  .row-layout2{
    display: flex;
    flex-direction: column; 
    align-items: flex-end;
    margin-right: 10%;
  }

  .checkbox-select {
  /* width: 100%; */
  height: auto;
  border-radius: 1rem;
}
.checkbox-select__trigger {
  justify-content: space-between;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  background: #fff;
  position: relative;
  z-index: 100;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  user-select: none;
}
.checkbox-select__trigger.isActive {
  border-radius: 10px 10px 0 0;
  background: #f2f2f2;
}
.checkbox-select__trigger:hover {
  background: #f4f4f4;
}
.checkbox-select__dropdown {
  display: none;
  background: #fff;
  box-shadow: 0 12px 15px 6px rgba(0, 0, 0, 0.1);
  border-radius: 0 0 8px 8px;
  overflow: hidden;
  /* padding-bottom: 25px; */
}
.checkbox-select__dropdown {
  display: block; /* Ensure it gets shown */
}
.checkbox-select__search-wrapp {
  padding: 10px 25px 5px;
}
.checkbox-select__search-wrapp input {
  /* width: 100%; */
  height: 40px;
  border-width: 0 0 2px;
  border-style: solid;
  border-color: #000;
  font-size: 16px;
  background: transparent;
}
.checkbox-select__col {
  display: flex;
  font-size: 12px;
  padding: 0 25px;
  justify-content: space-between;
  text-transform: uppercase;
}
.checkbox-select__select-all label {

  cursor: pointer;
}
.checkbox-select__filters-wrapp {
  /* margin-top: 20px; */
  height: 157px;
  overflow-y: auto;
  padding-left: 0px;
}
.checkbox-select__check-wrapp {
  position: relative;
  padding: 0 25px;
  margin-bottom: 5px;
}
.checkbox-select__check-wrapp input[type="checkbox"] {
  display: none;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label {
  position: relative;
  cursor: pointer;
  font-size: 16px;
  line-height: 22px;
  padding-left: 30px;
  display: inline-block;
  user-select: none;
  transition: padding 0.25s ease;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label:after {
  border: solid 2px #000;
  content: "";
  /* width: 22px; */
  height: 22px;
  top: 0;
  left: 0;
  position: absolute;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label:before {
  /* width: 14px; */
  height: 14px;
  content: "";
  position: absolute;
  top: 4px;
  left: 4px;
  background-color: #000;
  opacity: 0;
  transform: scale(0.5);
  transition: all 0.2s ease;
}
.checkbox-select__check-wrapp input[type="checkbox"]:checked+label:before {
  opacity: 1;
  transform: scale(1);
}
.col-md-3 {
    flex: 0 0 auto;
    /* width: 25%; */
  }

</style>
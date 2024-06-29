<template>
    <div>
      <div class="card-box">

        <div class="row align-items-center mb-3">
          <!-- <div class="col">
            <h4 class="mt-0 header-title"><span class="md-body-2">Boiler Nutrition Trails</span></h4>
            <p class="text-muted font-14 mb-0">trails</p>
          </div> -->
          
          <!-- <div class="card-box"> -->
          <div class="col-auto">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('list') }]"
                  @click.prevent="setActiveTab('list')"
                >
                  Groupwise Formula
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('apply') }]"
                  @click.prevent="setActiveTab('apply')"
                >
                  Penwise Feed Formula Per Group
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="#"
                  :class="['nav-link', { active: isActive('DrumCrate') }]"
                  @click.prevent="setActiveTab('DrumCrate')"
                >
                  Penwise Allotted Feeder Drum/Crate
                </a>
              </li>
            </ul>
          </div>
          <!-- </div> -->
        </div>
      </div>

        <div v-if="activeTab === 'DrumCrate'">
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
                  <md-input ></md-input>
                </md-field>
                <md-icon>search</md-icon>
          </div>
      
          <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">BROILER NUTRITION TABLE</h4>
                <!-- <p class="category">List of Users</p> -->
                </md-card-header>
                <md-card-content>
                  <md-table v-model="temp" :table-header-color="tableHeaderColor">
                    
                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="Pen No">{{ item.name }}</md-table-cell>
                      <md-table-cell md-label="FD Tare Wt(kg)">{{ item.ingredients }}</md-table-cell>
                      <md-table-cell md-label="Crate">{{ item.salary}}</md-table-cell>
                      <md-table-cell md-label="Crate Tare Wt(Kgs)">{{ item.country }}</md-table-cell>
                      <md-table-cell md-label="Updated Crate WT">{{ item.city }}</md-table-cell>
                      <!-- <md-table-cell class="md-body-2" md-label="view"><md-icon>visibility</md-icon></md-table-cell> -->
                      <!-- <md-table-cell md-label="Access Card"><md-icon>key</md-icon></md-table-cell>
                      <md-table-cell md-label="Status">Active</md-table-cell> -->
                    </md-table-row>
                  </md-table>
                </md-card-content>
        </md-card>
      </div>
        </div>  

      <div v-if="activeTab === 'list'">
        <form class="form-style">
          <div style="max-width:75%">
            <md-card max-width="60%">
              <md-card-header data-background-color="green">
                        <h4 class="title">Corrected Feed Formula</h4>
              </md-card-header>
              <md-card-content>
              <md-card-content>
                <div class="table-layout">

                    <div class="structax" id="struct">
            <label for="country" class="test1"><span class="md-body-2">Trial Number</span></label>

                        <div class="test2">
                          <md-field>
                            <label for="country">Select</label>
                            <md-select required v-model="country" name="country" id="country" md-dense>
                              <md-option value="australia">T10/10/22</md-option>
                              <md-option value="australia">T11/10/22</md-option>
                              <md-option value="australia">T12/10/22</md-option>
                              <md-option value="australia">T14/10/22</md-option>
                              <!-- <md-option value="brazil">Bean</md-option> -->
                       
                            </md-select>
                          </md-field>
                        </div>
                    
                       
                        
                        <!-- <label for="country" class="test3"><span class="md-body-2">End Date</span></label> -->

                        
                        <!-- <label for="country" class="test1"><span class="md-body-2">Select</span></label> -->
                        <!-- <div>
                          <div class="col-md-3">
                        <label><span class="md-body-2">Pens</span></label>
                          <div class="w-100">
                            <div
                              class="checkbox-select__trigger"
                              :class="{ isActive: isDropdownOpen }"
                              @click="toggleDropdown"
                            >
                              <span style="font-size: 0.9rem;">Select the applicable</span>
                              <i :class="dropdownIconClass"></i>
                            </div>
                            <div
                              id="div"
                              class="checkbox-select__dropdown"
                              v-show="isDropdownOpen"
                            >
                              <div class="checkbox-select__search-wrapp">
                                <input
                                  type="text"
                                  placeholder="Search"
                                  v-model="searchQuery"
                                />
                              </div>
                              <div class="checkbox-select__col">
                                <div class="checkbox-select__select-all">
                                  <input
                                  id="divselectAll"
                                  type="checkbox"
                                  @change="toggleSelectAll"
                                  :checked="allSelected"
                                  />
                                  <label for="divselectAll">Select All</label>
                                </div>
                                <div class="checkbox-select__info">
                                  {{ selectedItems.length }} SELECTED
                                </div>
                              </div>
                              <ul
                                id="customScroll"
                                class="checkbox-select__filters-wrapp"
                                data-simplebar-auto-hide="false"
                              >
                                <li
                                  v-for="(option, index) in filteredOptions"
                                  :key="index"
                                  style="list-style: none;"
                                >
                                  <div class="checkbox-select__check-wrapp">
                                    <input
                                      :id="'div' + index"
                                      class="conditions-check"
                                      type="checkbox"
                                      :value="option"
                                      v-model="selectedItems"
                                    />
                                    <label :for="'div' + index" class="text-capitalize">
                                      {{ option }}
                                    </label>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      
                    </div>
                  </div>

                  <div class="table-layout">

<div class="structx">
<label for="country" class="test1"><span class="md-body-2">Select Chick Category</span></label>

<div class="test2">
  <md-field>
    <label for="country">Select</label>
    <md-select required v-model="chickCategory" name="country" id="country" md-dense>
      <md-option value="prestarter">Pre-Starter</md-option>
      <md-option value="starter">Starter</md-option>
      <md-option value="finisher">Finisher</md-option>
      <!-- <md-option value="united-states">United States</md-option> -->
    </md-select>
  </md-field>
</div>

<label for="country" class="test3"><span class="md-body-2">Trial Group</span></label>
<!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->

<div class="test4">
  <md-field>
    <label for="country">Select</label>
    <md-select required v-model="country" name="country" id="country" md-dense>
      <md-option value="australia">T1</md-option>
      <md-option value="australia">T2</md-option>
      <md-option value="australia">T3</md-option>
      <md-option value="australia">T4</md-option>
      <md-option value="australia">T5</md-option>
    </md-select>
  </md-field>
</div>

<!-- <div class="test5"></div> -->

<label for="country" class="test1"><span class="md-body-2">Select</span></label>
                        <div>
                          <div class="col-mk-3">
                        <label><span class="md-body-2">Pens</span></label>
                          <div class="w-100">
                            <div
                              class="checkbox-select__trigger"
                              :class="{ isActive: isDropdownOpen }"
                              @click="toggleDropdown"
                            >
                              <span style="font-size: 12px;">Select the applicable</span>
                              <i :class="dropdownIconClass"></i>
                            </div>
                            <div
                              id="div"
                              class="checkbox-select__dropdown"
                              v-show="isDropdownOpen"
                            >
                              <div class="checkbox-select__search-wrapp">
                                <input
                                  type="text"
                                  placeholder="Search"
                                  v-model="searchQuery"
                                />
                              </div>
                              <div class="checkbox-select__col">
                                <div class="checkbox-select__select-all">
                                  <input
                                  id="divselectAll"
                                  type="checkbox"
                                  @change="toggleSelectAll"
                                  :checked="allSelected"
                                  />
                                  <label for="divselectAll">Select All</label>
                                </div>
                                <div class="checkbox-select__info">
                                  {{ selectedItems.length }} SELECTED
                                </div>
                              </div>
                              <ul
                                id="customScroll"
                                class="checkbox-select__filters-wrapp"
                                data-simplebar-auto-hide="false"
                              >
                                <li
                                  v-for="(option, index) in filteredOptions"
                                  :key="index"
                                  style="list-style: none;"
                                >
                                  <div class="checkbox-select__check-wrapp">
                                    <input
                                      :id="'div' + index"
                                      class="conditions-check"
                                      type="checkbox"
                                      :value="option"
                                      v-model="selectedItems"
                                    />
                                    <label :for="'div' + index" class="text-capitalize">
                                      {{ option }}
                                    </label>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>

<label for="country" class="test3"><span class="md-body-2">Penwise Bird Count</span></label>

<div class="test4">
  <md-field>
    <label>Quantity</label>
    <md-input v-model="number" type="number"></md-input>
  </md-field>
</div>
<!-- <div class="test5"></div> -->

<div class="test1"></div>
<!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
<div class="test2">
  
</div>
<label for="country" class="test3" v-if="showFormula"><span class="md-body-2">Formula</span></label>
<div v-else></div>



<div class="test4" v-if="showFormula">
  <md-field>
    <md-select required v-model="formula" name="country" id="country" md-dense>
      <md-option value="fn1">FN1</md-option>
      <md-option value="fn2">FN2</md-option>
    </md-select>
  </md-field>
</div>
<div v-else></div>


<div class="test1"></div>
<!-- <label for="country">Select Chick Category&nbsp;&nbsp;&nbsp;&nbsp;</label> -->
<div class="test2">
  
</div>
<label for="country" class="test3"><span class="md-body-2">Feed Per Chick(gm)</span></label>

<div class="test4">
  <md-field>
    <label>Quantity</label>
    <md-input v-model="number" type="number"></md-input>
  </md-field>
</div>
<!-- <div class="test5"></div> -->
<div></div>
<div></div>
<label for="country" class="test3"><span class="md-body-2">Feed Per Pen(kg)</span></label>

<div class="test4">
  <md-field>
    <label>Quantity</label>
    <md-input v-model="number" type="number"></md-input>
  </md-field>
</div>

</div>




</div>
                  <hr>
                     
              <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
                <md-card>
                <md-card-header data-background-color="green">
                <h4 class="title">Penwise Feed Formula Per Group</h4>
                </md-card-header>
                <md-card-content>
                  <table class="styled-table">
                    <thead>
                      <tr>
                        <th>Ingredients</th>
                        <th>Quantity</th>
                        <th>Units</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in temp2" :key="item.id">
                        <td>
                          <div v-if="!item.isEditing">{{ item.ingredients }}</div>
                          <div v-else>
                            <input v-model="item.ingredients" class="custm"/>
                          </div>
                        </td>
                        <td>
                          <div v-if="!item.isEditing">{{ item.number }}</div>
                          <div v-else>
                            <input v-model="item.number" type="number" class="custm"/>
                          </div>
                        </td>
                        <td>
                          <div v-if="!item.isEditing">{{ item.font }}</div>
                          <div v-else>
                            <input v-model="item.font" class="custm"/>
                          </div>
                        </td>

                      </tr>
                    </tbody>
                </table>
                </md-card-content>
                </md-card>
            </div>
                 </md-card-content>
              </md-card-content>
            </md-card>
          </div> 
        </form>
      </div>

      <div v-if="activeTab === 'apply'">
        <form class="form-style">
          <div style="max-width:75%">
            <md-card max-width="60%">
              <md-card-header data-background-color="green">
                        <h4 class="title">TRAIL FORMULA BY USING CONCENTRATE</h4>
              </md-card-header>
            <md-card-content>
          <md-card-content>
                  <hr>
                  <div v-for="(row, index) in rows" :key="index" class="testing">
                    <div class="test1" id="input-item">
                      <label><span class="md-body-2">Select Ingredients</span></label>
                    </div>
                    <div class="test2" id="input-item">
                      <md-field>
                        <label>Select</label>
                          <md-select required v-model="row.ingredients" md-dense>
                            <!-- <md-option value="T10/10/22">T10/10/22</md-option> -->
                            <md-option value="Soya">Soya</md-option>
                            <md-option value="Maize">Maize</md-option>
                            <md-option value="7.5 Starter Premix">7.5 Starter Premix</md-option>
                            <md-option value="OIL">OIL</md-option>
                          </md-select>
                      </md-field>
                    </div>

                    <div class="test3" id="input-item">
                      <label><span class="md-body-2">+Qty</span></label>
                    </div>

                    <div class="test4" id="input-item">
                      <md-field>
                        <label>Quantity</label>
                        <md-input v-model="row.number" type="number"></md-input>
                      </md-field>
                    </div>
                    
                    <div class="test5" id="input-item">
                      <md-field>
                        <label>Select</label>
                        <md-select v-model="row.font" md-dense>
                          <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">ML</md-option>
                        </md-select>
                      </md-field>
                    </div>
                    <div @click="removeRow(row)" style="cursor: pointer;">
                      <md-icon>clear</md-icon>
                    </div>
                  </div>
                  <hr>
            <div class="struct2" style="padding-top: 20px;">
                <div><md-button @click="addRow" class="md-primary">Add Row</md-button> </div>
                        <div class="test2"><md-field>
      <label><b>Feed Cost</b></label>
      <md-input v-model="feedCost" readonly></md-input>
    </md-field></div>
                        <label for="country" class="test3"><span class="md-body-2">Total</span></label>
                        <div class="test4">
                          <md-field>
                            <label>Quantity</label>
                            <md-input v-model="total" readonly></md-input>
                          </md-field>
                        </div>

                        <div class="test5">
                          <md-field>
                            <label for="font">Select</label>
                            <md-select v-model="font" name="font" md-dense>
                              <md-option value="arial">GMS</md-option>
                          <md-option value="calibri">ML</md-option>
                            </md-select>
                          </md-field>
                      </div>
                    </div>
                 
                 </md-card-content>
                
              </md-card-content>
            </md-card>
            
          </div>  
        </form>
      </div>

                <div class="row-layout2">
                      <div id="buttons">
              
                        <div>
                          <md-button type="submit" @click="display" class="md-success">Submit</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                          <md-button type="button" class="md-danger">Cancel</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                          <md-button type="button" class="md-danger">Reset</md-button>
                        </div>

                      </div>
                </div>  
                    
  </div>

  </template>
  
  <script>
  let id = 0;
  export default {
    name: "simple-table",
    total:0,
    props: {
      tableHeaderColor: {
        type: String,
        default: "",
      },
    },
    data() {
      return {
        feedCost:56,
        chickCategory: '',
      formula: '',
      showFormula: false,
        activeTab: 'list', // Default active tab
        isDropdownOpen: false,
      searchQuery: '',
      options: [
        'P1',
        'P2',
        'P3',
        'P4',
        'P5',
        'P6',
        'P7',
      ],
      selectedItems: [],
        rows: [
        // { ingredients: '', number: 0, font: '' ,id: },
        { ingredients: '', number: 0, font: '', id: id++} // Initial row
      ],
      temp: [],
      temp2:[],
        users: [
          { name: "P1",ingredients:"1.150", salary: "Yellow1", country: "6.660", city: "6.660" },   
          { name: "P2", ingredients:"1.250", salary: "Yellow2", country: "6.660", city: "6.660" },
          { name: "P3", ingredients:"1.220", salary: "Green 1", country: "1.700", city: "2.220" },
          { name: "P4", ingredients:"1.280", salary: "Green2 ", country: "1.700", city: "2.223" },
          { name: "P5", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          // { name: "6", salary: "615", country: "868", city: "665" },     
        ],

        otherUsers: [
          { name: "Jane Doe", salary: "$48,000", country: "USA", city: "New York" },
          { name: "John Smith", salary: "$52,000", country: "UK", city: "London" },
          { name: "Juan Carlos", salary: "$44,000", country: "Spain", city: "Madrid" },
          { name: "Wei Zhang", salary: "$50,000", country: "China", city: "Beijing" },
        ],
      };
    },
    computed: {
    dropdownIconClass() {
      return this.isDropdownOpen ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down';
    },
    filteredOptions() {
      const query = this.searchQuery.toLowerCase();
      console.log(this.users
        .map(user => user.name)
        .filter(name => name.toLowerCase().includes(query)));
      return this.users
        .map(user => user.name)
        .filter(name => name.toLowerCase().includes(query));
    },
    allSelected() {
      return this.selectedItems.length === this.users.length;
    }
  },
  watch:{
    chickCategory(newValue) {
      this.showFormula = newValue === 'finisher';
    },
    selectedItems(newSelectedItems) {
      this.temp = this.users.filter(user => newSelectedItems.includes(user.name));
      console.log("hi",this.temp);
    },
    rows: {
      handler(newRows) {
        // Compute the total of the `number` fields
        this.total= newRows.reduce((sum, row) => sum + (Number(row.number) || 0), 0).toFixed(5);
       
      },
      deep: true // Watch for changes in the array's objects
    }
  },
    methods: {
      isActive(tab) {
        return this.activeTab === tab;
      },
      // toggleEdit(item) {
      //   item.isEditing = !item.isEditing;
      // },
      // saveChanges(item) {
      //   item.isEditing = false;
      //   // Additional logic to save changes if needed
      // },

      display(){
        this.temp2=[];
        this.temp2.push(...this.rows);
        console.log(this.temp2);
      },

      setActiveTab(tab) {
        this.activeTab = tab;
      },
      
      addRow(){
          this.rows.push({ ingredients: '', number: 0, font: '', isEditing: false, id: id++});
      },

      removeRow(row){
          this.rows=this.rows.filter((i)=>i!==row);
      },

      toggleDropdown(){
          this.isDropdownOpen = !this.isDropdownOpen;
      },
      toggleSelectAll() {
        if (this.allSelected) {
          this.selectedItems = [];
        } else {
          this.selectedItems = [...this.filteredOptions];
        }
      },
    }
  };
  </script>
  
  <style scoped>
.structax{
    display: grid;
    grid-template-columns:75px 230px 58px 200px;
    grid-gap: 25px;
    padding-top:20px;
}
.structx{
    display: grid;
    grid-template-columns:75px 230px 58px 200px;
    grid-gap: 25px;
    padding-top:20px; 
}

.struct2{
  display: grid;
    grid-template-columns: 135px 250px 58px 150px 100px;
    grid-gap: 25px;
    grid-auto-rows: 50px;
    margin-left:20px; 
}

.md-field {
  margin: 0px 0px;
}

.grid-item {
    height: 50px;
}

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

.styled-table {
  width: 100%;
  border-collapse: collapse;
  /* margin: 25px 0; */
  font-size: 15px;
  font-weight: 500;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  min-width: 400px;
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
            margin-top: 40px;
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
  
  .custm{
    height:30px;
    width:90px;
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
  
  .col-auto {
    flex: 0 0 auto;
    flex-direction: row;
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
  width: 100%;
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
  width: 100%;
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
  width: 22px;
  height: 22px;
  top: 0;
  left: 0;
  position: absolute;
}
.checkbox-select__check-wrapp input[type="checkbox"]+label:before {
  width: 14px;
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
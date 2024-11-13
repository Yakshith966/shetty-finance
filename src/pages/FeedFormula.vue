<template>
    <div>
      <div v-if="!page">
      <div class="">

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
                            <md-select required v-model="trNo"  id="country" md-dense>
                              <md-option value="australia">T10/10/22</md-option>
                              <md-option value="australia">T11/10/22</md-option>
                              <md-option value="australia">T12/10/22</md-option>
                              <md-option value="australia">T14/10/22</md-option>
                              <!-- <md-option value="brazil">Bean</md-option> -->
                       
                            </md-select>
                          </md-field>
                        </div>
                      
                    </div>
                  </div>

                  <div class="table-layout">

<div class="structx">
<label for="country" class="test1"><span class="md-body-2">Select Chick Category</span></label>

<div class="test2">
  <md-field>
    <label for="country">Select</label>
    <md-select required v-model="chickCategory"  id="country" md-dense>
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
    <md-select required v-model="trailGroup"  id="country" md-dense>
      <md-option value="T1">T1</md-option>
      <md-option value="T2">T2</md-option>
      <md-option value="T3">T3</md-option>
      <md-option value="T4">T4</md-option>
      <md-option value="T5">T5</md-option>
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
    <md-input v-model="penBirdCnt" type="number"></md-input>
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
    <md-input v-model="feedPerChick" type="number"></md-input>
  </md-field>
</div>
<!-- <div class="test5"></div> -->
<div></div>
<div></div>
<label for="country" class="test3"><span class="md-body-2">Feed Per Pen(kg)</span></label>

<div class="test4">
  <md-field>
    <label>Quantity</label>
    <md-input v-model="initial" readonly></md-input>
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
        <!-- <div "><button>Save</button></div> -->
      
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
                            <md-select v-model="font" md-dense>
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
                          <md-button type="submit" @click="operate" class="md-success">Save</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                          <md-button type="submit" @click="toggleRslt" class="md-success">Submit</md-button>
                        </div>
                        <div style="padding-left: 10px;">
                          <md-button @click="clearr" type="button" class="md-danger">Reset</md-button>
                        </div>

                      </div>
                </div>  
                
                <!-- <md-table v-model="temp" :table-header-color="tableHeaderColor">
                    
                    <md-table-row slot="md-table-row" slot-scope="{ item }">
                      <md-table-cell md-label="T1">{{ item.name }}</md-table-cell>
                      <md-table-cell md-label="T2">{{ item.ingredients }}</md-table-cell>
                      <md-table-cell md-label="T4">{{ item.salary}}</md-table-cell>
                      <md-table-cell md-label="T5">{{ item.country }}</md-table-cell>
                      <md-table-cell md-label="Trail Counts">{{ item.city }}</md-table-cell>
                      <md-table-cell md-label="Replicas">{{ item.city }}</md-table-cell>
                      <md-table-cell md-label="Action">{{ item.city }}</md-table-cell>
                      <md-table-cell class="md-body-2" md-label="view"><md-icon>visibility</md-icon></md-table-cell> 
                      <md-table-cell md-label="Access Card"><md-icon>key</md-icon></md-table-cell>
                      <md-table-cell md-label="Status">Active</md-table-cell> 
                    </md-table-row>
                  </md-table>   -->
                </div>
                  <div v-else>
                    <table>
  <tr>
    <th>Trials</th>
    <th>T1</th>
    <th>T2</th>
    <th>T3</th>
    <th>T4</th>
    <th>T5</th>
    <th>Trial Counts</th>
    <th>Replicas</th>
    <th>Action</th>
  </tr>
  <tr>
    <td rowspan="5">Alloted Pens</td>
    <td><span v-if="!editingRow[0]">{{ a1 }}</span><input v-else v-model="a1" /></td>
    <td><span v-if="!editingRow[0]">{{ a6 }}</span><input v-else v-model="a6" /></td>
    <td><span v-if="!editingRow[0]">{{ a11 }}</span><input v-else v-model="a11" /></td>
    <td><span v-if="!editingRow[0]">{{ a16 }}</span><input v-else v-model="a16" /></td>
    <td><span v-if="!editingRow[0]">{{ a21 }}</span><input v-else v-model="a21" /></td>
    <td>30</td>
    <td>5</td>
    <td><button @click="toggleEdit(0)">{{ editingRow[0] ? 'Save' : 'Edit' }}</button></td>
  </tr>
  <tr>
    <td><span v-if="!editingRow[1]">{{ a2 }}</span><input v-else v-model="a2" /></td>
    <td><span v-if="!editingRow[1]">{{ a7 }}</span><input v-else v-model="a7" /></td>
    <td><span v-if="!editingRow[1]">{{ a12 }}</span><input v-else v-model="a12" /></td>
    <td><span v-if="!editingRow[1]">{{ a17 }}</span><input v-else v-model="a17" /></td>
    <td><span v-if="!editingRow[1]">{{ a22 }}</span><input v-else v-model="a22" /></td>
    <td>30</td>
    <td>5</td>
    <td><button @click="toggleEdit(1)">{{ editingRow[1] ? 'Save' : 'Edit' }}</button></td>
  </tr>
  <tr>
    <td><template v-if="!editingRow[2]">{{ a3 }}</template>
      <template v-else><input v-model="a3" /></template>
    </td>
    <td><template v-if="!editingRow[2]">{{ a8 }}</template><template v-else><input v-model="a8" /></template></td>
    <td><template v-if="!editingRow[2]">{{ a13 }}</template><template v-else><input v-model="a13" /></template></td>
    <td><template v-if="!editingRow[2]">{{ a18 }}</template><template v-else><input v-model="a18" /></template></td>
    <td><template v-if="!editingRow[2]">{{ a23 }}</template><template v-else><input v-model="a23" /></template></td>
    <td>30</td>
    <td>5</td>
    <td><button @click="toggleEdit(2)">{{ editingRow[2] ? 'Save' : 'Edit' }}</button></td>
  </tr>
  <tr>
    <td><span v-if="!editingRow[3]">{{ a4 }}</span><input v-else v-model="a4" /></td>
    <td><span v-if="!editingRow[3]">{{ a9 }}</span><input v-else v-model="a9" /></td>
    <td><span v-if="!editingRow[3]">{{ a14 }}</span><input v-else v-model="a14" /></td>
    <td><span v-if="!editingRow[3]">{{ a19 }}</span><input v-else v-model="a19" /></td>
    <td><span v-if="!editingRow[3]">{{ a24 }}</span><input v-else v-model="a24" /></td>
    <td>30</td>
    <td>5</td>
    <td><button @click="toggleEdit(3)">{{ editingRow[3] ? 'Save' : 'Edit' }}</button></td>
  </tr>
  <tr>
    <td><span v-if="!editingRow[4]">{{ a5 }}</span><input v-else v-model="a5" /></td>
    <td><span v-if="!editingRow[4]">{{ a10 }}</span><input v-else v-model="a10" /></td>
    <td><span v-if="!editingRow[4]">{{ a15 }}</span><input v-else v-model="a15" /></td>
    <td><span v-if="!editingRow[4]">{{ a20 }}</span><input v-else v-model="a20" /></td>
    <td><span v-if="!editingRow[4]">{{ a25 }}</span><input v-else v-model="a25" /></td>
    <td>30</td>
    <td>5</td>
    <td><button @click="toggleEdit(4)">{{ editingRow[4] ? 'Save' : 'Edit' }}</button></td>
  </tr>
</table>
                    <table style="width:1000px;padding-top:300px;">
  <tr>
    <th></th>
    <th>Groups</th>
    <th>T1</th>
    <th>T2</th>
    <th>T3</th>
    <th>T4</th>
    <th>T5</th>

  </tr>
  <tr>
    <td rowspan="7">Ingredients in Kgs</td>
  </tr>
  <tr>
    
    <td>{{ b1 }}</td>
    <td>{{ b6 }}</td>
    <td>{{ b11 }}</td>
    <td>{{ b16 }}</td>
    <td>{{ b21 }}</td>
    <td>{{ b26 }}</td>
   
   
  </tr>
  <tr>
    <td>{{ b2 }}</td>
    <td>{{ b7 }}</td>
    <td>{{ b12 }}</td>
    <td>{{ b17 }}</td>
    <td>{{ b22 }}</td>
    <td>{{ b27 }}</td>
   

   
  </tr>
  <tr>
    <td>{{ b3 }}</td>
    <td>{{ b8 }}</td>
    <td>{{ b13 }}</td>
    <td>{{ b18 }}</td>
    <td>{{ b23 }}</td>
    <td>{{ b28 }}</td>

  </tr>
  <tr>
    <td>{{ b4 }}</td>
    <td>{{ b9 }}</td>
    <td>{{ b14 }}</td>
    <td>{{ b19 }}</td>
    <td>{{ b24 }}</td>
    <td>{{ b29 }}</td>

  </tr>
  <tr>
    <td>{{ b5 }}</td>
    <td>{{ b10 }}</td>
    <td>{{ b15 }}</td>
    <td>{{ b20 }}</td>
    <td>{{ b25 }}</td>
    <td>{{ b30 }}</td>

  </tr>
 

</table>

    <md-button type="submit" @click="toggleRslt" class="md-success">Back</md-button>
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
        page: false,
        initial:9,
        chickCategory: '',
      formula: '',
      showFormula: false,
        activeTab: 'list', // Default active tab
        isDropdownOpen: false,
      searchQuery: '',
      // tempo:
      a1: '', a2: '', a3: '', a4: '', a5: '',
      a6: '', a7: '', a8: '', a9: '', a10: '',
      a11: '', a12: '', a13: '', a14: '', a15: '',
      a16: '', a17: '', a18: '', a19: '', a20: '',
      a21: '', a22: '', a23: '', a24: '', a25: '',
editingRow: [false, false, false, false, false],
      b1: '', b2: '', b3: '', b4: '', b5: '',
      b6: '', b7: '', b8: '', b9: '', b10: '',
      b11: '', b12: '', b13: '', b14: '', b15: '',
      b16: '', b17: '', b18: '', b19: '', b20: '',
      b21: '', b22: '', b23: '', b24: '', b25: '',
      b26: '', b27: '', b28: '', b29: '', b30: '',
      options: [
        'P1',
        'P2',
        'P3',
        'P4',
        'P5',
        'P6',
        'P7',
        'P8',
        'P9',
        'P10',
        'P11',
        'P12',
        'P13',
        'P14',
        'P15',
        'P16',
        'P17',
        'P18',
        'P19',
        'P20',
        'P21',
        'P22',
        'P23',
        'P24',
        'P25',
      ],
      selectedItems: [],
        rows: [
        // { ingredients: '', number: 0, font: '' ,id: },
        { ingredients: '', number: 0, font: '', id: id++} // Initial row
      ],
      temp: [],
      temp2:[],
      temp4:[],
      trailGroup:'',
      trNo:'',
        // chickCategory='';
        // trailGroup='';
        // this.selectedItems=[];
        penBirdCnt:'',
        // this.formula='';
      feedPerChick:'',
      
        users: [
          { name: "P1",ingredients:"1.150", salary: "Yellow1", country: "6.660", city: "6.660" },   
          { name: "P2", ingredients:"1.250", salary: "Yellow2", country: "6.660", city: "6.660" },
          { name: "P3", ingredients:"1.220", salary: "Green 1", country: "1.700", city: "2.220" },
          { name: "P4", ingredients:"1.280", salary: "Green2 ", country: "1.700", city: "2.223" },
          { name: "P5", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P6", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P7", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P8", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P9", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P10", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P11", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P12", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P13", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P14", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P15", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P16", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P17", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P19", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P20", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P21", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P22", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P23", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P24", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
          { name: "P25", ingredients:"1.230", salary: "Orange 1", country: "6.720", city: "6.720" },
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
      console.log("hhhh",this.selectedItems);
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
      toggleEdit(index) {
      this.editingRow[index] = !this.editingRow[index];
      this.page=!this.page;
      this.clearr();
      this.page=!this.page;
    },
      // toggleEdit(item) {
      //   item.isEditing = !item.isEditing;
      // },
      // saveChanges(item) {
      //   item.isEditing = false;
      //   // Additional logic to save changes if needed
      // },
      penWiseAllotement(){
        this.selectedItems=['p1','p4','p7','p5'];
          this.temp4.push({Trials: '', T1: 1, T2: 2, T3: 3, T4: 4, T5: 5, TrialCounts: 30, Replicas: 5, editing: false});
      //     tempo: [
      //       { Trials: '', T1: 1, T2: 2, T3: 3, T4: 4, T5: 5, TrialCounts: 30, Replicas: 5, editing: false },
      //   { Trials: '', T1: 6, T2: 7, T3: 8, T4: 9, T5: 10, TrialCounts: 30, Replicas: 5, editing: false },
      //   { Trials: 'Alloted Pens', T1: 11, T2: 12, T3: 13, T4: 14, T5: 15, TrialCounts: 30, Replicas: 5, editing: false  },
      //   { Trials: '', T1: 16, T2: 17, T3: 18, T4: 19, T5: 20, TrialCounts: 30, Replicas: 5, editing: false  },
      //   { Trials: '', T1: 21, T2: 22, T3: 23, T4: 24, T5: 25, TrialCounts: 30, Replicas: 5, editing: false  }
      // ],
        
      },
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
      operate(){
        console.log("jiaijijais");
this.display();

      if (this.trailGroup === 'T1') {
  this.a1 = this.selectedItems[0];
  this.a2 = this.selectedItems[1];
  this.a3 = this.selectedItems[2];
  this.a4 = this.selectedItems[3];
  this.a5 = this.selectedItems[4];

  this.b1 = this.rows[0].ingredients;
  this.b2 = this.rows[1].ingredients;
  this.b3 = this.rows[2].ingredients;
  this.b4 = this.rows[3].ingredients;
  this.b5 = this.rows[4].ingredients;

  
} else if (this.trailGroup === 'T2') {
  this.b1 = this.rows[0].ingredients;
  this.b2 = this.rows[1].ingredients;
  this.b3 = this.rows[2].ingredients;
  this.b4 = this.rows[3].ingredients;
  this.b5 = this.rows[4].ingredients;
  this.a6 = this.selectedItems[0];
  this.a7 = this.selectedItems[1];
  this.a8 = this.selectedItems[2];
  this.a9 = this.selectedItems[3];
  this.a10 = this.selectedItems[4];
  // this.b1 = this.rows[0].ingredients;
  // this.b2 = this.rows[1].ingredients;
  // this.b3 = this.rows[2].ingredients;
  // this.b4 = this.rows[3].ingredients;
  // this.b5 = this.rows[4].ingredients;
  // this.b11 = this.rows[0].number.toString();
  // this.b12 = this.rows[1].number.toString();
  // this.b13 = this.rows[2].number.toString();
  // this.b14 = this.rows[3].number.toString();
  // this.b15 = this.rows[4].number.toString();
} else if (this.trailGroup === 'T3') {
  this.a11 = this.selectedItems[0];
  this.a12 = this.selectedItems[1];
  this.a13 = this.selectedItems[2];
  this.a14 = this.selectedItems[3];
  this.a15 = this.selectedItems[4];
  this.b1 = this.rows[0].ingredients;
  this.b2 = this.rows[1].ingredients;
  this.b3 = this.rows[2].ingredients;
  this.b4 = this.rows[3].ingredients;
  this.b5 = this.rows[4].ingredients;
  // this.b16 = this.rows[0].number.toString();
  // this.b17 = this.rows[1].number.toString();
  // this.b18 = this.rows[2].number.toString();
  // this.b19 = this.rows[3].number.toString();
  // this.b20 = this.rows[4].number.toString();
} else if (this.trailGroup === 'T4') {
  this.a16 = this.selectedItems[0];
  this.a17 = this.selectedItems[1];
  this.a18 = this.selectedItems[2];
  this.a19 = this.selectedItems[3];
  this.a20 = this.selectedItems[4];
  this.b1 = this.rows[0].ingredients;
  this.b2 = this.rows[1].ingredients;
  this.b3 = this.rows[2].ingredients;
  this.b4 = this.rows[3].ingredients;
  this.b5 = this.rows[4].ingredients;
  // this.b21 = this.rows[0].number.toString();
  // this.b22 = this.rows[1].number.toString();
  // this.b23 = this.rows[2].number.toString();
  // this.b24 = this.rows[3].number.toString();
  // this.b25 = this.rows[4].number.toString();
} else {
  this.a21 = this.selectedItems[0];
  this.a22 = this.selectedItems[1];
  this.a23 = this.selectedItems[2];
  this.a24 = this.selectedItems[3];
  this.a25 = this.selectedItems[4];

  this.b1 = this.rows[0].ingredients;
  this.b2 = this.rows[1].ingredients;
  this.b3 = this.rows[2].ingredients;
  this.b4 = this.rows[3].ingredients;
  this.b5 = this.rows[4].ingredients;
  
  // this.b26 = this.rows[0].number.toString();
  // this.b27 = this.rows[1].number.toString();
  // this.b28 = this.rows[2].number.toString();
  // this.b29 = this.rows[3].number.toString();
  // this.b30 = this.rows[4].number.toString();
}

// { rows: [
//         // { ingredients: '', number: 0, font: '' ,id: },
//         { ingredients: '', number: 0, font: '', id: id++} // Initial row
//       ],
// this.b1 = this.rows[0].ingredients;
//   this.b2 = this.rows[1].ingredients;
//   this.b3 = this.rows[2].ingredients;
//   this.b4 = this.rows[3].ingredients;
//   this.b5 = this.rows[4].ingredients;

  console.log("this.b6 = this.rows[0].number;",this.rows[0].number);
  
this.operatex();

      },
      operatex(){
        if (this.trailGroup === 'T1')
{
  console.log("hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii");
  this.b6 = this.temp2[0].number.toString();
  this.b7 = this.temp2[1].number.toString();
  this.b8 = this.temp2[2].number.toString();
  this.b9 = this.temp2[3].number.toString();
  this.b10 = this.temp2[4].number.toString();
} else if (this.trailGroup === 'T2') {
  this.b11 = this.rows[0].number.toString();
  this.b12 = this.rows[1].number.toString();
  this.b13 = this.rows[2].number.toString();
  this.b14 = this.rows[3].number.toString();
  this.b15 = this.rows[4].number.toString();
} else if (this.trailGroup === 'T3') {
  this.b16 = this.rows[0].number;
  this.b17 = this.rows[1].number;
  this.b18 = this.rows[2].number;
  this.b19 = this.rows[3].number;
  this.b20 = this.rows[4].number;
} else if (this.trailGroup === 'T4') {
  this.b21 = this.rows[0].number;
  this.b22 = this.rows[1].number;
  this.b23 = this.rows[2].number;
  this.b24 = this.rows[3].number;
  this.b25 = this.rows[4].number;
} else {
  this.b26 = this.rows[0].number;
  this.b27 = this.rows[1].number;
  this.b28 = this.rows[2].number;
  this.b29 = this.rows[3].number;
  this.b30 = this.rows[4].number;
}


      },
      clearr(){
        this.trNo='';
        this.chickCategory='';
        this.trailGroup='';
        this.selectedItems=[];
        this.penBirdCnt='';
        this.formula='';
        this.feedPerChick='';
        this.temp2=[];
        this.rows=[{ ingredients: '', number: 0, font: '', isEditing: false, id: id++}];
      },
      toggleRslt(){
        this.page=!this.page;
        // this.clearr();
      }
    },

  };
  </script>
  
  <style scoped>

table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            /* text-align: center; */
        }
        th {
            background-color: #f2f2f2;
        }
        .action-cell {
            width: 50px;
        }

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